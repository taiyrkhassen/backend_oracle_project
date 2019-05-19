<?php 
 $conn = oci_connect('users', 'rauan123', 'localhost/XE');
 if (!$conn) {
     $e = oci_error();
     trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
 }
   if(isset($_COOKIE["type"]))
 {
    header("location:menu2.php");
 }
 else{
   if (isset($_POST['login'])) {
         $name = $_POST['name'];
         $login = $_POST['uname'];
         $password = $_POST['psw'];
         $password2 = $_POST['psw1'];
         if ($password2 == $password) {
           # code...
          $sql = "Insert into assemtolen.username(name,login,password) values('".$name."','".$login."','".$password."') ";
         $stid = oci_parse($conn, $sql);
         oci_execute($stid);
         header("location:menu2.php");
         }
         else{
          header("location:registration.php");
         }
         
 }
   } 

 ?>
<!DOCTYPE html>
<html>
<head>
 <title>admin</title>
 <style>
 button:hover {
    opacity: 0.8;
 }
 .container{
  display: flex;
  flex-direction: column;
  background-color: black;
  width: 30%;
  padding: 50px;
  padding-right: 5%;
  padding-left: 5%;
  margin: 0px auto;
  margin-top: 100px;
  font-family: 'Comic Sans MS', 'Comic Sans', cursive;
  font-size: 20px;
 }
 input[type='submit']{
  font-family: 'Comic Sans MS', 'Comic Sans', cursive;
  width: 30%;
  margin: 0px auto;
  font-size: 20px;
    
 }
 .username, .password{
  color: white;
 }
 .avatar{
  width: 100%
 }
 .imgcontainer{
  margin: 0px auto;
  width: 20%
 }
 .enter_username, .enter_password{
  font-family: 'Comic Sans MS', 'Comic Sans', cursive;
  font-size: 20px;
 }

 </style>
</head>
<body>
 <form action="" method="POST">
 <div class="container">
  <div class="imgcontainer"><img src="yy.jpg" class="avatar"></div>
  <label class="username"><b>Name</b></label>
     <input type="text" placeholder="Enter name" name="name" class="enter_username" required>
     <br>
     <label class="username"><b>Username</b></label>
     <input type="text" placeholder="Enter Username" name="uname" class="enter_username" required>
     <br>
     <label class="password"><b>Password</b></label>
     <input type="password" placeholder="Enter Password" name="psw" class="enter_password" required>
     <br>    
     <label class="password"><b>Confirm Password</b></label>
     <input type="password" placeholder="Enter Password" name="psw1" class="enter_password" required>
     <br>    
     
     <input type="submit" name = "login">Login</input>
  </div>
</form>

</body>
</html>