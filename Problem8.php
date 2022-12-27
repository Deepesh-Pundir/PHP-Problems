<?php
$arr=array(16,17,4,3,5,2);

function findleaders($arr){

    for($i=0 ;$i<count($arr); $i++)
    {
        $count=0;
        for($j=$i+1 ; $j<count($arr);$j++)
        {
            if($arr[$i]<$arr[$j])
            {
               $count++;
               break;
            }
        }
        if($count<=0)
        {
            echo $arr[$i]." ";
        }
    }
}
findleaders($arr);
?>