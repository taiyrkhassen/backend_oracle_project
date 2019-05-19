<?php
   session_start(); 
   $id = 0;
   $conn = oci_connect('assemtolen', 'Shelek123', 'localhost/XE');
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
   $name ='';
   $src='';
   $consistence='';
   $price=0;
   $update = false;
   if(isset($_POST['submit'])){
    $burger = $_POST['name'];
    $price = $_POST['price'];
    $consistence = $_POST['consistence'];
    $src = $_POST['src'];
    $dish = $_POST['nameofdish'];
    if ($dish=='DISHES') {
      $sql = "INSERT INTO DISHES(dish_name,dish_consist,URL,dish_price) VALUES('".$burger."', '".$consistence."', '".$src."', ".$price.")";
      $compiled = oci_parse($conn, $sql);
      echo $sql;
      oci_execute($compiled);
    }
    elseif ($dish == 'DESSERTS') {
      $sql = "INSERT INTO desserts(dessert_name,dessert_consist,url,dessert_price) VALUES('".$burger."', '".$consistence."', '".$src."', ".$price.")";
      $compiled = oci_parse($conn, $sql);
      oci_execute($compiled);
    }
    elseif ($dish == 'DRINKS') {
      $sql = "INSERT INTO DRINKS(drink_name,drink_consist,URL,drink_price) VALUES('".$burger."', '".$consistence."', '".$src."', ".$price.")";
      $compiled = oci_parse($conn, $sql);
      oci_execute($compiled);
    }
      $_SESSION['message'] = "Addition has been saved";
      header("location: project.php");
   }
   if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $type = $_GET['type'];
    $var = '';
         if($type=='dishes'){
            $var = 'dish_id';
         }else if($type=='drinks'){
            $var = 'drink_id';
         }else if($type=='desserts'){
            $var = 'dessert_id';
         }
    $stmt = "delete from ".$type." where ".$var." =".$id;
    $s = oci_parse($conn, $stmt);
    oci_execute($s);
    $_SESSION['message'] = "Record has been deleted";
                    header("location: project.php");
   }
   $var = '';
   if (isset($_GET['edit'])) {
         $type = $_GET['type'];
         $id = $_GET['edit'];
         $var = '';
         if($type=='dishes'){
            $var = 'dish_id';
         }else if($type=='drinks'){
            $var = 'drink_id';
         }else if($type=='desserts'){
            $var = 'dessert_id';
         }

         $sql = "SELECT * FROM ".$type." WHERE ".$var." = ".$id;
         $stid = oci_parse($conn, $sql);
         oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
        if ($type == "dishes") {
          # code...
          $name = $row['DISH_NAME'];
          $src = $row['URL'];
          $consistence = $row['DISH_CONSIST'];
          $price = $row['DISH_PRICE'];
          $update = true;}
          elseif ($type == "drinks") {
          # code...
          $name = $row['DRINK_NAME'];
          $src = $row['URL'];
          $consistence = $row['DRINK_CONSIST'];
          $price = $row['DRINK_PRICE'];
          $update = true;}
          elseif ($type == "desserts") {
          # code...
          $name = $row['DESSERT_NAME'];
          $src = $row['URL'];
          $consistence = $row['DESSERT_CONSIST'];
          $price = $row['DESSERT_PRICE'];
          $update = true;}
}
oci_free_statement($stid);
   }
   if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $burger = $_POST['name'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $consistence = $_POST['consistence'];
            $src = $_POST['src'];
                if ($type=='dishes') {
            $update = "update dishes SET dish_name='".$burger."',dish_price =".$price.",url='".$src."',dish_consist='".$consistence."' WHERE dish_id=".$id."";
            echo $update;
            $stmt = oci_parse($conn, $update);
            oci_execute($stmt);

          }
            elseif ($type=='drinks') {
            $update = "update drinks SET drinks_name='".$burger."',drink_price ='".$price."',url='".$src."',drink_consist='".$consistence."' WHERE drink_id='".$id."';";
            $stmt = oci_parse($conn, $update);
            oci_execute($stmt);

          }
            elseif ($type=='desserts') {
            $update = "update desserts SET dessert_name='".$burger."',dessert_price ='".$price."',url='".$src."',dessert_consist='".$consistence."' WHERE dessert_id='".$id."';";
            $stmt = oci_parse($conn, $update);
            oci_execute($stmt);

          }
            $_SESSION['message'] = 'update successfully has done ';
                header("location: project.php");
          }
?>
