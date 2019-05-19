<?php 
 $conn = oci_connect('users', 'rauan123', 'localhost/XE');
 if (!$conn) {
     $e = oci_error();
     trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
 }
   if(isset($_COOKIE["type"]))
 {
  if($_COOKIE['type']==1){
    header("location:project.php");
  }
  else{
    header("location:menu2.php");
  }
 }
   if (isset($_POST['login'])) {
         $login = $_POST['uname'];
         $password = $_POST['psw'];
         $sql = "SELECT * FROM assemtolen.username WHERE login = '".$login."' AND password = '".$password."'";
         $stid = oci_parse($conn, $sql);
         oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
        if ($row['LOGIN'] == $login && $row['PASSWORD'] == $password) {
         if ($row['USER_ID'] == '1') {
          setcookie("type",$row['USER_ID'],time()+3600);
            header('location: project.php');
         }
         else{

          setcookie("type",$row['USER_ID'],time()+3600);
            header('location: menu2.php');
         }
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
  
     <label class="username"><b>Username</b></label>
     <input type="text" placeholder="Enter Username" name="uname" class="enter_username" required>
     <br>
     <label class="password"><b>Password</b></label>
     <input type="password" placeholder="Enter Password" name="psw" class="enter_password" required>
     <br>    
     <input type="submit" name = "login">Login</input>
  </div>
</form>

</body>
</html>