<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        margin: 0%;
        padding: 0%;
    }
    
    .fname {
        padding-top: 10px;
        
    }
    
    .form {
        
        margin:auto;
        box-shadow:0px 0px 5px red;
        border-radius:5px;
        margin: 10px;
        background-color: rgb(247, 243, 238);
        font-weight: bold;
        font-size:20px;
    }

    .form form {
        margin: 10px;
        margin-right: 20px;

    }

    .tarea input {
        width: 100%;
        height: 4vh;
        margin-top: 10px;
    }

    .tarea {
        margin-top: 10px;
    }

    .option {
        margin-top: 10px;
    }

    .option select {
        height: 4vh;
        margin-top: 10px;
        width: 100%;
    }

    .skill select {
        height: 10vh;
    }

    .submit input {
        color: white;
        font-weight: bold;
        font-size: 15px;
        background-color: rgb(17, 101, 132);
        margin-top: 10px;
        margin-bottom:10px;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
    }

    .form span {
        color: red;
    }

    .gender {
        margin-top: 10px;
    }

    .education {
        margin-top: 10px;
    }
    </style>
    
    <?php include_once('SQLfunction.php')?>
    <?php 
        $row=[];
        if(isset($_REQUEST['update'])){
            $update=$_REQUEST['update'];
           // echo $update." user_id ";
            $data=fetch_data("problem9","user_data","*","0",'100',["user_id=$update"]);
           // print_r($data);
            foreach($data AS $key => $value)
            {
                $row=$value;
            }
        //    print_r($row);
        //    echo $row['user_id'];
        }
        $edu=explode(",",$row['Education']);
        $skill=explode(",",$row['skill']);
       
    ?>

</head>

