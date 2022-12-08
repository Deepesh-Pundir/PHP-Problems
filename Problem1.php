<?php
$array1=array(1,3,6,2,4);
$array2=array(2,0,4,1,2);
$array3=array();
for($i=0 ;$i<count($array1); $i++)
{
    $array3[$i]= $array1[$i]+$array2[$i];
}
 echo "array <br>";

for($i=0 ;$i<count($array3) ; $i++)
{
 
    for($j=$i+1 ; $j<count($array3) ;$j++)
    {
    if($array3[$i]==$array3[$j])
    {
        $array3[$j]="_";
    }
    }
 
    for($i=0; $i<count($array3); $i++)
    {
        if($array3[$i]!="_")
        {
            echo $array3[$i]."&nbsp";
        }  
        
         
    }
}
?>