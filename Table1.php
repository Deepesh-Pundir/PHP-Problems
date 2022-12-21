<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $arr=[
            [1,"Krishna","Manager",5000],
            [2,"Salman","Salesman",2000],
            [3,"Mohan","Computer Science",1200],
            [4,"Amir","Driver",500]
        ];

        echo "<table border='2' cellpadding='5px' cellspacing='0px'>";
        echo "<tr>
                 <th>Emp Id.</th>
                 <th>Name</th>
                 <th>Designation</th>
                 <th>Salary</th>
                </tr>";
        foreach($arr as $value)
        {
            echo "<tr>";
            foreach($value as $value2)
            {
                echo "<td> $value2 </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>