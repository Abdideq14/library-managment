<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
  <link rel="icon" type="image/png" href="../images\image.png"/>
  <script src="insert.js"></script> 
  <link rel="stylesheet" href="style.css">
  <head> 
    
    </head> 
    <body> 
      <form action="connect.php" method="post">
        <h2>Create an Account</h2> 
        <div id="names">
          <input type="text" placeholder="First Name" name="firstname" required id="name"/> 
          <input type="text" placeholder="Last Name" name="lastname" required id="name"/> 
        </div>

        <input type="email" name="email" placeholder="Email" name="email" id="email" required />

          <div id="gender">
          <label for="">Gender</label>
          <label for="male">Male<input type="radio" name="gender" id="male" value="m"></label>
          <label for="female">Female<input type="radio" name="gender" id="female" value="f"></label>
        </div>

        <div id="password">
          <input type="password" name="password" placeholder="Password" required />   
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required /> 
        </div>
        <div id="remember"> <label><input type="checkbox" /> Remember Me</label> 
        </div> 
        <br> 
        <input type="submit" value="Sign Up" /> 
        <p>Already have an account? <a href="../landing/index.php" style="color:red;">Login</a></p>
      </form> 
      <script src="insert.js"></script>
    </body>
    </html>