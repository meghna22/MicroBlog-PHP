<?php
session_start();
ob_start();
					require("config.php");
					//if((isset($_GET["btncancel"]))&&(isset($_GET["btnsup"])))
					if(isset($_GET["btncancel"]))
						{
							session_destroy();
							header("Location: index.php");
							ob_end_flush();
						}

//
//		try
//		{
//			$pdo_link = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);
//		}
//		catch(PDOException $e) {
//			print "Error!: " . $e->getMessage() . "<br/>";
//			die();
//		}
?>    
 <?php
 include("forms.php"); 
			if (isset($_POST['username'])) 
			//$name = $_POST['username'];
					if (isset($_POST['username'])&&isset($_POST['password'])){
						$uname= $_POST['username'];
						$pass= $_POST['password'];
						if ($pass!=""){
							if ($uname!=""){
								$uname= $_POST['username'];
								$pass= $_POST['password'];
								$pass=md5($pass);
								
								$sqlQuery = " SELECT * FROM `users` WHERE `user_name` = '$uname'";
								$result = $pdo_link->query($sqlQuery);
								
								if ($result){
					if ( $row = $result->fetch(PDO::FETCH_ASSOC) ==0)
					{
						//if $result was not set display error messages from our link
						$uname=trim($uname);
						$pass=trim($pass);
						$sqlQuery = " INSERT INTO  `users` (`user_name`,`user_hash`) VALUES ('$uname','$pass')";
						$result1 = $pdo_link->query($sqlQuery);
						if ((isset($_SESSION['mid']))&&(isset($_SESSION['mname']))){
							//session_destroy();
							//$_SESSION['mid'] = NULL;
							//$_SESSION['mname']=NULL; 
						}
						$user_id = $pdo_link->lastInsertId();
						$_SESSION['mid'] = $user_id;
						$_SESSION['mname'] = $_POST['username'];
						 header("Location: index.php");
						 ob_end_flush();		
					}
					else
					{
						echo "sorry that user already exists";
					}
				}//result
			}//username
			else
			{
				echo "Fill the username";
			}//uname
		}else{
			echo "Oops Fill the password";
		}
	}
				 $formOutput .= '
				 <div id="signup">
				 <form name="form1" method="post" action="signup.php">
				   <label>Sign Up to post on this page</label></br></br>
				   <label>Please enter username and password</label> </br>
				  <label>Username:<label>
				  <input type="text" name="username" id="username"/> </br>
				  <label>Password:</label>
		        <input type="password" name="password" id="password"/></br>
				 </br>
			     <input type="submit" name="btnsup" id="btnsup" value="Sign Up" /> 
				 </br>
				 </br>
				 </form>
				 
				 <form name="cancelform" method="get" action="index.php">
				 <input type="submit" name="btncancel" id="btncancel" value="cancel"/>
              </form>
			  </div>';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign up form</title>
<link rel="stylesheet" type="text/css" href="microblog.css">
</head>
<body>   
	<?PHP // Echo out any text added to our formOutput variable
                    echo $formOutput;
					   
    ?>
</body>
</html>