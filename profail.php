<?php

  session_start(); 
  $username ;
  $nikename ; 
  $avatar ; 
  $bio ; 
  if(isset($_GET['id']))
  {
    require 'dbc.php'; 
    $sql = "SELECT * FROM users WHERE username=?;"; 
    $stmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt , $sql))
    {
        /* we need to change this !! my be use ajax here will be better but after finshing the desing  */
        header("Location: index.php?login=fiald"); 
        exit(); 
    }
    else 
    {
        mysqli_stmt_bind_param($stmt,"s",$_GET['id'] ); 
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_get_result($stmt);
        if($row= mysqli_fetch_assoc($result))
        {
          $username  = $row['username'] ;
          $avatar=  $row['avatar'] ;
          $bio = $row['bio'] ; 
          $nikename = $row['nickname'] ; 
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  } 
  else 
  {
    $username  = $_SESSION['username'] ;
    $avatar=  $_SESSION['avatar'] ;
    $bio = $_SESSION['bio'] ; 
    $nikename = $_SESSION['nikename'] ; 
  }

?>

<html lang="en">
<head>
    <title>(username)</title>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="profail.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="wiki site ">  
    <meta name="keywords" content="HTML, CSS, JavaScript, php ">
    <meta name="author" content="mohssen boulahbal ">   
    <!--base target="_blank"-->
    <meta http-equiv="refresh" content="100">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/x-icon" href="./logo.png">
    <link rel="stylesheet" type="text/css" href="css/profail.css">
    
</head>

<body >
    <div id ="navbar">
       <a href='profail.php'><span style='color: green'>&#9898;</span></a>
       <button class='left' onclick='goto("msg.php")'>&#128172</button>
        <button class='left' onclick=''> + </button>
       <button class='right' type='submit' name='logout' onclick='goto("logout.php")'>logout</button>

    </div>
       
    
      
    <div id="Profail">
        <img id="img" src='img/<?php echo $avatar."'" ?>  alt="user_avatar" style="background-color: white;" > 
           <button id="bimg" onclick="change('username')">+</button>
        </img>
        <lable id="name" ><?php echo $username ; if($nikename!=null)  echo "(".$nikename.")"  ?>  </lable>    
    </div>
    <div id="nav" >          
        <a  onclick= "fellow(username)"  >♡</a>
        <a href="#"   onclick="requst(username)" ><b> ☉ </b> </a>
        <a href=""  onclick="msgbox(username)">✉</a>
    </div> 
    
       
       
        <main>
        <div id="bio">
            <p>bio</p>
            <p><?php if($bio!=null) {echo $bio ;} 
            else 
            echo "nothing here ";  ?>  </p>
            <button id="bbio">+</button>
        </div>
          
         <div id="continer"  class="flex-count">
                
               
                <div id="post" class="element">
                    <img id="avatar" src='img/<?php echo $avatar."'" ?> >
                    <a href="profail.php?username=(username)" id="name" >@<?php echo $username ;  ?></a>     
                    <span id="date">2019/12/13</span> 
                    <button id="parmeter" name="like" class="button">°°°</button>       
                            
<p>some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjct  some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about </p>
                    
                    <button id="like" name="like" class="button">LIKE</button>
                    <button id="comment" name="comment" class="button">COMMENT</button>  
                </div>               
                <div id="post" class="element">
                    <img id="avatar" src='img/<?php echo $avatar."'" ?> >
                    <a href="profail.php?username=(username)" id="name" >@<?php echo $username ;  ?></a>     
                    <span id="date">2019/12/13</span> 
                    <button id="parmeter" name="like" class="button">°°°</button>       
                            
<p>some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjct  some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about </p>
                    
                    <button id="like" name="like" class="button">LIKE</button>
                    <button id="comment" name="comment" class="button">COMMENT</button>  
                </div>  
                <div id="post" class="element">
                    <img id="avatar" src='img/<?php echo $avatar."'" ?> >
                    <a href="profail.php?username=(username)" id="name" >@<?php echo $username ;  ?></a>     
                    <span id="date">2019/12/13</span> 
                    <button id="parmeter" name="like" class="button">°°°</button>       
                            
<p>some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjct  some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about </p>
                    
                    <button id="like" name="like" class="button">LIKE</button>
                    <button id="comment" name="comment" class="button">COMMENT</button>  
                </div>               
             
                <div id="post" class="element">
                    <img id="avatar" src='img/<?php echo $avatar."'" ?> >
                    <a href="profail.php?username=(username)" id="name" >@<?php echo $username ;  ?></a>     
                    <span id="date">2019/12/13</span> 
                    <button id="parmeter" name="like" class="button">°°°</button>       
                            
<p>some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about the subjct  some text here about the subjct some text here about the subjctsome text here about the subjctsome text here about the subjctsome text here about </p>
                    
                    <button id="like" name="like" class="button">LIKE</button>
                    <button id="comment" name="comment" class="button">COMMENT</button>  
                </div>               


        </div> 

        </main>
       

       
</body>
</html>
