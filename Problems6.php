<?php
    echo "<table border=2 cellspacing=5px cellpadding=5px style=border-collapse:collapse>";
    for($i=1 ;$i<=6 ;$i++)
    {
        echo "<tr>";
        for($j=1;$j<=5 ;$j++)
        {
                $k=$i*$j;
                echo "<td style=font-size:50px>$i*$j=$k</td>";    
        }
          echo "</tr>";
    }
     echo "</table>";
?>