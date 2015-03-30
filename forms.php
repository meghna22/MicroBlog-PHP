<?php



function getMessages()
{
	// Connect to SQL db
	// Query all messages
	// make html table from results
	// return string with results
	
}

function landingForm()
				  {
						return ' <div class="m"> <form name="form" method="post" action="index.php">
						<input type="submit" name="btnLogin" id="btnlogin" value="Login" />
						</form>
						<label> or </label></br>
						<form name="form" method="post" action="signup.php">
						<input type="submit" name="btnsignup" id="btnsignup" value="Sign Up" />
						</form> </div>' ; 
				  }



				
function loginform()
{
			return ' <form name="myLogin" method="post" action="index.php">
						<label>Username:<label>
						<input type="text" name="username" id="username" />
						<br/><label>Password:</label>
						<input type="password" name="password" id="password"/></br> 
						</br>
						<input type="submit" name="btnSubmit" id="btnSubmit" value="Log in" />   
					</form>';
		
	
}

function logoutform()
   {
	      return  ' 
				 <form name="logoutform" method="post" action="index.php"> </br>
               <input type="submit" name="btnlogout" id="btnlogout" value="Logout" />
            </form>';
			
   }
   
   function messageform()
   {
	      return  ' <form name="myLogin" method="post" action="index.php">
                 <label>Post a message </label>
                <input type="text" name="message" id="message" />
                <input type="submit" name="btnpost" id="btnpost" value="Post" />
            </form>';
			
   }
   
   ?>