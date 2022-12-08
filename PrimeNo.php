<?php
$a=200;
for($j=1;$j<=$a;$j++)
{
$count=0;
for($i=2;$i<=$j-1;$i++)
{
    if($j%$i==0)
    {
        $count++;
    }
}
if($count<1)
{
    echo "$j=>"."Prime</br>";
}
}
?>