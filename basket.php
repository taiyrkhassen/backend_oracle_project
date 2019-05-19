<?php 
if (isset($_COOKIE['type'])) {
 $conn = oci_connect('assemtolen', 'Shelek123', 'localhost/XE');
if (!$conn) {
     $e = oci_error();
     trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
if(isset($_GET['pay'])){
      $sql2 = "select * from food where person_id=".$_COOKIE['type'];
      $run_query5 = oci_parse($conn,$sql2);
      oci_execute($run_query5);
    $resultat1 = "";
      while (oci_fetch($run_query5)) {
                     $resultat1 = oci_result($run_query5,1);
            }
      $sql1 = "select * from username where user_id = ".$_COOKIE['type'];
      $run_query4 = oci_parse($conn,$sql1); 
      oci_execute($run_query4);
      $resultat = "";
      while (oci_fetch($run_query4)) {
                     $resultat = oci_result($run_query4,2);
            }
      $sql = "INSERT INTO orders(customer_id,ship_date,customer_name,to_street,food_id) VALUES(".$_COOKIE['type'].",TO_DATE(SYSDATE,'yy-mm-dd'),'".$resultat."','".$_GET['street']."',".$resultat1.")";
      $compiled = oci_parse($conn, $sql);
      oci_execute($compiled);
      $sql9 = "update food set dish_id = NULL,drink_id = null,dessert_id = null where person_id = ".$_COOKIE['type'];
      $command = oci_parse($conn,$sql9);
      oci_execute($command);
}}
 ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
    var slideIndex = 0;
showSlides();


function menuFunction() {
  var a = document.getElementById("all");
  if (a.className === "all") {
    a.className += " responsive";
  } else {
    a.className = "all";
  }
}
  </script>
    <style type="text/css">
    body{
    margin: 0;
}
.add_button{
    display: inline-block;
    margin-left: 215px;
    margin-top: 120px;

    position: absolute; 



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
    body{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .navbar a{display: none;}
    .all .icon {
       float: right;
        display: block;
    }
    .all.responsive {
        position: relative; 
        display: inline-block;
        color: black; 
        background-color: #E74C3C;}
    .all.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }
  .all.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
.burgers{
    display: flex;
    justify-content: space-around;
    height: 500px;
    flex-wrap: wrap;
    
}
.burgers .burger:hover{
    border: 2px solid black;
}
.burgers .burger{
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 20em;
    padding: 5px;
}
.burgers .burger img{
    height: 50%;
    width: 100%;
}
.burgers .burger .description{
    position: relative;
    height: 50%;
    background-color: #212121;
    font-family: 'Pacifico',cursive;
    font-size: 30px;
    color:white;
    border-top: 1px solid #ffe57f;
}
.burgers .burger a{
    position: absolute;
    display: inline-block;
    color:white;
    bottom: 0;
}
footer{
    display: flex;
    flex: 1;
    background-color: black;
    text-align: center;
    color: white;
    font-family: 'Comic Sans MS', 'Comic Sans', cursive;
    padding: 10px;
    position: absolute;
    margin-top: 10px;
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
.inline{
    margin-left: auto;
    margin-left: 20%;
}
.radio{
    float: left;
    display: inline-block;
}
        body{
    margin: 0;
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
    body{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .navbar a{display: none;}
    .all .icon {
       float: right;
        display: block;
    }
    .all.responsive {
        position: relative; 
        display: inline-block;
        color: black; 
        background-color: #E74C3C;}
    .all.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }
  .all.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
footer{
    display: flex;
    flex: 1;
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
    margin-top: 10px;
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
.inline{
	margin-left: auto;
	margin-left: 20%;
}
.radio{
	float: left;
	display: inline-block;
}

	</style>
	
	<title></title>
</head>
<body>
	<div class="navbar">
	<img src="yy.jpg" class="badge">
	<div style="color: white;margin-left: 20px">«YUFRAME BURGER»<br>PLACE THE RIGHT BURGERS</div>
	<div class="all" id="all">
        <a href="basket.php" class="without"><img src="basket.jpg" style="width: 30px"></a>
		<a href="logout.php" class="without">SIGN OUT</a>
		<a href="about.html" class="without">ABOUT US</a>
		<a href="menu2.php" class="without">MENU</a>
		<a href="javascript:void(0);" class="icon" onclick="menuFunction()"><i class="fa fa-bars"></i></a>

	</div></div>

    
    <div style="margin-left: 0px auto;margin-right:0px auto;font-family: 'Comic Sans MS', 'Comic Sans', cursive;"><h1>Products: </h1></div>
    <form action = "basket.php">
        <label>type your street</label>
        <input type="text" name="street">
        <br>
        <input type="submit" name="pay">
    </form>
    <div class=inline>
        <div class="burgers">
            <?php
            if(isset($_COOKIE["type"]))
                                    {
    $r1 = "select * from desserts where dessert_id = (select dessert_id from food where person_id = ".$_COOKIE['type'].")";
        $r2 = "select * from dishes where dish_id = (select dish_id from food where person_id = ".$_COOKIE['type'].")";
    $r3 = "select * from drinks where drink_id = (select drink_id from food where person_id = ".$_COOKIE['type'].")";
    $run_query1 = oci_parse($conn,$r1);
    $run_query2 = oci_parse($conn,$r2);
    $run_query3 = oci_parse($conn,$r3);
    oci_execute($run_query1);
    oci_execute($run_query2);
    oci_execute($run_query3);
    while (oci_fetch($run_query1)) {
                     echo "<div class='burger'><img src='".oci_result($run_query1, 6)."'><div class='description'><div class='name'>".oci_result($run_query1,3)."</div><div class='price'>".oci_result($run_query1, 4)." TG</div></div></div>";
            }
            while (oci_fetch($run_query2)) {
                     echo "<div class='burger'><img src='".oci_result($run_query2, 6)."'><div class='description'><div class='name'>".oci_result($run_query2,3)."</div><div class='price'>".oci_result($run_query2, 4)." TG</div></div></div>";
            }
            while (oci_fetch($run_query3)) {
                     echo "<div class='burger'><img src='".oci_result($run_query3, 6)."'><div class='description'><div class='name'>".oci_result($run_query3,3)."</div><div class='price'>".oci_result($run_query3, 4)." TG</div></div></div>";
            }


                                                        }
    else{
    header("location: project.php");
    }                                                    




            ?>

        </div>



    </div>

</body>
</html>