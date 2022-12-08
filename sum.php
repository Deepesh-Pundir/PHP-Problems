<?php
$a=2356;
$sum=0;
// $sum=$a%10+floor($a/10);
for($i=$a;$i>0;$i=floor($i/10))
{
    $temp=$i%10;
    $sum=$sum+$temp;
}
echo $sum;

?>