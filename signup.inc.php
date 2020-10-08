<?php

if(isset($_POST['bsignin'])) // the name of the button
{
       $user = $_POST['username'];
       $mail = $_POST['mail'];
       $pwd = $_POST['password'];
       $rpwd = $_POST['repet-password'];

       require 'dbc.php' ;
       /* some test will be done in the withe  js */
           /// if the usename is alreay taken
           $sql = "SELECT username FROM users WHERE username=?";
           $stmt = mysqli_stmt_init($conn);
           if(!mysqli_stmt_prepare($stmt , $sql))
           {
            header("Locati   on: signup.php?error=sqlerror");
            exit();
           }
           else
           {
                mysqli_stmt_bind_param($stmt,"s", $user );
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck>0)
                {
                    header("Location: signup.php?error=usernametaken&mail=".$mail);
                    exit();
                }
                else
                {

                    $sql = "INSERT INTO users (username , email , pwd ,avatar ) VALUES (?,?,? ,?)" ;
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt , $sql))
                    {
                        header("Location: signup.php?error=usernametaken&mail=".$mail);
                        exit();
                    }
                    else
                    {
                        /* hash passwrod  */
                        $avatar = "newuser.png"; 
                        $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt,"ssss", $user , $mail , $hashpwd, $avatar );
                        mysqli_stmt_execute($stmt);
                    
                        $sql = "SELECT * FROM users WHERE username!='" . $user . "'" ;

                        $result =  mysqli_query($conn, $sql) ;   
                              
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            $sql = ""; 
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $table = ""; 
                                if(strcmp($user , $row["username"])>0) 
                                {
                                    $table = $row["username"] . "_msg_". $user;  
                                }
                                else 
                                {
                                    $table =  $user ."_msg_". $row["username"] ;
                                }

                                $sql = "CREATE TABLE " . $table.
                                 "( id int AUTO_INCREMENT PRIMARY KEY , 
                                 content longtext , 
                                 sender tinytext , 
                                 resver tinytext , 
                                 creat_time datetime , 
                                 senn bit );" ; 
                                 mysqli_query($conn, $sql) ; 
                            }
                        }
                          
                        echo '<html>  <body>  <script>  window.history.back() </script>  </body>  </html>';
                        /* or  check your email stuff */
                        
                        exit();
                    }

                }
           }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else
{     //cool
  echo '<html>  <body>  <script>  window.history.back() </script>  </body>  </html>';
  exit();
}
