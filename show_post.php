<?php
session_start();   
if(isset($_SESSION["Name"]))
{
    
?>
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
        .container{
            width:100%;
            display:flex;
            flex-direction:column;
            align-items:center;
         
        }
        form{
            width:90vw;
            height:8vh;
            display:flex; 
            flex-direction:column;
            /* background-color:lightgreen;   */
        }
        form .fblock{
            width: 66.5%;
            display: flex;
            flex-direction:row;
        }   
        form select{
            width:13vw;
            height:5vh;
            background-color:#2E8B57;
            color:white;
            font-size:15px;
            font-weight:bold;
            margin:10px 5px 5px 5px;
        }
        form .date{
            width: 30vw;
            margin-left:5px;
            display:flex;
            flex-direction:row;
        }
        form .date input{
            color:#2E8B57;
            font-size:15px;
            font-weight:bold;
            margin:10px 5px 5px 5px;
        }
        form .filter{
            margin-left:10px;
        }
        form .filter input{
            background-color:#2E8B57;
            color:white;
            font-size:15px;
            font-weight:bold;
            border:none;
            margin:10px 5px 5px 0px;
        }
        form .search{
            background-color:lightgreen;
            display:flex;
            flex-direction:row;
            margin-left:20px;
        }
        form .search .s1{
            background-color:white;
            margin-left:10px;    
        }
        form .search input{
            background-color:#2E8B57;
            color:white;
            font-size:15px;
            font-weight:bold;
            border:none;
            margin:10px 15px 5px 0px;
        }
        form .fblock input{
            width: 13.5vw;
            height:5vh;
            /* margin:10px 5px 5px 5px; */
        }
        .body{
            width:90vw;
            display:flex;
            flex-direction:row;     
            /* background-color:lightgreen;     */
        }
        .body table{
            border:8px groove #2E8B57;
            width: 90vw;
            height:55vh;
            margin:10px 10px 10px 5px;
            padding:5px;
            text-align:center;  
            border-collapse:collapse;
        }
        .body table th{
            font-size:15px;
            padding:10px;
            background-color:#2E8B57;
            color:white;
        }
        .body table tbody tr:nth-child(even){
             background-color:#2E8B57;
             color:white;
        } 
        .body .post{
            width: 15%;
            height:40vh;    
            border:2px groove #2E8B57;
            margin:10px 10px 20px 5px;
        }
        .body .post a{
            /* border: 2px solid black; */
            display:block;
            padding:5px;
            /* width:92%; */
            text-align:center;
            text-decoration:none;
            color:white;
            margin-bottom:2px;
            background-color:#2E8B57;
        }
        ul{
            /* text-align:right; */
            /* margin-right:2vw; */
        }
        ul span{
            background-color:lightgreen;
            padding:12px;
            font-size:20px;
            font-weight:bold;
            color:#2E8B57;
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
        .footer{
            align-self:center;
        }
        .delpage{
            width:88vw;
            display:flex;
            flex-direction:row;
            justify-content:space-between;
        }
        .delete input{
            width:10vw;
            height:7vh;
            border:none;    
            font-size:18px;
            font-weight:bold;
            color:white;
            background-color:#2E8B57;
        }
    </style>
    <?php
        // session_start();
        // if(!isset($_SESSION['Name']))
        // {
        //     header("Location:sign_in.php");
        // }

        include_once('SQLfunction.php');
        $limit=3;
        if(isset($_GET['page'])){
             $page=$_GET['page'];
        }
        else{
             $page=1;
        }
        $offset=($page-1)*$limit;
        $v='';
        $date1=$date2='';
        $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Category","'%$v%'"],['LIKE']);
        if(isset($_GET['category'])&& isset($_GET['start_date']) && isset($_GET['end_date']))
        {
        if($_GET['category']!='' && $_GET['start_date']!='' && $_GET['end_date']!='')
        {
            $v=$_GET['category'];
           // echo $_GET['category'];
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Category","'%$v%'","Date >'$date1'","Date <'$date2'"],['LIKE','AND','AND']);
        }
        else if($_GET['category']!='' && $_GET['start_date']!='')
        {
            $v=$_GET['category'];
            $date1=$_GET['start_date'];
           // echo $date1;
           $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Category","'%$v%'","Date >'$date1'"],['LIKE','AND']);
        }
        else if($_GET['category']!='' && $_GET['end_date']!='')
        {
            $v=$_GET['category'];
            $date2=$_GET['end_date'];
           // echo $date1;
           $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Category","'%$v%'","Date <'$date2'"],['LIKE','AND']);
        }
        else if($_GET['start_date']!='' && $_GET['end_date']!='')
        {
            $date1=$_GET['start_date'];
            $date2=$_GET['end_date'];
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Date >'$date1'","Date <'$date2'"],['AND']);
        }
        else if($_GET['category']!='')
        {
            $v=$_GET['category'];
            echo $v;
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Category","'%$v%'"],['LIKE']);
        }
        else if($_GET['start_date']!='')
        {
            $date1=$_GET['start_date'];
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Date >'$date1'"]);
        }
        else if($_GET['end_date']!='')
        {
            $date2=$_GET['end_date'];
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Date <'$date2'"]);
            
        }}

        if(isset($_GET['submit']))
        {
            $v=$_GET['search'];
            $result =fetch_data("problem9","post","id,Title,Author,Category,Date",$offset,$limit,["Title","'%$v%'"],['LIKE']);
        }       
    ?>
</head>
<body> 
    <div class="container">
    <form action="">
    <div class="fblock">
        <div>
            <select name="category" id="">
            <?php
                $row1=fetch_data("problem9","category","Title,parent_category,id");
                echo "<option value=''>All Categories</option>";
                foreach($row1 AS $key=>$value){   
                    echo "<option value='".$value["id"]."'>".$value["Title"]."</option>";
                }?> 
            </select>
        </div>
        <div class="date">
            <input type="date" name="start_date"  value="<?php echo date('y-m-d');?>"> 
            <input type="date" name="end_date" value="<?php echo date('y-m-d');?>">
        </div>
        <div class="filter">    
            <input type="submit" name="filter" value="Filter">
        </div>     
        <div class="search">   
            <input class="s1" type="search" name='search'>
            <input type="submit" name="submit" value="Search Post">
        </div>
    </div>    
    <!-- </form> -->
    <div class="body">
    <div class="post">
            <a href="category.php">Category</a> 
            <a href="add_post.php">Post</a>
            <a href="show_post.php">Show Data</a>
            <a href="sign_out.php">Log Out</a>

    </div>
    <table border=1>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Categories</th>
                <th>Date</th>
            </tr>    
        </thead>
        <tbody>
            
            <?php
               if(isset($_GET['checkbox']))
               {
                    // echo $_GET['checkbox'];
               }
               if(isset($_GET['delete'])){
                $delete=$_GET['checkbox'];
                 $res=delete_row('post','id',$delete);
                }
                foreach($result as $key=>$value)
                {
                ?>
                <tr>
                    <td><input type='checkbox' name="checkbox" value="<?php echo $value['id']?>" ><?php echo $value['Title'];?></td>
                    <td><?php echo $value['Author'];?></td>
                    <td>
                        <?php
                            $val='';
                            $cate=$value['Category'];
                            $res2=fetch_data("problem9","category","Title",0,100,["id","($cate)"],['IN']);
                            foreach($res2 as $key2 => $value2)
                            {
                                foreach($value2 as $key3 =>$value3)
                                {
                                    $val.=$value3.",";   
                                }
                            }
                            $val=rtrim($val,",");
                            echo $val;
                        ?>
                    </td>    
                    <td>Published<br><?php echo $value['Date']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class=footer>
    <div class="delpage">
   <div class="delete"><input type="submit" name="delete" value="Delete"></div>
    <?php
            $result1=fetch_data("problem9","post","*"); 
            $d1=$d2='';
            if(($result1)>0){
                $total_record=count($result1);
                $total_page=ceil($total_record/$limit);
                $data=count($result);
                echo $data;
                ?>
                   <ul class="pagination">
                    <?php
                    echo "<span>".$total_record." items:<span>  ";
                 if($page>1){
                    if(isset($_GET['filter'])){
                        if($_GET['filter'])
                        {
                            if(isset($_GET['start_date'])){
                            $d1=$_GET['start_date'];}
                            if(isset($_GET['end_date'])){
                            $d2=$_GET['end_date'];}
                            echo "<li><a href='?category=".$_GET['category']."&date1=".$d1."&date2=".$d2."&filter=".$_GET['filter']."&page=".($page-1)."'>&lt Prev &gt</a></li>";
                        }
                    }
                    else if(isset($_GET['submit']))
                    {
                        if($_GET['search']){
                        echo '<li><a href="?search='.$_GET['search'].'&submit='.$_GET['submit'].'&page='.($page-1).'">&lt Prev &gt</a></li>';
                    }
                    }
                    else{
                        echo '<li><a href="show_post.php?page='.($page-1).'">&lt Prev &gt</a></li>';
                    }
                }

                 for($i=1 ;$i<=$data;$i++)  // $total_page['$data']
                 {
                    if($i==$page)
                    {
                        $active="active";
                    }
                    else{
                            $active="";
                    }
                    if(isset($_GET['filter'])){
                        if($_GET['filter'])
                        {
                            if(isset($_GET['start_date'])){
                                $d1=$_GET['start_date'];}
                            if(isset($_GET['end_date'])){
                                $d2=$_GET['end_date'];}
                            echo '<li class="'.$active.'"><a href="?category='.$_GET['category'].'&date1='.$d1.'&date2='.$d2.'&filter='.$_GET['filter'].'&page='.$i.'">'.$i.'</a></li>'; 
                        }
                    }
                    else if(isset($_GET['submit']))
                    {
                        if($_GET['search']){
                        echo '<li class="'.$active.'"><a href="?search='.$_GET['search'].'&submit='.$_GET['submit'].'&page='.$i.'">'.$i.'</a></li>';
                    }
                    }
                    else{
                        echo '<li class="'.$active.'"><a href="show_post.php?page='.$i.'">'.$i.'</a></li>';
                    }
                }
                if($page<$data){     //$toatl_page
                    if(isset($_GET['filter'])){
                        if($_GET['filter'])
                        {
                            if(isset($_GET['start_date'])){
                                $d1=$_GET['start_date'];}
                            if(isset($_GET['end_date'])){
                                $d2=$_GET['end_date'];}
                            echo "<li><a href='?category=".$_GET['category']."&date1=".$d1."&date2=".$d2."&filter=".$_GET['filter']."&page=".($page+1)."'>&lt Next &gt</a></li>";
                        }
                    }
                    else if(isset($_GET['submit']))
                    {
                        if($_GET['search']){
                        echo '<li><a href="?search='.$_GET['search'].'&submit='.$_GET['submit'].'&page='.($page+1).'">&lt next &gt</a></li>';
                    }}
                    else{
                        echo '<li><a href="show_post.php?page='.($page+1).'">&lt Next &gt</a></li>';
                    }
                }
                 echo '</ul>';               
            }
            ?>
            </div>
            </div>
        </div>
    </form>
</body>
</html>
<?php
}
else{
    header("location:sign_in.php");
} ?>