<?php
    function conn($db_name)
    {
        $server_name="localhost";
        $user_name="root";
        $password="";
        $conn=mysqli_connect($server_name,$user_name,$password, $db_name);
        return $conn;
    }

    function dbConnection($server_name,$user_name,$password,$db_name)
    {
        if($server_name!='' && $user_name!=''&& $db_name!=''){

            // $conn=mysqli_connect($server_name,$user_name,$password,$db_name);
            $conn=conn($db_name);
            if(!$conn)
            {
                echo "Connection Faield :". mysqli_connect_error();
                return 0;
            }
            else{
                echo "Database Connected Successfully";
                return true;
            }
            
        }
        else{
            echo "Pls Pass the valid value";
        }
    }
    function check_table($db_name,$table_name)
    {
        $sql="SHOW TABLES LIKE '$table_name'";
        $conn=conn($db_name);
        $res=mysqli_query($conn,$sql);
        print_r($res);
        $data=mysqli_fetch_all($res);
        if($data)
        {
            echo "Table is Persent in DATABASE '$db_name'";
        }
        else{
            echo "Table is Not Persent in DATABASE '$db_name'";
        }
    }
    //check_table("problem9","pancard");

    function fetch_data($db_name,$table_name,$col_name='',$offset='',$limit='',$condition='',$oprator='')
    {
        if($col_name=='*')
        {
            $sql="SELECT * FROM `$table_name`";
            if($condition!='')
            {
                $count=0;
                $sql.="WHERE ";
                for($i=0;$i<count($condition);$i++)
                {
                    $sql.=$condition[$i]." ";
                    if($count<=$i && $count < (count($condition)-1))
                    {
                        $sql.=$oprator[$count]." ";
                        $count++;  
                    }  
                }
            }
            if($offset!='' && $limit!=''){
                
                $sql.=" LIMIT $offset,$limit";           
            }
           
        }    
        else
        {
            if($col_name!='*')
            { 
                $sql="SELECT $col_name FROM `$table_name`";
                if($condition!='')
                { 
                    $count=0;
                    $sql.="WHERE ";
                    for($i=0;$i<count($condition);$i++)
                    {
                        $sql.=$condition[$i]." ";
                        if($count<=$i && $count < (count($condition)-1))
                        {
                            $sql.=$oprator[$count]." ";
                            $count++;  
                        }  
                    }
                    
                }
            if($offset!='' && $limit!=''){
                
                $sql.=" LIMIT $offset,$limit;";       
            }
            
            }
        }
            $sql.=";";
            // echo $sql;
             $conn=conn($db_name);
            $res=mysqli_query($conn,$sql);
            $data=mysqli_num_fields($res);
            
            if($data==1){
                while($row=mysqli_fetch_assoc($res))
                {
                    $val[]=$row;
                }
            }else
            {
                $val=mysqli_fetch_all($res,MYSQLI_ASSOC);
            //     pre>";echo "<pre>";
            //     //  print_r($val);
            //  echo "</
            }
            return $val;
           // print_r($val);
            // else{
            //     echo "No data in a Table";
            // }

            
    }
    //fetch_data("problem9","user_data","0","10","user_id,First_Name,skill,Age",["Age>=18","Age<=25"],['AND']);
   // fetch_data('problem9','skill','*');
   //fetch_data("problem9","skill","SKILLS",0,100,["id","(skill)"],['IN']);
   //fetch_data('problem9','skill','SKILLS');
    function insert_data($table_name,$col_name='',$value='')
    {
        $conn=conn('problem9');

        if($col_name!='' && $value!=''){
            $sql="INSERT INTO `$table_name`(";
            foreach($col_name AS $val)
            {
                $sql.="`".$val."`".", ";
            }
               
            $sql=rtrim($sql,", ");
            $sql.=") VALUES ";
            //echo $sql;
            foreach($value as $key1 => $val1) {
                $sql.="(";
                foreach($val1 as $key2 => $val2){
                if(is_numeric($val2)){
                    $sql.=$val2.", ";
                }
                else{

                    $sql.="'".$val2."'".", ";
                }
            }
            $sql=rtrim($sql,", ");
            $sql.="),";
            } 
            $sql=rtrim($sql,", ");
            $sql.=";";
            
        
             
            // die;
            $res=mysqli_query($conn,$sql);

            if($res){

               // echo "Data inserted successfully";
                return $res;
            }
            else{                                                             
                echo "Data is not inserted";
            }
        }else
        {
            echo "Pls give the column name and column value";
        }
    }
  //insert_data("pancard",['ID','NAME','PHONE_NO','GENDER','CITY'],[[10,'parmi',904676954,'M','DELHI']]);
    // function insert_data($table_name,$data){
    //     $conn=mysqli_connect("localhost","root","","student");
    //     foreach($data AS $key => $value){
    //         $k[]=$key;
    //         $val[]=$value;
    //     }
    //     print_r($k);
    //     $row=implode(",",array_values($k));
    //     $values=implode(",",array_values($val));
    //     $sql="INSERT INTO $table_name($row) VALUES($values)";
    //     echo $sql;
    //     $query=mysqli_query($conn,$sql);
    // } 
