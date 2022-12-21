<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        body{
            margin:0%;
            padding:0%;
        }
        .table{
            font-family:sans-serif;        
        
        }
        table{
            border-collapse:collapse;

        }
        thead tr th{
            /* font-size:20px; */
            padding:12px;
            background-color:#2E8B57;
            color:white;
            border-radius:5px;  
        }
        tbody tr:nth-child(even){
            
            background-color:#F0FFFF;
            color:#2E8B57;
            font-weight:bold;
        }
        tbody tr td{
            padding:8px;
            font-weight:bold;
        }
        ul{
            text-align:center;
            
        }
        li{
            padding:5px;
            display:inline-block;
        
        }
        ul li a{
            text-decoration:none;
            font-size:20px;
            font-weight:bold;
            color:#2E8B57;
        }
        .active a{
            color:white;
            background-color:#2E8B57;
            font-size:22px;
            padding:3px;
           
        }
    
    </style>
    <?php
        /* Attempt to connect to MySQL database */
        $link = mysqli_connect('localhost', 'root', '', 'problem9');
        // Check connection 
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
         }else{
        // echo "connected";
        }
        $limit=5;
        
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        else{
                $page=1;
        }
        $offset=($page-1)*$limit;

        $query="SELECT user_id, First_Name,Last_Name,Age,DOB,Gender,Education,Address1,Address2,state.stateName As State ,country.CountryName As Country,skill
         FROM user_data INNER JOIN skill
         ON user_data.skill =skill.id
        INNER JOIN state
        ON user_data.State=state.st_id
        INNER JOIN country
        ON user_data.Country=country.c_id
        order by user_id
        limit $offset,$limit";
        $result=mysqli_query($link,$query);
        $num=mysqli_num_rows($result);
    ?>

</head>
<body>
    <div class="container">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>user_id</th>
                        <th>First_Name</th>
                        <th>Last_Name</th>
                        <th>Age</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Education</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Skills</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                        if($num>0){
                             while($row=mysqli_fetch_assoc($result)){
                           
                                 ?>
                                <tr>
                                <td><?php echo $row['user_id']?></td>
                                <td><?php echo $row['First_Name']?></td>
                                <td><?php echo $row['Last_Name']?></td>
                                <td><?php echo $row['Age']?></td>
                                <td><?php echo $row['DOB']?></td>
                                <td><?php echo $row['Gender']?></td>
                                <td><?php echo $row['Education']?></td>
                                <td><?php echo $row['Address1']?></td>
                                <td><?php echo $row['Address2']?></td>
                                <td><?php echo $row['State']?></td>
                                <td><?php echo $row['Country']?></td>
                                <td><?php
                              
                                $val = "";
                                $sql1 = "select SKILLS from skill where id IN (".$row['skill'].")";
                                $query1 = mysqli_query($link, $sql1);
                                    while($res = mysqli_fetch_array($query1, MYSQLI_ASSOC)){
                                        $val .= $res['SKILLS'].",";
                                        
                                    }
                                     $val = rtrim($val, ",");
                                     echo $val;
                            ?></td>
                                </tr>
                                <?php 
                        }
                        }
                        ?>
                
                </tbody>
                
            </table>
            <?php
            $query1="SELECT * FROM user_data ";
           $result1=mysqli_query($link,$query1);
        
            if(mysqli_num_rows($result1)>0){
                $total_record=mysqli_num_rows($result1);
                                
                $total_page=ceil($total_record/$limit);
                ?>
                  <ul class="pagination">
                    <?php
                 if($page>1){

                     echo '<li><a href="Problem12(Pagination).php?page='.($page-1).'">&lt Prev &gt</a></li>';
                 }

                 for($i=1 ;$i<=$total_page;$i++)
                 {
                    if($i==$page)
                    {
                        $active="active";
                    }
                    else{
                            $active="";
                    }
                    
                    echo '<li class="'.$active.'"><a href="Problem12(Pagination).php?page='.$i.'">'.$i.'</a></li>';
                    
                   }

                   if($page<$total_page){

                       echo '<li><a href="Problem12(Pagination).php?page='.($page+1).'">&lt Next &gt</a></li>';
                   }
                 echo '</ul>';
                
            }
            ?>
    </div>
    </div>
</body>
</html>