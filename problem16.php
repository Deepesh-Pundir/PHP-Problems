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
            box-sizing:border-box
        }
        .table{
            font-family:sans-serif;   
           
        }
        table{
            border-collapse:collapse;

        }
        thead tr th{
            padding:8px 4px;
            background-color:#2E8B57;
            color:white;
            font-size:14px;
            border-radius:5px;  
        }
        tbody tr:nth-child(even){
            
            background-color:#F0FFFF;
            color:#2E8B57;
            font-weight:bold;
        }
        tbody tr td{
            padding:8px 4px;
            font-weight:bold;
            font-size:12px;
            text-align:center;
        }
    </style>
    <?php
        include_once('SQLfunction.php');
        $result=inner_join("user_id, First_Name,Last_Name,Age,DOB,Gender,Education,Address1,Address2,state.stateName As State ,country.CountryName As Country,skill","user_data",["state"=>['user_data'=>'State','state'=>'st_id'],"country"=>['user_data'=>'country','country'=>'c_id']]);

        if(isset($_REQUEST['del'])){
            $delete=$_REQUEST['del'];
            //echo $delete." user_id ";
            $res=delete_row('user_data','user_id',$delete);
            // if($res){
            //     header("LOCATION:problem16.php");
            // }
        }
    ?>  
</head>
<body>
    <div class="container">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>user_id</th>
                        <th>First_Name</th>
                        <th>Last_Name</th>
                        <th>Age</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Education</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Skills</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            foreach($result AS $key => $row){
                            
                                 ?>
                                <tr>
                                <td><?php echo $row['user_id']?></td>
                                <td><?php echo $row['First_Name']?></td>
                                <td><?php echo $row['Last_Name']?></td>
                                <td><?php echo $row['Age']?></td>
                                <td><?php echo $row['DOB']?></td>
                                <td><?php echo $row['Gender']?></td>
                                <td><?php echo $row['Education']?></td>
                                <td><?php echo $row['Address1']?></td>
                                <td><?php echo $row['Address2']?></td>
                                <td><?php echo $row['State']?></td>
                                <td><?php echo $row['Country']?></td>
                                <td><?php
                            
                            $val = "";
                            $val1=$row['skill'];
                            $res=fetch_data("problem9","skill","SKILLS",0,25,["id","($val1)"],['IN']);
                           //print_r($res);
                                foreach($res AS $key => $value)
                                {       
                                    foreach($value as $val2){
                                    $val.=$val2.",";}
                                }
                                $val=rtrim($val,",");
                                echo $val;
                            ?></td>
                                <td><a href="update.php ?update=<?php echo $row['user_id'];?>"><img src="image/428441-200.png" height="25px"></td>
                                <td><a href="problem16.php ?del=<?php echo $row['user_id']; ?>"><img src="image/100421-200.png" height="25px"></td>
                                </tr>
                                <?php
                        }                     
                        ?>
                
                </tbody>
                
            </table>
    </div>
    </div>
</body>
</html>