<?php

function filterFruits($fruitArr){
    $fruitsDb=array("apple","banana","orange","pineapple","grapes","avacado","strawberry");
    $array=array();
    $k=0;
    for($i=0 ; $i<count($fruitArr) ;$i++)
    {
        for($j=0 ;$j<count($fruitsDb);$j++)
        {
            if($fruitArr[$i]==$fruitsDb[$j])
            {
                $array[$k]= $fruitArr[$i];
                $k++;
            }
        }    
    }
    return $array;  
}

$mixFruitArr=array("grapes","cabbage","tomato","banana");
$string = implode(",", $mixFruitArr);
$resultArray=  filterFruits($mixFruitArr);
print_r($resultArray);
echo "<br>".$string;
?>