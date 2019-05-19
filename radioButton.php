<?php
$burger_status = 'unchecked';
    $hotdog_status = 'unchecked';
    $dessert_status = 'unchecked';
    $drink_status = 'unchecked';

    if (isset($_POST['Submit1'])) {
         $selected_radio = $_POST['menu_all'];

         if ($selected_radio == 'burger') {
                $burger_status = 'checked';
          }
          else if ($selected_radio == 'hotdog') {
                $hotdog_status = 'checked';
          }
          else if ($selected_radio == 'dessert') {
                $dessert_status = 'checked';
          }
          else if ($selected_radio == 'drink') {
                $drink_status = 'checked';
          }
    }
?>