<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .black{
            background-color: black;
        }
        .white{
            background-color: white;
        }
    </style>
</head>
<body>
<?php
echo "<center>";
echo "<table border=5 cellpadding=40px  style=border-collapse:collapse>";
$sum = 0;
for($i=1 ;$i<=8;$i++)
{
    
    echo "<tr>";
    for($j=1 ;$j<=8;$j++)
    {
        $sum = $i+$j;
        if($sum%2!=0)
        {
           echo "<td class='white' ></td>"; 
        }
        else{
            echo "<td class  = 'black'></td>";
        }
    
 
    }
    echo "</tr>";
}

echo "</table>";
echo "</center>";
?>
</body>
</html>


