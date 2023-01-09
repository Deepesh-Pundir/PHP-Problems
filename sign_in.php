<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin:0%;
            padding:0%;
            display:flex;
            justify-content:center;
        }
        .container{
            width:50%;
            border:2px solid black;
            text-align:center;
            margin:30px;
        }
        .all{
            padding-top:35px;
        }
        .email input{
            width:60%;
            height:8vh;
            text-align:center;   
        }
        .password input{
            width:60%;
            height:8vh;
            text-align:center;   
        }
        .login input{
            width:50%;
            height:6vh;
        }
        .login{
            padding-bottom:20px;
        }
    </style>
</head>
<body>

<?php
      session_start();
     include_once('SQLfunction.php');
     $email=$password='';
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST['email'];
        $password=$_POST['password'];
     }
     $result='';
     $error=false;
     if(isset($_POST['sign_in']))
     {
        $result=fetch_data('problem9','post_data','email,PSWD,Name');
     //print_r($result);
     
     foreach($result As $key=>$value)
     {    
            if($email==$value['email'] && $password==$value['PSWD'])
            {
                echo $value['email']."<br>".$value['PSWD'];
                $_SESSION['login']=true;
                $_SESSION['Name']=$value['Name'];
                echo $_SESSION['Name']; 
                header("LOCATION:category.php");
                break;      
            }
            else{
                
                  $error=true;
            }
     }
     if($error)
     {
        echo "Please Enter valid Email And Password";
     }
    }
?>
    <div class="container">
        <form action="" method="POST">
            <div class="email all">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class ="password all">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="login all">
                <input type="submit" name="sign_in" value="Login">
            </div>
            <div class="login all">
                <a href="sign_up.php">Don't have any Account/Please Signup</a>
            </div>
        </from>
    </div>
</body>
</html>