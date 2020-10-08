<html>
<head>
	<title> reset-password</title>
	<title> reset-password page </title>
	<link rel="stylesheet" type="text/css" href="css/root.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <meta httpequiv="Cache-control" content="no-cache">
  <script type="text/javascript" src="js/index.js"></script>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="wikinero is a wiki site for algo and solving problems ">
    <meta name="keywords" content="HTML, CSS, JavaScript, php , algo , problems , solving , test ,  ">
    <meta name="author" content="mohssen boulahbal">
    <!--base target="_blank"-->
    <!--meta http-equiv="refresh" content="30"-->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/x-icon" href="logo.png">
    <script>
            /*function goto() {
                   window.location.assign("http://localhost/wikinero/index.php");
            }*/
            
    </script>
</head>

<body>


<div class="main" style="color:white;" id="main">
<?php

        if(isset($_GET['secusse']))
        {  
             echo"<div id='fsignup' class='modal-content'>
             <h1 style='font-size:14px'> your requst is done go to your email to
             <br> to restore your password  </h1>
             <button  type='submit' name='gohome' onclick='goto(\"http://localhost/wikinero/index.php\")'>go home</button>
             </div>
           "; 
        }
        elseif (isset($_GET['send'])) {
              $email = $_POST["mail"];

              require 'dbc.php';

              $sql = "SELECT email FROM users WHERE email=?";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt , $sql))
              {
                   header("Location: index.php?error=sqlerror");
                   exit();
              }
              else
              {
                    /* user exist */
                   mysqli_stmt_bind_param($stmt,"s", $email );
                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_store_result($stmt);
                   $resultCheck = mysqli_stmt_num_rows($stmt);
                   if($resultCheck>0)
                   {               
                       /*cheched for old request  */


                       $token = (string)bin2hex(random_bytes(8)) ;
                       $sql  = "INSERT INTO forget_pwd (email	, CREAT	,expaire	, token ,	done) VALUES ( ?,? ,?, ?, ?)";
                       $stmt = mysqli_stmt_init($conn);
                       if (!mysqli_stmt_prepare($stmt , $sql)) {
                              /*nothing sql errore */
                       }
                       else
                       {
                         /* i have a problem here !! */
                         $creat = date(DATE_W3C,time()); 
                         $expir = date(DATE_W3C,time()+60*30); 
                         //date_add($expir, date_interval_create_from_date_string("1 days")); 
                         $bit = 0 ;
                         mysqli_stmt_bind_param($stmt,"ssssi", $email , $creat, $expir  , $token , $bit );
                         mysqli_stmt_execute($stmt);
                         mysqli_stmt_store_result($stmt);
                         header("Location: forgetpwd.php?secusse=" . $email);
                         exit();

                       }


                   }
                   else
                   {
                       header("Location: forgetpwd.php?null=user");
                       exit();
                   }
              }
         }
         else if (isset($_GET['null'])) {
          echo "  <form id='fsignup' class='modal-content' name='signup' action='forgetpwd.php?send=requst' method='post' >
          <h1 style='font-size:14px'> user not found type an invalid email  : </h1>
          <input type='email' name='mail' placeholder='test@mail.com' required >
          <button type='submit' name='bsignin'>requst</button>
     </form>"; 
         }
         else {
                  echo "  <form id='fsignup' class='modal-content' name='signup' action='forgetpwd.php?send=requst' method='post' >
                  <h1 style='font-size:14px'> Enter your email to reset your password  : </h1>
                  <input type='email' name='mail' placeholder='test@mail.com' required >
                  <button type='submit' name='bsignin'>requst</button>
             </form>"; 
         }




 ?>
</div>

</body>

</html>
<?php





 ?>
