<?php
session_start(); 
$from = $_SESSION['username']; 
require "dbc.php"; 


 if ($_GET['new_msg'])
{
  $to=$_GET['new_msg'] ; 
  $table = ""; 
  $return = ""; 
  if(strcmp($_SESSION['username'] , $to)>0) 
  {
      $table = $to . "_msg_". $_SESSION['username'];   
  }
  else 
  {
      $table =  $_SESSION['username']  ."_msg_".  $to;
  }

  $new_msg =  "SELECT *  FROM " .$table ." WHERE senn=0 and resver = '". $from . "' ;" ; 
  $res =  mysqli_query($conn, $new_msg) ; 
  if (mysqli_num_rows($res) > 0) 
      {
          while($row = mysqli_fetch_assoc($res))
          {
            $return = $return . '<p  >'. $row['content'] . '</p>'; 
          }
      }
  }
  $salam =  "UPDATE " . $table . " set senn=1 where resver= '" . $from ."'" ; 
  if (mysqli_query($conn, $salam)) {
     
  } else {
      echo "Error changing : " . mysqli_error($conn);
  }
  echo $return ;
  mysqli_close($conn); 

?>