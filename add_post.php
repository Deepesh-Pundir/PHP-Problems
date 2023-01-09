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
            width:100%;
            display: flex;
            flex-direction:column;
            align-items:center;
        }
        .container{
            width: 75%;
            border:1px solid black;
            display: flex;
            flex-direction:row;
            
        }
        .post{
            width: 15%;
            height:60vh;
            border:2px solid #2E8B57;
            margin:10px 10px 20px 5px;
        }
        .post a{
            border:2px solid #2E8B57;
            display:block;
            padding:5px;
            /* width:92%; */
            text-align:center;
            text-decoration:none;
            color:white;
            margin-top:2px;
            background-color:#2E8B57;
        }
        form{
            width:100%;
            /* border:1px solid red; */
            display: flex;
            flex-direction:row;
        }
        form .block1{
            width:60%;
            /* border:1px solid black; */
            margin-top:10px;
        
        }
        form .block1 .title input{
            width:90%;
            height:8vh;
            text-align:center;
            margin-left:10px;
            margin-bottom:10px;
        }
        form .block1 .description input{
            width:90%;
            height:40vh;
            text-align:center;
            margin-left:10px;
            margin-bottom:10px;
        }
        form .block2 .publish input{
            width:70%;
            height:8vh;
            text-align:center;
            margin-left:20px;
            margin-bottom:10px;
            background-color:#2E8B57;
            color:white;
            font-size:18px;
            font-weight:bold;
            border:none;
        }
        form .block2{
            width:60%;
            margin-top:10px;
            color:#2E8B57;
            font-weight:bold;
        
        }
        .background{
            width:90%;
            border:1px solid #2E8B57;
            background-color:#2E8B57;
        }
        .category{
            width: 90%;
            height:42vh;
            border:1px solid black;
            margin:20px 10px 20px 20px; 
            background-color:white;  
            /* overflow-y:scroll; */
        }
        h3{   
            border-bottom:1px solid black;
        }
        .category a{
            display:inline-block;  
            text-decoration:none;
            margin: 5px 8px 5px 5px;
        }
        .category input{
            margin:10px 8px 5px 5px;
        }
        .checkbox{
            border:1px inset white;
            height:25vh;
            overflow-y:scroll;
        }
    </style>
</head>
<body>
    <?php
        include_once('SQLfunction.php');
        $title=$description=$category=$chk='';
        $titleError='';
        $author=$_SESSION["Name"];
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["title"])){
                $titleError="*Required";
            }
            else{
                $title=test_input($_POST["title"]);
            }
            $description=test_input($_POST['description']);
            
            if(isset($_POST['parent'])){
                $category=$_POST['parent'];
                $chk=implode(",",$category);
            }
            else{
                $chk='';
            }
        }
        function test_input($data)
        {
            $data=trim($data);  
            $data=stripcslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }

        if(isset($_POST['publish']))
        {
            if($title=='')
                {
                    echo "*Please fill the required field";
                }
                else{
                    insert_data("post",['Title','Author','Description','Category'],[[$title,$author,$description,$chk]]);
                }
        }
    ?>
    <h1>Add Post</h1>
    <div class="container">
        <div class="post">
            <a href="category.php">Category</a> 
            <a href="add_post.php">Post</a>
            <a href="show_post.php">Show Data</a>
            <a href="sign_out.php">Log Out</a>

        </div>
        <form action="" method="POST">
            <div class="block1">
                <div class="title">
                    <input type="text" name="title" placeholder="Title">
                    <span><?php echo $titleError;?></span>
                </div>
                <div class="description">
                    <input type="text" name="description" placeholder="Description">
                </div>
            </div>
            <div class="block2">
                <div class="publish">
                    <input type="submit" name="publish" value="Publish">
                </div>
                <div class="background">
                    <div class="category">
                        <h3>Categories</h3>
                        <a href="?all_category='true'" name="all_category">All Categories</a>
                        <a href="?most_used='true'" name="most_used" value="true">Most Used</a><br>
                        <div class=checkbox>
                        <?php
                        if(isset($_REQUEST['all_category']))
                        {
                            if($_REQUEST['all_category']==true){
                                $row1=fetch_data("problem9","category","Title,parent_category,id");
                                    foreach($row1 as $key=>$value){
                                        echo "<input type='checkbox' name='parent[]' value='".$value['id']."'>".$value['Title']."<br>";
                                    }
                                }
                            }
                            else if(isset($_REQUEST['most_used'])){
                                if($_REQUEST['most_used']==true){
                                    $associativeArray = array();
                                    $row3=fetch_data("problem9","category","Title,parent_category,id");
                                    foreach($row3 as $key=>$value){
                                        $count=0;   
                                        $row2=fetch_data("problem9","post","Category,id");
                                        foreach($row2 as $key2 =>$value2){
                                        $p=explode(",",$value2['Category']); 
                                            foreach($p as $key3=>$value3)
                                            {
                                                if($value['id']==$value3)
                                                {
                                                    $count++;
                                                    break;
                                                }
                                            }
                                        }
                                        $key=$count;      
                                        $associativeArray[$value['id']] = $key ;
                                    }
                                    arsort($associativeArray);
                                    foreach($associativeArray as $key4=>$value4)
                                    {   
                                        foreach($row3 as $key=>$value){
                                        if($key4==$value['id']){
                                            echo "<input type='checkbox' name='parent[]' value='".$value['id']."'>".$value['Title']."<br>";
                                        }
                                        }
                                    }
                                }
                                }
                                else{
                                        $row1=fetch_data("problem9","category","Title,parent_category,id");
                                        foreach($row1 as $key=>$value){
                                            echo "<input type='checkbox' name='parent[]' value='".$value['id']."'>".$value['Title']."<br>";
                                        }
                                    }
                        ?>
                    </div>
                        <a href="category.php">+Add New Category</a>                
                    </div>
                </div>
            </div> 
        </form>    
    </div>
</body>
</html>
<?php
}
else{
    header("location:sign_in.php");
} ?>