<?php
/*
=====================================
  AsproHubs Button Component
  Usage:
  include 'includes/button.php';

  echo aspro_button("Enroll Now", "aspro", "course.php");
=====================================
*/

function aspro_button($text, $type = "aspro", $link = "#") {
    $class = "";

    switch($type) {
        case "aspro":
            $class = "btn-aspro";
            break;
        case "outline":
            $class = "btn-aspro-outline";
            break;
        case "light":
            $class = "btn-aspro-light";
            break;
        default:
            $class = "btn-aspro";
    }

    return "<a href='$link' class='btn $class'>$text</a>";
}
?>
