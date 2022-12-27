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
        }

    </style>
</head>
<body>
    <form>
        <div class="fdate date">
            <input type="date" name="start_date" id="1stdate" >
        </div>
        <div class="sdate date">
            <input type="date" name="start_date" id="2nddate" >
        </div>
        <div class="button">
            <input type="submit" value="Calculate Diffrence">
        </div>
        <div class="result">
            <input type="text" >
        </div>
    </from>
</body>
</html>