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
        .name input{
            width:60%;
            height:8vh;
            text-align:center;   
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
        .submit input{
            width:50%;
            height:6vh;
        }
        .submit{
            padding-bottom:20px;
        }
    </style>
</head>
<body>
    <?php
        include_once('SQLfunction.php');
        $name=$email=$password='';
        $nameError=$emailError=$passwordError='';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["name"])){
                $nameError="*Fill the field is mandatory";
            }
            else{
                $name=test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                 $nameError="*Only letters are allowed";   
                }
            }
            if(empty($_POST["email"])){
                $emailError="*Fill the field is mandatory";
            }
            else{
                $email=test_input($_POST["email"]);
            }
            if(empty($_POST["password"])){
                $passwordError="*Fill the field is mandatory";
            }
            else{
                $password=test_input($_POST["password"]);
            }
        }
        function test_input($data)
        {
            $data=trim($data);
            $data=stripcslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        $count=0;
        if(isset($_POST['sign_up']))
        {
                $result=fetch_data('problem9','post_data','email,PSWD');
                foreach($result As $key=>$value)
                {
                    if($email==$value['email'])
                    {
                        echo "This Email Address already Exist in Database";
                        $count++;
                        break;
                    }
                }    
            if($count==0){
                if($name=='' || $email=='' || $password=='')
                {
                    echo "*Please fill the complete form without any Error";
                }
                else{
                    insert_data("post_data",['Name','Email','PSWD'],[[$name,$email,$password]]);
                    echo "*Sign up Successfully";
                    header("LOCATION:sign_in.php");
                }
            }
    }   
    ?>

    <div class="container">
        <form action="" method="POST">
            <div class="name all">
                <input type="text" name="name" placeholder="Enter your name"><br>
                <span><?php echo $nameError;?></span>
            </div>
            <div class ="email all">
                <input type="email" name="email" placeholder="Enter your Email"><br>
                <span><?php echo $emailError;?></span>
            </div>
            <div class="password all">
                <input type="password" name="password" placeholder="Enter your password" ><br>
                <span><?php echo $passwordError;?></span>
            </div>
            <div class="submit all">
                <input type="submit" name=sign_up>
            </div>
        </from> 
    </div>
</body>
</html>