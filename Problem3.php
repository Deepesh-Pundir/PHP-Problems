<?php
$data = array(
        array(
            'name'=>'Mark',
            'job'=>'engineer',
            'age'=>25,
            'hobbies' => array('drawing','swimming','reading'),
            'skills' => array('coding','fasting learning','teaching')
        ),
        array(
            'name'=>'Joe',
            'job'=>'designer',
            'age'=>19,
            'skills'=>array('fast learning')
        ) ,
        array(
            'name'=>'sara',
            'age'=>25,
            'city'=>'NY'
        ),

        array(
            'name'=>'sam',
            'job'=>'accountant',
            'age'=>25,
            'city'=>'london'
        ),
        array(
            'name'=>'Esraa',
            'job'=>'Designer',
            'age'=>23,
            'city'=>'cairo',
            'hobbies' => array('writing','reading'),
            'skills' => array('coding','teaching')
        ),
    );
	
    foreach($data as $x => $value)
    {
        $count=0;
        foreach($value as $x2 => $value2){
            if($x2=='city')
            {
                $count++;
                break;
            }
        }
        if($count>0){
            foreach($value as $x3 => $value3)
            {
            
                if(is_array($value3))
                {
                    echo "* ".$x2.": <br> ";
                    foreach($value3 as $x4 => $value4)
                    {
                        echo "* "."-".$value4."<br>";
                    }
                }
                else{

                    echo "* ".$x3.": ".$value3."<br>";
                }
            }
            echo "<br>"."* "."---------------------------"."<br>";
        }
    }
?>