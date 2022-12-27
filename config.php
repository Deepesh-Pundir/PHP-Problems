<?php
include_once ('SQLfunction.php');
/* Attempt to connect to MySQL database */
//$link = mysqli_connect('localhost', 'root', '', 'problem9');
$link=conn('problem9');
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}else{
    // echo "connected";
}
//

if(isset($_POST['submit']))
{
    $First_Name=$_POST['firstName'];
    $Last_Name=$_POST['lastName'];
    $Age=$_POST['age'];
    $DOB=$_POST['dob'];
    if(isset($_POST['gender'])){
        $Gender=$_POST['gender'];
    }
    else {
        $Gender='';
    }
    if(isset($_POST['eduaction'])){
        $Education=$_POST['eduaction'];
        $chk=implode(",",$Education);
    }
    else{
        $Education='';
    }
    if(isset($_POST['skills'])){
        $Skills=$_POST['skills'];
        $sk=implode(",",$Skills);
    }
    else{
        $Skills='';
    }
    $Address1=$_POST['address1'];
    $Address2=$_POST['address2'];
    $State=$_POST['state'];
    $Country=$_POST['country'];

    if(($First_Name==''||is_numeric($First_Name)) || ($Last_Name==''||is_numeric($Last_Name))|| $Age==''||$DOB==''||$Gender==''||$Education==''||$Skills==''||$Address1==''||$Address2==''||$State==''||$Country==''){
        ?>
       <p style="color:red; font-weight:bold; font-size:30px; text-align:center; text-decoration:underline;"> <?php echo "*Pls Fill The Complete Form Without Any Error";?><p>
        <?php
    }
    else{
    // $sql="INSERT INTO user_data(`First_Name`,`Last_Name`,`Age`,`DOB`,`Gender`,`Education`,`Address1`,`Address2`,`State`,`Country`,`skill`)
    // values('$First_Name','$Last_Name','$Age','$DOB','$Gender','$chk','$Address1','$Address2','$State','$Country','$sk')";
    
   $sql=insert_data("user_data",['First_Name','Last_Name','Age','DOB','Gender','Education','Address1','Address2','State','Country','skill'],[[$First_Name,$Last_Name,$Age,$DOB,$Gender,$chk,$Address1,$Address2,$State,$Country,$sk]]);
    if($sql)
    {           
        ?>
        <p style="color:red; font-weight:bold; font-size:30px; text-align:center; text-decoration:underline;"> <?php echo "*Data Submited Successfully";?><p>
         <?php
    }
    else{
        echo "ERROR".mysqli_error($link);
    }
    }
}

?>