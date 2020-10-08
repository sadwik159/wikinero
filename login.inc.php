<?php
   
   if (isset($_POST["blogin"]))
   {        
       require 'dbc.php'; 

       $adress = $_POST["username"];
       $pwd = $_POST["password"];   

       $sql = "SELECT * FROM users WHERE username=? OR email=?;"; 
       $stmt = mysqli_stmt_init($conn); 
       if(!mysqli_stmt_prepare($stmt , $sql))
       {
           /* we need to change this !! my be use ajax here will be better but after finshing the desing  */
           header("Location: index.php?login=fiald"); 
           exit(); 
       }
       else 
       {
           mysqli_stmt_bind_param($stmt,"ss", $adress , $adress  ); 
           mysqli_stmt_execute($stmt); 
           $result = mysqli_stmt_get_result($stmt);
           if($row= mysqli_fetch_assoc($result))
           {
                $pwdcheck = password_verify($pwd , $row['pwd']); 
                if($pwdcheck==false)
                {
                    /* not right two the user could be in any page when he login */
                    header("Location: index.php?error=wongpwd"); 
                    exit();
                }
                else if($pwdcheck==true) 
                {
                    session_start(); 
                    $_SESSION['id']= $row['id']; /* i am not using this shit okai */
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['avatar'] = $row['avatar'];
                    $_SESSION['bio'] = $row['bio']; 
                    $_SESSION['nikename'] = $row['nikename']; 
                    $sql = "UPDATE  users set active= 1 WHERE username='".$_SESSION['username']."'"; 
                    mysqli_query($conn, $sql);  
                    /* change this shit you do this to go to the last page but it could referch the content of the page  */
                    echo '<html>  <body>  <script>  window.history.back() </script>  </body>  </html>';
                   /* header("Location: index.php?login=sucess"); */ /// cool 
                    exit();
                }
                else 
                {
                    header("Location: index.php?error=wtf"); 
                    exit();
                }
           }
           else 
           {
                header("Location: index.php?error=nouser"); 
                exit();
           }
       }

   }
   else 
   {
       header("Location: index.php?login=fiald"); 
       exit(); 
   }