//insert_data("pancard",["ID"=>'1','NAME'=>'DEEP','PHONE_NO'=>'783903298','CITY'=>'DELHI']);
    // function inner_join($col_name,$table,$mainColumn,$table_name1)
    // {
    //     $sql="SELECT $col_name FROM `$table` ";
    //     for($i=0 ;$i<count($mainColumn);$i++)
    //     {
    //         for($j=0;$j<count($table_name1);$j++)
    //         {
    //             if($i==$j){
    //                 foreach($table_name1 As $key =>$value){
    //                 $sql.=" INNER JOIN " .$key.'<br>' 
    //                 ."ON" ." $table "." . ". $mainColumn[$i].'='.$key."." .$value;
    //                 $i++;
    //                 $j++;
    //                 unset($table_name1[$key]);
                    
    //             }  
                
    //         }
    //         }
    //         // print_r($value);    
    //         // print_r($table_name1);
    //     }
    //     echo $sql;
    // }
    // inner_join("'id','name','skill'","user_data",["skill","state","country"],["skill"=>"id","state"=>"st_id","Country"=>"c_id"]);
    function inner_join($col_name,$table_name,$join)
    {
        $sql="SELECT  $col_name  FROM `$table_name`";
        foreach($join As $key1 => $val1)
        {
            $sql.=' INNER JOIN '.$key1." "."ON ";
            foreach($val1 As $key2 => $val2)
            {
                $sql.=$key2.".".$val2."=";
                //break;
            }
            $sql=rtrim($sql,"=");
        }
        $sql.=" ORDER BY ".'user_id';
        $sql.=";";
        $conn=conn("problem9");
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            //echo "working porperly";
            $val=mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $val;
        }
        else{
            echo "not working";
        }
        
        echo $sql;
    }
    //inner_join("user_id, First_Name,Last_Name,Age,DOB,Gender,Education,Address1,Address2,state.stateName As State ,country.CountryName As Country,skill","user_data",["state"=>['user_data'=>'State','state'=>'st_id'],"country"=>['user_data'=>'country','country'=>'c_id']]);
    function update_col($table_name,$col_name,$value,$condition)
    {
        $sql="UPDATE $table_name SET $col_name='$value' WHERE $condition;";
        $conn=mysqli_connect("localhost","root","","student");
        $res=mysqli_query($conn,$sql);
        echo $sql;
    }
    //update_col("pancard","CITY","NOIDA","NAME='MAYANK'");
    function update_column($table_name,$col_name,$condition)
    {
        $sql="UPDATE `$table_name` SET ";
        foreach($col_name AS $key =>$value)                   
        {
            $sql.=$key."='".$value."',";
        }
        $sql=rtrim($sql,',');
        $sql.=" WHERE ".$condition.';';
        //echo $sql;
        $conn=conn("problem9");
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo "Data Updated successfully";
            return 1;
        }
        else{
            echo "query is not run";
        }
    }
    //update_column('student',['age'=>'30','name'=>'rahul','country'=>'russia'],"id=2");
   function delete_data($table_name,$condition)
   {
    $sql="DELETE FROM `$table_name` WHERE $condition;";
    
    $conn=mysqli_connect("localhost","root","","student");
    $res=mysqli_query($conn,$sql);
    echo $sql;
   }
   //delete_data("pancard","ID=5");
   function delete_row($table_name,$col_name,$id)
   {
        $conn=conn("problem9");
        $sql="DELETE FROM `$table_name` WHERE $col_name=$id;";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo "Data deleted successfully";
            return 1;
        }
        else{
            echo "query is not run";
        }
   }
   //delete_row('pancard','10');
   function rename_col($table_name,$old_name,$new_name)
   {
        $sql="ALTER $table_name CHANGE $old_name NEW $new_name";
        $conn=mysqli_connect("localhost","root","","student");
        $res=mysqli_query($conn,$sql);
        echo $sql;
   }
   //rename()
?>
 