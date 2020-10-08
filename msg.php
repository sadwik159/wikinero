<?php

   session_start();

?>
<!DOCTYPE html>

<html>
<head>
	<title> msg </title>
	<link rel="stylesheet" type="text/css" href="css/root.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/index.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="wikinero is a wiki site for algo and solving problems ">
    <meta name="keywords" content="HTML, CSS, JavaScript, php , algo , problems , solving , test ,  ">
    <meta name="author" content="mohssen boulahbal">
    <meta httpequiv="Cache-control" content="no-cache">
    <!--base target="_blank"-->
    <!--meta http-equiv="refresh" content="30"-->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/x-icon" href="logo.png">
    <script> function myFunction(event , user) {
      /* this part is for mohamed */
                          var x = event.which || event.keyCode; // event.keyCode is used for IE8 and earlier
                          if (x== 13) {  // 13 is the ENTER  key
                            send(user); 
                          }
                        }
                        </script>
</head>

<body>

<div id ="navbar">
  

   <?php

   if(isset($_SESSION['username'])) {



              echo " <a href='profail.php'><span style='color: green'>&#9898;</span></a>
              <button class='left' onclick='goto(\"msg.php\")'>&#128172</button>
            <button class='left' onclick=''> + </button>
            <button class='right' type='submit' name='logout' onclick='goto(\"logout.php\")'>logout</button>";

   }
    else
   {

    echo "<div id='id01' class='modal'>
	<form id='fsignup' class='modal-content' name='signup' action='signup.inc.php' method='post' >
        <h1>Sign Up</h1>
        <h5 id='error'> messsage !! </h5>
		<input type='text' name='username' placeholder='user159' required>
		<input type='email' name='mail' placeholder='test@mail.com' required >
		<input type='password' name='password' placeholder='*********' required>
		<input type='password' name='repet-password' placeholder='*********'' required>
		<!--select id='gender' name='gender'>
			<option value='man'>man</option>
			<option value='woman'>woman</option>
			<option value='outher'>outer</option>
		</select-->
		<button type='submit' name='bsignin'>sign up</button>
	</form>
</div>

<div id='id02' class='modal'>
	<form id='fsignup' class='modal-content' name='signup' action='login.inc.php' method='post' >
        <h1>Login</h1>
        <h5 id='error'> messsage !! </h5>
		<input type='text' name='username' placeholder='user159' required>
		<input type='password' name='password' placeholder='*********' required>
		<button type='submit' name='blogin'>login</button>
		<a href='forgetpwd.php'>forget <span style='color: blue'>password</span></a>
	</form>
</div>

  <button class='right' onclick=\"document.getElementById('id01').style.display='block'\">sign up</button>
  <button class='right' onclick=\"document.getElementById('id02').style.display='block'\">login</button>
 ";
    }
   ?>
	</div>
<script>
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2) {
        modal1.style.display = 'none';
        modal2.style.display = 'none';
    }
}
</script>

<div class="main" style="color:white;" id="main">
<?php

         if(isset($_SESSION['username'])) {

                require "dbc.php" ;
                $sql = "SELECT * FROM users WHERE username!=?";

                $stmt = mysqli_stmt_init($conn) ;
                if(!mysqli_stmt_prepare($stmt , $sql))
                {
                    header("Location: index.php?msg=fiald");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt,"s", $_SESSION['username'] );
                    mysqli_stmt_execute($stmt);
                    $nothing ="";
                    $btn="" ; 
                    $chatbox = ""; 
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row= mysqli_fetch_assoc($result))
                    {
                        /* fatch msg here is better okay  */
                        $btn .= "\n<button  class='msg_user' value='".$row['username']."' onclick='msg_box(this)' >" .  $row['username'] . "  </button>" ; 

                        $chatbox .= "\n <div class='chat'  id='" . $row['username'] .  "'>" 
                        ."<a  href='profail.php?id=" .$row['username'] . "'>@" . $row['username'] ."</a>
                        <div class='msg_box' id='" .$row['username'] ."_msg_box'>  </div>" .
                        "<input id='" .$row['username'] ."_msg' onkeydown='myFunction(event , \"".$row['username']."\")' type='text' name='msg' >
                      
                          <button type='submit' name='send'  onclick='send(\"".$row['username']."\")' >send</button >
                        </div>" ; 

                    }  
                    echo "<div class='side'>". $btn ."</div>";               
                    echo "<div class='mind'>". $chatbox ."</div>"; 
                  
                }


                mysqli_close($conn); 
      }


?>


</div>



</body>
</html>
