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
            padding: 0%;
            /* border:5px solid black; */
            display:flex;
            justify-content:center;
            text-align:center;
        }
        form{
            border:5px solid black;
            width:70%;
            margin:30px;
            align-self:center;
        }
        .fdate{
            margin-top:40px;
        }
        .date input{
            width:80%;
            height:80px;
            margin:20px;
            border:2px solid black;
            text-align:center;
            font-size:25px;
        }
        .button input{
            width:60%;
            height:80px; 
            border:2px solid black;
            font-size:25px;
        }
        .result input{
            width:80%;
            height:130px;
            margin:20px;
            border:2px solid black;
            font-size:25px;
            text-align:center;
        }

    </style>
</head>
<body>
    <?php
    $str='';
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $first_date = date_create($_POST['start_date']);
        $end_date = date_create($_POST['end_date']);
        $diff=date_diff($first_date,$end_date);
        $str='';
        $res=$diff->format("%r%a");
        if($res<0)
        {
            $str.="-";
        }
        $res=abs($res);
       //echo $res;
        if($res>=365)
        {
            $year=floor($res/365);
            $str="$year"." Years ";
            $res=$res-($year*365);
        }
        if($res>=30)
        {
             $month=floor($res/30);
            $str.="$month"." months ";
            $res=$res-($month*30);
        }  
        if($res<30)
        {
            $str.="$res"." days ";
        }
        
    }
    
    ?>
    <form method="POST">
        <div class="fdate date">
            <input type="date" name="start_date"  value="<?php echo date('d-m-Y');?>" >
        </div>
         <div class="sdate date">
            <input type="date" name="end_date" value="<?php echo date('d-m-Y');?>" >
        </div>
        <div class="button">
            <input type="submit" value="Calculate Diffrence">
        </div>
        <div class="result">
            <input type="text" value="<?php echo $str ;?>">
        </div>
    </from>
</body>
</html>