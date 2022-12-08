<?php
echo "<table border=10 cellpadding=30px width:270px height:270px style=border-collapse:collapse>";
for($i=1 ;$i<=8;$i++)
{
    echo "<tr>";
    for($j=1 ;$j<=8;$j++)
    {
        if($j%2==0)
        {
           echo "<td style= width:30px height:30px bgcolor=white></td>"; 
        }
        else{
            echo "<td style=width:30px height:30px bgcolor=black></td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>