<body>
    <?php 
    $firstNameError=$lastNameError=$ageError=$dobError=$genderError=$skillsError=$educationError=$address1Error=$address2Error=$stateError=$countryError="";
    $firstName=$lastName=$age=$dob=$gender=$education=$skills=$sk=$address1=$address2=$state=$country=$submited="";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["firstName"])){
        $firstNameError="*Fill the field is mandatory";
    }
    else{
        $firstName=test_input($_POST["firstName"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$firstName)){
         $firstNameError="*Only letters are allowed";   
        }
    }
    if(empty($_POST["lastName"])){
        $lastNameError="*Fill the field is mandatory";
    }
    else{
        $lastName=test_input($_POST["lastName"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$lastName)){
         $lastNameError="*Only letters are allowed";   
        } 
    }
    if(empty($_POST["age"])){
        $ageError="*Age is mandatory";
    }
    else{
        $age=test_input($_POST["age"]);
    }
    if(empty($_POST["dob"])){
        $dobError="*DOB is mandatory";
    }
    else{
        $dob=test_input($_POST["dob"]);
    }
    if(empty($_POST["gender"])){
        $genderError="*Gender field is mandatory";
    }
    else{
        $gender=test_input($_POST["gender"]);
    }
    if(empty($_POST["eduaction"])){
        $educationError="*Education field is mandatory";
    }
    else{
        $education=test_input($_POST["eduaction"]);
    }

    if(empty($_POST["skills"])){
        $skillsError="*Skills field is mandatory";
    }
    else{
        $sk=implode(',',$_POST["skills"]);
        $skills=test_input($_POST["skills"]);
    }

    if(empty($_POST["address1"])){
        $address1Error="*Address Line 1 field is mandatory";
    }
    else{
        $address1=test_input($_POST["address1"]);
    }
    if(empty($_POST["address2"])){
        $address2Error="*Address Line 2 field is mandatory";
    }
    else{
        $address2=test_input($_POST["address2"]);
    }

    if(empty($_POST["state"])){
        $stateError="*State field is mandatory";
    }
    else{
        $state=test_input($_POST["state"]);
    }

    if(empty($_POST["country"])){
        $countryError="*Country field is mandatory";
    }
    else{
        $country=test_input($_POST["state"]);
    }
    
   // $submited=test_input($_POST('submited'));
   if(isset($_POST['submit'])){
                   

    $data=update_column("user_data",
    ['user_id'=>$_REQUEST['update'],
    'First_Name'=>$firstName,
    'Last_Name'=>$lastName,
    'Age'=>$age,
    'DOB'=>$dob,
    'Gender'=>$gender,
    'Education'=>$education,
    'Address1'=>$address1,
    'Address2'=>$address2,
    'State'=>$state,
    'Country'=>$country,
    'skill'=>$sk],
    "user_id=".$_REQUEST['update']."" );
     header("LOCATION:problem16.php");
    }
}
    function test_input($data)
    {
        # check if value is array
        if(is_array($data)){
            $data = implode(",",$data);
        }
        $data=trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    
?>


    <div class="form">
        <form method="POST" action="">
       
            <div class="fname tarea">
                <label for="fname">First Name<span>*</span></label><br>
                <input type="text" name="firstName" id="fname"
                    placeholder="Enter First Name" value="<?php echo $row['First_Name']?>"><br>
                <span><?php echo $firstNameError;?></span>
            </div>
            <div class="lname tarea">
                <label for="lName">Last Name<span>*<span></label><br>
                <input type="text" name="lastName" id="lname" placeholder="Enter Last Name"  value="<?php echo $row['Last_Name']?>"><br>
                <span><?php echo $lastNameError;?></span>
            </div>
            <div class="age tarea">
                <label for="age">Age<span>*</span></label><br>
                <input type="number" name="age" id="age" placeholder="Enter Age"  value="<?php echo $row['Age']?>"><br>
                <span><?php echo $ageError;?></span>
            </div>
            <div class="dob tarea">
                <label for="dob">Date Of Birth<span>*</span></label><br>
                <input type="date" name="dob" id="dob"  value="<?php echo $row['DOB']?>"><br>
                <span><?php echo $dobError;?></span>
            </div>
            <div class="gender">
                <label for="gender">Gender<span>*</span></label><br>
                <input type="radio" name="gender" id="gender" value="male" <?php
                if($row['Gender']=='male'){ echo 'checked'; }?>>Male
                <input type="radio" name="gender" value="Female" <?php
                if($row['Gender']=='Female'){ echo 'checked'; }?> >Female<br>
                <span><?php echo $genderError;?></span>
            </div>
            <div class="education" >
                <label for="eduaction">Eduaction Qualification<span>*<span></label><br>
                <input type="checkbox" name="eduaction[]" id="eduaction" value="10th" <?php
                for($i=0;$i<count($edu);$i++){
                    if($edu[$i]=='10th'){
                         echo 'checked'; 
                    }
                    }?>>10th<br>

                <input type="checkbox" name="eduaction[]" value="12th" <?php
                 for($i=0;$i<count($edu);$i++){if($edu[$i]=='12th'){ echo 'checked'; }}?>>10+2<br>

                <input type="checkbox" name="eduaction[]" value="graduation" <?php
                 for($i=0;$i<count($edu);$i++){if($edu[$i]=='graduation'){ echo 'checked'; }}?>>Graduation<br>

                <input type="checkbox" name="eduaction[]" value="masters" <?php
                 for($i=0;$i<count($edu);$i++){if($edu[$i]=='masters'){ echo 'checked'; }}?>>Marsters<br>

                <input type="checkbox" name="eduaction[]" value="phd" <?php
                 for($i=0;$i<count($edu);$i++){if($edu[$i]=='phd'){ echo 'checked'; }}?>>PHD<br>
                <span><?php echo $educationError;?></span>
            </div>
            <div class="skill option">
                <label for="skills">Skills<span>*<span></label><br>
                <select multiple="multiple" name="skills[]" id="skills">
                    <?php

                        $result=fetch_data('problem9','skill','*');
                         
                        foreach ($result as $key => $value) {
                            foreach($skill as $val)
                            {
                                if($val==$value['id'])
                                {
                                    $selected='selected';
                                    break;
                                }   
                                else{
                                    $selected='';
                                }
                                
                            }
                            echo "<option value='".$value["id"]."' $selected 
                             >".$value["SKILLS"]."</option>";
                            
                        }
                            ?>
                    </select> 
                    <br>
                    <span><?php echo $skillsError;?></span>
            </div>
            <div class="address1 tarea">
                <label for="address1">Address Line 1<span>*<span></label><br>
                <input type="text" name="address1" id="address1"  value="<?php echo $row['Address1']?>"><br>
                <span><?php echo $address1Error;?></span>
            </div>
            <div class="address2 tarea">    
                <label for="address2">Address Line 2<span>*<span></label><br>
                <input type="text" name="address2" id="address2"  value="<?php echo $row['Address2']; ?>"><br>
                <span><?php echo $address2Error;?></span>
            </div>
            <div class="state option">
                <label for="state">State<span>*</span></label><br>
                <select name="state">
                    <?php
                        
                    $result=fetch_data('problem9','state','*');
                    echo '<option></option>';
                    foreach ($result as $key => $value) {
                        if($row['State']==$value['st_id']){ $selected ='selected';}else{ $selected='';}
                        echo "<option value='".$value["st_id"]."' $selected>".$value["stateName"]."</option>";
                    }
                    ?>
                </select><br>
                <span><?php echo $stateError;?></span>
            </div>
            <div class="country option">
                <label for="country">Country<span>*</span></label><br>
                <select name="country">
                 <?php
                    $result=fetch_data('problem9','country','*');
                    echo '<option></option>';
                    foreach ($result as $key => $value) {
                        if($row['Country']==$value['c_id']){ $selected ='selected';}else{ $selected='';}
                        echo "<option value='".$value["c_id"]."' $selected>".$value["CountryName"]."</option>";
                    }
                     ?>
                </select><br>
                <span><?php echo $countryError;?></span>
            </div>
            <div class="submit">
                <input type="submit" name="submit" value='UPDATE'><br>
            
            </div>
        </form> 
    </div>
</body>
</html>