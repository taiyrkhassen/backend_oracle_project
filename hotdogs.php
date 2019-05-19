<?php 
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,'burgers');
   $id = $_GET['id'];
   $sql = "SELECT * FROM burgers WHERE id = '$id'";
   $result = mysqli_query($conn, $sql);
   $row = $result->fetch_array();
 ?>
<!DOCTYPE html>
<html>
<head>
	<style>
		body{
	margin: 0;
	background-color: black;
}
.navbar {
    display: flex;
    margin: 0;
    overflow: hidden;
    background-color: black;
    font-family: 'Comic Sans MS', 'Comic Sans', cursive;
    padding-right: 50px;
    padding-top: 12px;
    padding-bottom: 12px;
}
.navbar a:hover{
    background-color: #E74C3C;
}

.navbar .all a{
    font-size: 17px;
    color: white; 
    text-align: center;
    padding: 12px;
    text-decoration: none;
}
.all:last-child {
  margin-left: auto;
  display: flex;
}

.badge{
    margin-left: 50px; 
    width: 50px; 
    height: 50px;
}
.icon{
    display: none;
}
@media screen and (max-width: 600px) {
  .navbar .all .without{display: none;}
    .all a.icon {
    margin-left: 0px;
    display: block;
  }
  .all.responsive {position: relative;}
  .all.responsive .icon {
    position: absolute; 
}
  .all.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}


.burgers{
	margin-top: 50px;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: center;
	color: white;
	font-size: 30px;
	font-family: 'Comic Sans MS', 'Comic Sans', cursive;
}
.burgers .burger{
	display: flex; 
}
.burgers .burger{
	width: 90%;
	margin: 2%;
	height: 40%
}
.burgers .burger img{
	width: 50%;
	height: 100%
}
.burgers .burger .card{
	margin-left: 50px;
}
.burgers .burger .card .name{
	font-size: 40px;
}
.burgers .burger .card .price{
	font-size: 40px;
    float: right;
}

.burgers .burger .description{
	
}
footer{
    display: flex;
    position: fixed;
    background-color: black;
    right: 0;
    left: 0;
    bottom: 0;
    text-align: center;
    color: white;
    position: fixed;
    display: flex;
    font-family: 'Comic Sans MS', 'Comic Sans', cursive;
    padding: 10px;
}
footer section div{
    padding: 15px;
}
footer section{
    display: flex;
    width: 30%;
    justify-content: center
}
footer div:hover{
    border: 1px solid white;
}
footer div{
    border: 1px solid black;
}
footer img{
    width: 40px;
    height: 40px
}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="index.js" defer></script>
	<title></title>
</head>
<body>
<div class="navbar">
	<img src="yy.jpg" class="badge">
	<div style="color: white;margin-left: 20px">«YUFRAME BURGER»<br>PLACE THE RIGHT BURGERS</div>
	<div class="all" id="all">
		<a href="index.html" class="without">HOME</a>
		<a href="about.html" class="without">ABOUT US</a>
		<a href="burgers.html" class="without">MENU</a>
		<a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>

	</div>
</div>

<div class="burgers">
	<div class="burger">
		<img src="<?php echo $row['Src'] ?>">
		<div class="card">
			<div class='name'><?php echo $row['Name']; ?></div>
			<br><br>
			<div class="description"><?php echo $row['Description']; ?><br><?php echo $row['Consistence']  ;?></div>
			<br><br>
			<div class="price"><?php echo $row['Price'];?> tg</div>
		</div>
	</div>
</div>

<footer>
	<section>
		<div>
			<i class="fa fa-instagram" aria-hidden="true"></i>
			<a href="https://www.instagram.com/yuframe_burger/" style="color: white; text-decoration: none;">  @INSTAGRAM</a>
		</div>
		<div>
			<i class="fa fa-facebook" aria-hidden="true"></i>
			<a href="https://www.facebook.com/pg/yuframeburger/reviews/?referrer=page_recommendations_see_all" style="color: white;text-decoration: none;">  /FACEBOOK</a>
		</div>
	</section>
	<p style="margin-left: auto; margin-right: 20px">phones: +7 (727) 777 71 71, +7 708 222 24 22</p>
</footer>



</body>
</html>