<?php
     session_start();
	  ob_start();
  	 require("config.php");
			if(isset($_POST["btnlogout"])){
					session_destroy();
					header('Location: index.php');
					ob_end_flush();
					}
?>  
<?php
	 if (isset($_POST['username'])&&isset($_POST['password'])){
		$uname= $_POST['username'];
		$pass= $_POST['password'];
		$pass=md5($pass);
		//echo $pass;
		$sqlQuery = "SELECT * FROM `users` WHERE `user_name` = '$uname'";
		//echo $sqlQuery;
		$result = $pdo_link->query($sqlQuery);
		//echo"Test A";
		if ($result){
			 while( $row = $result->fetch(PDO::FETCH_ASSOC) )
			{
				//echo"Test C";
				if($pass == $row['user_hash'])
				{
					//echo"Test";
					$user_id=$row['user_id'];
					$user_name=$row['user_name'];
					$_SESSION['mid'] = $user_id;
					$_SESSION['mname'] = $user_name;	
				}
			}
		}
		else
			echo "no data in database";
	}
?>   
<?php
     include("forms.php");    
	  $messageOutput = "";//TODO add results feom query to message table
	   $sqlQuery = " SELECT m.message_text, m.time_stamp, u.user_name, u.user_id FROM messages AS m  JOIN users AS u ON m.user_id = u.user_id ORDER BY m.time_stamp DESC";

		$result = $pdo_link->query($sqlQuery);
		if ($result){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) )
			{
				$messageOutput .=  '<ul><li class="l">'.$row['message_text'].'</li></ul>';
				$messageOutput .=  '<ul><li class="mk">'.$row['user_name'].' '.$row['time_stamp'].'</li></ul>';
			}
		}
		else
		{
			//if $result was not set display error messages from our link
			$messageOutput .=  "Sorry there are no messages to display";
	}
	  $formOutput = landingForm();
	  $footerOutput = "";	 
	if(isset($_POST["btnLogin"])){
		$formOutput = loginform();
	}
	if(isset($_SESSION['mid'])){
		$formOutput = logoutform();
		$footerOutput = messageform();
	}
?>             
<?php 
     	if (isset($_POST['btnpost'])) 
	{
		$message=$_POST['message'];
		$user_id = $_SESSION['mid'];
		$sqlQuery = " INSERT INTO  `messages` (`message_text`,`user_id`) VALUES ('$message','$user_id')";
		$result = $pdo_link->query($sqlQuery);
		header('Location: index.php');
       ob_end_flush();
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Micro Blog </title>
        <link rel="stylesheet" type="text/css" href="microblog.css">
    </head>

    <body>

<div id="header"><?PHP // Echo out any text added to our formOutput variable
					echo $formOutput;
					?></div>
                    
<div id="body"><?PHP // Echo out any text added to our formOutput variable
					echo $messageOutput;
					?></div>
                    
<div id="footer"><?PHP // Echo out any text added to our formOutput variable
					echo $footerOutput;
					?>
</div>
	

    </body>
</html>
    
