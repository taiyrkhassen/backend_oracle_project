<?php

    # code..
$conn = oci_connect('assemtolen', 'Shelek123', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
if (isset($_POST['add']) && isset($_COOKIE["type"])) {
    # code...
    $type = $_POST['type'];
    $id = $_POST['id'];
    $price = 0;
    $price1 = 0;
    if ($type == "dishes") {
    $update = "update food SET dish_id = '".$id."' WHERE person_id=".$_COOKIE["type"]."";
    $stmt = oci_parse($conn, $update);
    oci_execute($stmt); 
    $stmt123 = oci_parse($conn, "select * from dishes where DISH_ID = ".$id );
    oci_execute($stmt123);
    while (oci_fetch($stmt123)) {
        # code...
        $price1 = oci_result($stmt123, 'DISH_PRICE');
    }   }
    elseif($type == "drinks"){
        $update = "update food SET drink_id = '".$id."' WHERE person_id=".$_COOKIE["type"]."";
    $stmt = oci_parse($conn, $update);
    oci_execute($stmt);
    $stmt123 = oci_parse($conn, "select DRINK_PRICE from drinks where DRINK_ID = ".$id );
    oci_execute($stmt123);
    while (oci_fetch($stmt123)) {
        # code...
        $price1 = oci_result($stmt123, 'DRINK_PRICE');
    }
    }
    else{
        $update = "update food SET dessert_id = '".$id."' WHERE person_id=".$_COOKIE["type"]."";
    $stmt = oci_parse($conn, $update);
    oci_execute($stmt);
    $stmt123 = oci_parse($conn, "select DESSERT_PRICE from desserts where DESSERT_ID = ".$id );
    oci_execute($stmt123);
    while (oci_fetch($stmt123)) {
        # code...
        $price1 = oci_result($stmt123, 'DESSERT_PRICE' );
    }
    }
    $stmt12 = oci_parse($conn, "select food_price from food where person_id = ".$_COOKIE["type"] );
    oci_execute($stmt12);
    while (oci_fetch($stmt12)) {
        # code...
        $price = oci_result($stmt12, 'FOOD_PRICE');
    }
    $result = (int)$price+(int)$price1;
    $update1 = "update food SET food_price = '".$result."' WHERE person_id=".$_COOKIE["type"]."";
    $stmt = oci_parse($conn, $update1);
    oci_execute($stmt);
}
if (isset($_POST['menu1'])) {
    $sql1 =  "select * from DISHES where dish_name like '%HotDog%'";
    $stid1 = oci_parse($conn, $sql1);
    oci_execute($stid1);
    }

if (isset($_POST['menu2'])) {
        $sql2 = "select * from DISHES where dish_name like '%Burger%'";
        $stid2 = oci_parse($conn, $sql2);
        oci_execute($stid2);

    }    
    if (isset($_POST['menu3'])) {
        $sql3 = 'select * from drinks';
        $stid3 = oci_parse($conn, $sql3);
        oci_execute($stid3);

    }
    if (isset($_POST['menu4'])) {
        $sql4 = 'select * from desserts';
        $stid4 = oci_parse($conn, $sql4);
        oci_execute($stid4);
    }
if (!isset($_POST['menu1']) && !isset($_POST['menu2']) && !isset($_POST['menu3']) && !isset($_POST['menu4'])) {
        $sql1 =  "select * from DISHES where dish_name like '%HotDog%'";
        $sql2 = "select * from DISHES where dish_name like '%Burger%'";
        $sql3 = 'select * from drinks';
        $sql4 = 'select * from desserts';
        $stid1 = oci_parse($conn, $sql1);
        $stid2 = oci_parse($conn, $sql2);
        $stid3 = oci_parse($conn, $sql3);
        $stid4 = oci_parse($conn, $sql4);
        oci_execute($stid1);
        oci_execute($stid2);
        oci_execute($stid3);
        oci_execute($stid4);
}

if (isset($_POST['sort'])) {
    $sort = "";
    if (!empty($sql1)) {
        if (!empty($sort)) {
            $sort = $sort." UNION ".$sql1;
        }
        else{
        $sort = $sort.$sql1;}
    }
    if (!empty($sql2)) {
        if (!empty($sort)) {
            $sort = $sort." UNION ".$sql2;
        }
        else{
        $sort = $sort.$sql2;}
    }
    if (!empty($sql3)) {
        if (!empty($sort)) {
            $sort = $sort." UNION ".$sql3;
        }
        else{
        $sort = $sort.$sql3;}    }
    if (!empty($sql4)) {
        if (!empty($sort)) {
            $sort = $sort." UNION ".$sql4;
        }
        else{
        $sort = $sort.$sql4;}
    }
    if (!empty($sort)) {
            $sort = $sort." ORDER BY 4 ";
            if ($_POST['sort'] == "asc") {
                $sort = $sort."asc";
            }
            else{
                $sort = $sort."desc";
            }
            $stid = oci_parse($conn, $sort);
            oci_execute($stid);
    }


}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
    var slideIndex = 0;


function menuFunction() {
  var a = document.getElementById("all");
  if (a.className === "all") {
    a.className += " responsive";
  } else {
    a.className = "all";
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
	</style>
	
	<title></title>
</head>
<body>
	<div class="navbar">
	<img src="yy.jpg" class="badge">
	<div style="color: white;margin-left: 20px">«YUFRAME BURGER»<br>PLACE THE RIGHT BURGERS</div>
    <div class="search">
        <form action="menu2.php" method="post">

        Search: <input name = "search_text" type="text" placeholder="Search" id="search_text"> <input name="search_bt" type="submit" class="search_button" value="Search" />

        </form>
    </div>
	<div class="all" id="all">
        <?php 
        if (isset($_COOKIE['type'])) {
            if ($_COOKIE['type']==1) {
                echo "<a href='logout.php' class='without'>SIGN OUT</a><a href='project.php' class='without'>ADMIN</a>";
            }
            else{
                echo "<a href='basket.php' class='without'><img src='basket.jpg' style='width: 30px'></a>
                        <a href='logout.php' class='without'>SIGN OUT</a>";
            }
        }
        else{
            echo "<a href='login.php' class='without'>SIGN IN</a><a href='registration.php' class='without'>SIGN UP</a>";

        }

         ?>
		<a href="about.html" class="without">ABOUT US</a>
		<a href="menu2.php" class="without">MENU</a>
		<a href="javascript:void(0);" class="icon" onclick="menuFunction()"><i class="fa fa-bars"></i></a>

	</div>
</div>
<FORM  method ="post" action ="menu2.php">
	<div class = "radio">
        <input type="checkbox" name="menu1" value="burger"> Hot-Dogs<br>
		<input type="checkbox" name="menu2" value="hotdog"> Burgers<br>
		<input type="checkbox"name="menu3" value="dessert"> Drinks<br>
		<input type="checkbox" name="menu4" value="drink"> Desserts<br>
        <br>
        <input type="radio"name="sort" value="asc"> Sort Ascending<br>
        <input type="radio" name="sort" value="desc"> Sort Descending<br>
        <input type="submit" name="submit1" value="go">
    </div>
</FORM>
<div class="inline">
	<div class="burgers">

	<?php
    $r1 = "dishes";
            $r2 = "desserts";
            $r3 = "drinks";
    if(isset($_POST['search_text'])){

            $keyword = $_POST['search_text'];
            $sql= "SELECT * FROM DISHES WHERE lower(dish_name) LIKE lower('%".$keyword."%')";
            $two = "SELECT * FROM DESSERTS WHERE lower(DESSERT_NAME) LIKE lower('%".$keyword."%')";
            $three = "SELECT * FROM DRINKS WHERE lower(DRINK_NAME) LIKE lower('%".$keyword."%')";
            $run_query = oci_parse($conn, $sql);
            $run_query1 = oci_parse($conn, $two);
            $run_query2 = oci_parse($conn, $three);
            
            oci_execute($run_query);
            oci_execute($run_query1);
            oci_execute($run_query2);
            while (oci_fetch($run_query)) {
                     echo "<div class='burger'><img src='".oci_result($run_query, 6)."'><div class='description'><div class='name'>".oci_result($run_query,3)."</div><div class='price'>".oci_result($run_query, 4)." TG</div><a href='burgers.php?id=".oci_result($run_query, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($run_query, 1).">
    <input type='hidden' name='type' value = ".$r1.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }
            
            while (oci_fetch($run_query1)) {
                     echo "<div class='burger'><img src='".oci_result($run_query1, 6)."'><div class='description'><div class='name'>".oci_result($run_query1,3)."</div><div class='price'>".oci_result($run_query1, 4)." TG</div><a href='burgers.php?id=".oci_result($run_query1, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($run_query1, 1).">
    <input type='hidden' name='type' value = ".$r2.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }
            while (oci_fetch($run_query2)) {
                     echo "<div class='burger'><img src='".oci_result($run_query2, 6)."'><div class='description'><div class='name'>".oci_result($run_query2,3)."</div><div class='price'>".oci_result($run_query2, 4)." TG</div><a href='burgers.php?id=".oci_result($run_query2, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($run_query, 1).">
    <input type='hidden' name='type' value = ".$r3.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }
        }
    elseif (!isset($_POST['sort'])) {
        # code...
        if (!empty($sql1)) {
            while (oci_fetch($stid1)) {
             echo "<div class='burger'><img src='".oci_result($stid1, 'URL')."'><div class='description'><div class='name'>".oci_result($stid1, 'DISH_NAME')."</div><div class='price'>".oci_result($stid1, 'DISH_PRICE')." TG</div><a href='burgers.php?id=".oci_result($stid1, 'DISH_ID')."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid1, 1).">
    <input type='hidden' name='type' value = ".$r1.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
        }
        }
        if (!empty($sql2)) {
            while (oci_fetch($stid2)) {
             echo "<div class='burger'><img src='".oci_result($stid2, 'URL')."'><div class='description'><div class='name'>".oci_result($stid2, 'DISH_NAME')."</div><div class='price'>".oci_result($stid2, 'DISH_PRICE')." TG</div><a href='burgers.php?id=".oci_result($stid2, 'DISH_ID')."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid2, 1).">
    <input type='hidden' name='type' value = ".$r1.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }   
        }
		if (!empty($sql3)) {
            while (oci_fetch($stid3)) {
            echo "<div class='burger'><img src='".oci_result($stid3, 'URL')."'><div class='description'><div class='name'>".oci_result($stid3, 'DRINK_NAME')."</div><div class='price'>".oci_result($stid3, 'DRINK_PRICE')." TG</div><a href='burgers.php?id=".oci_result($stid3, 'DRINK_ID')."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid3, 1).">
    <input type='hidden' name='type' value = ".$r2.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }
        }
        if (!empty($sql4)) {
            while (oci_fetch($stid4)) {
            echo "<div class='burger'><img src='".oci_result($stid4, 'URL')."'><div class='description'><div class='name'>".oci_result($stid4, 'DESSERT_NAME')."</div><div class='price'>".oci_result($stid4, 'DESSERT_PRICE')." TG</div><a href='burgers.php?id=".oci_result($stid4, 'DESSERT_ID')."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid4, 1).">
    <input type='hidden' name='type' value = ".$r3.">
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
            }
        }
    } else {
            if (!empty($sort)) {
                while (oci_fetch($stid)) {
                    if (oci_field_name($stid, 3) == "DESSERT_NAME") {
                        # code...
                 echo "<div class='burger'><img src='".oci_result($stid, 6)."'><div class='description'><div class='name'>".oci_result($stid, 3)."</div><div class='price'>".oci_result($stid, 4)." TG</div><a href='burgers.php?id=".oci_result($stid, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid, 1).">
    <input type='hidden' name='type' value = desserts>
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";}
                    elseif (oci_field_name($stid, 3) == "DISH_NAME") {
                        # code...
                        echo "<div class='burger'><img src='".oci_result($stid, 6)."'><div class='description'><div class='name'>".oci_result($stid, 3)."</div><div class='price'>".oci_result($stid, 4)." TG</div><a href='burgers.php?id=".oci_result($stid, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid, 1).">
    <input type='hidden' name='type' value = dishes>
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
                    }
                    else{
                        echo "<div class='burger'><img src='".oci_result($stid, 6)."'><div class='description'><div class='name'>".oci_result($stid, 3)."</div><div class='price'>".oci_result($stid, 4)." TG</div><a href='burgers.php?id=".oci_result($stid, 1)."'>More</a><div class='add_button'><form method='post' action='menu2.php'>
    <input type='hidden' name='id' value = ".oci_result($stid, 1).">
    <input type='hidden' name='type' value = drinks>
    <input type='submit' name='add' value='add to basket'>
</form></div></div></div>";
                    }
                }
            }
        }
	
      
	?>
    <!-- <script type="text/javascript">
          $("#search_button").click(function(){
            $("burger").html("<h3>Loading...</h3>");
            var keyword = $("#search_text").val();
              if(keyword != ""){
               $.ajax({
               url  : "menu2.php",
               method : "POST",
               data : {search:1,keyword:keyword},
               success : function(data){ 
                $("#burger").html(data);
                if($("body").width() < 480){
                 $("body").scrollTop(683);
                }
               }
              })
            }
         });
    </script> -->
    <?php 
        
        

     ?>
   
	</div>
</div>
	
	<!-- <footer>
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
		<p style="margin-left: auto; margin-right: 20px">phones: +7 (727) 777 71 71<br> +7 708 222 24 22</p>
		
	</footer>
 -->
</body>
</html>