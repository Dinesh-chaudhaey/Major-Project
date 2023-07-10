<?php

// function cleanQuery($string)
// {
//   if(get_magic_quotes_gpc())  // prevents duplicate backslashes// deprecated in php 7.4
//   {
//     $string = stripslashes($string);
//     //echo "#1 ##".$string; 
//   }

//   if (phpversion() >= '4.3.0')
//   {
//     $string = mysqli_real_escape_string($string); //
//     //echo "#2 ##".$string; 
//   }
//   else
//   {
//     $string = mysqli_escape_string($string);
//     //echo "#3 ##".$string; 
//   }
//   exit;
//   return $string;
// }

function cleanQuery($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}



?>