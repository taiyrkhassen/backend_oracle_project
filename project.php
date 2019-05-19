<!DOCTYPE html>
<html>
<head>
 <script>
 function validsettings()                                    
{ 
    var name = document.forms['menumaker']["name"];               
    var description = document.forms['menumaker']["description"];    
    var consistence =  document.forms['menumaker']["consistence"];  
    var src = document.forms['menumaker']["src"];  
    var type = document.forms['menumaker']["type"];
   
    if (name.value == "")                                  
    { 
        window.alert("Please enter burger's name."); 
        return false; 
    } 
    if (price.value == "")                               
    { 
        window.alert("Please enter price."); 
        return false; 
    } 
       
    if (description.value == "")                                   
    { 
        window.alert("Please enter description address."); 
        return false; 
    } 
   
    if (consistence.value == "")                           
    { 
        window.alert("Please enter consistence."); 
        return false; 
    } 
   
    if (src.value == "")                        
    { 
        window.alert("Please enter path to image"); 
        return false; 
    } 
    return true; 
}</script> 
 <style>
 
 .logout a{
 right: 0;
 background-color:green;
 padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;  
 }
 @media screen and (max-width: 600px) {
  input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
 a{
  display: inline-block;
  margin: 10px; 
 }
 a:link, a:visited {
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
input[type=submit] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
}
 input[type=text], textarea {
  font-size: 16px;  
  width: 100%;
  padding-top: 12px;
  padding-bottom: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
 <div class="logout"><a href="logout.php">Logout</a></div>
 <?php require_once 'operation.php'; 
 ?>
 <?php 
 if (isset($_SESSION['message'])) {
   echo "<script type='text/javascript'>alert('".$_SESSION['message']."');</script>";
   unset($_SESSION['message']);
  }
   ?>

 <?php 
 if(!isset($_COOKIE["type"]))
{
 header("location:login.php");
}

elseif (isset($_COOKIE["type"])) {
  # code...
  $conn = oci_connect('assemtolen', 'Shelek123', 'localhost/XE');
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

        $stid1 = oci_parse($conn, "select * from DISHES");
        $stid3 = oci_parse($conn, 'select * from DRINKS');
        $stid4 = oci_parse($conn, 'select * from DESSERTS');
        oci_execute($stid1);
        oci_execute($stid3);
        oci_execute($stid4);
     ?>
     <div class="row">
      <table class="table">
       <thead>
     <tr>
      <th>Name of Food</th>
      <th>Path for image</th>
      <th>Consistence</th>
      <th>Price</th>
      <th colspan="2">Settings</th>
     </tr> 
       </thead>
       <?php 
        while (oci_fetch($stid1)) {
         echo "<tr>";
         echo "<td>".oci_result($stid1, 'DISH_NAME')."</td>";
         echo "<td>".oci_result($stid1, 'URL')."</td>";
         echo "<td>".oci_result($stid1, 'DISH_CONSIST')."</td>";
         echo "<td>".oci_result($stid1, 'DISH_PRICE')."</td>";
         echo "<td>";
         echo "<a href='project.php?type=dishes&edit=".oci_result($stid1, 'DISH_ID')."' style = 'background-color: blue;'>Edit</a>";
         echo "<a href='operation.php?type=dishes&delete=".oci_result($stid1, 'DISH_ID')."' style = 'background-color: red;'>Delete</a>";
         echo "</td>";
         echo "</tr>";
        }
            while (oci_fetch($stid3)) {
              echo "<tr>";
              echo
"<td>".oci_result($stid3, 'DRINK_NAME')."</td>";
              echo "<td>".oci_result($stid3, 'URL')."</td>";
              echo "<td>".oci_result($stid3, 'DRINK_CONSIST')."</td>";
              echo "<td>".oci_result($stid3, 'DRINK_PRICE')."</td>";
              echo "<td>";
              echo "<a href='project.php?type=drinks&edit=".oci_result($stid3, 'DRINK_ID')."' style = 'background-color: blue;'>Edit</a>";
              echo "<a href='operation.php?type=drinks&delete=".oci_result($stid3, 'DRINK_ID')."' style = 'background-color: red;'>Delete</a>";
              echo "</td>";
              echo "</tr>";
            }
            while (oci_fetch($stid4)) {
              echo "<tr>";
              echo "<td>".oci_result($stid4, 'DESSERT_NAME')."</td>";
              echo "<td>".oci_result($stid4, 'URL')."</td>";
              echo "<td>".oci_result($stid4, 'DESSERT_CONSIST')."</td>";
              echo "<td>".oci_result($stid4, 'DESSERT_PRICE')."</td>";
              echo "<td>";
              echo "<a href='project.php?type=desserts&edit=".oci_result($stid4, 'DESSERT_ID')."' style = 'background-color: blue;'>Edit</a>";
              echo "<a href='operation.php?type=desserts&delete=".oci_result($stid4, 'DESSERT_ID')."' style = 'background-color: red;'>Delete</a>";
              echo "</td>";
              echo "</tr>";
            }
        ?>

      </table>
     </div>
<form action="operation.php" method="POST" onsubmit="return validsettings()" name="menumaker">
       <div id="data">
         <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <label>subclass of food</label>
            <select name="nameofdish">
                <option value="DISHES">dishes</option>
                <option value="DRINKS">drinks</option>
                <option value="DESSERTS">desserts</option>
            </select>
            <label>Name of Dish</label>
            <input type="text" name="name" value="<?php echo $name ?>" placeholder = "enter the name of the dish"><br>
            <br>
            <label>Price</label>
            <input type="number" name="price" placeholder = "enter price"><br>
            <label>Consistence</label>
            <textarea id = "consistence" name="consistence" placeholder = "enter consistence" style="height: 200px;"><?php echo $consistence ?></textarea>
            <br>
            <label>Src</label>
            <input type="text" name="src" value="<?php echo $src ?>" placeholder = "enter path"><br>
        </div>
    <?php 
           if ($update == true) {
            echo "<input type='submit' value='update' name='update' style = 'background-color:blue'>";

           }
           else{
            echo "<input type='submit' value='submit' name='submit'>";
           }}
           ?>
     </form>
</body>
</html>