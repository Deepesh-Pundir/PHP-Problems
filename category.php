<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display:flex;
            flex-direction:column;
            align-items:center; 
        }   
        .container{
            border:2px solid black;
            width:80%;
            display:flex;
            flex-direction:row;
        }
        .menu{
            width:10vw;
            border:1px solid black;
            margin:30px 20px 40px 10px;
            text-align:center;
        }
        .menu a{
            border:1px solid black;
            display:block;
            padding:5px;
            /* width:92%; */
            text-align:center;
            text-decoration:none;
            color:black;
        }
        h1{
            text-align:center;
        }
        .body{
            border:1px solid black;
            margin:20px;
            display:flex;
            flex-direction:row;
        }
        .block1{
            margin:5px 40px 10px 10px;
        }
        .block1 input{
            width:30vw;
        }
        .block1 .title input{
            height:8vh;
            text-align:center;
            margin-top:5px;
            margin-bottom:5px;
        }
        .block1 .description input{
            height:15vh;
            text-align:center;
            margin-bottom:5px;
        }
        .block1 .parent{
            display:flex;
            justify-content:center;
        }
        .block1 .parent select{
            height:5vh;
            width:60%;
        }
        .block1 .save{
            text-align:center;
        }
        .block1 .save input{
            height:5vh;
            width:20vw;
            text-align:center;
            margin-top:40px;
            margin-bottom:40px;
            font-weight:bold;
            font-size:16px;
        }
        .block2{
            border:1px solid black;
            height:55vh;
            margin-bottom:20px;
            margin-right:15px;
            overflow-y:scroll;
        }
        .block2 ul{
            align-self:center;
            display:block;
            padding:0px;
            margin:0px;
                   
        }
        .block2 ul li{
            width:25vw;
            /* height:8vh;     */
            border:1px solid black;
            text-decoration:none;
            list-style-type:none;
            text-align:center;
            font-size:20px;
            margin-bottom:2px; 
            padding:10px; 
        }
        .block2 ul li a{
            text-decoration:none;
            color:black;    
            font-weight:bold;   
        }
    </style>
</head>
<body>
    <?php
    include_once('SQLfunction.php');
    $title=$description=$parent='';
    $titleError='';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["title"])){
                $titleError="*Required";
            }
            else{
                $title=test_input($_POST["title"]);
            }
            $description=test_input($_POST['description']);

            if(test_input($_POST['parent']!='')){
                $parent=test_input($_POST['parent']);
            }
            else{
                $parent=test_input($_POST['title']);
            }    
        }
        function test_input($data)
        {
            $data=trim($data);
            $data=stripcslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        $save=false;
        if(isset($_POST['submit']))
        {
            if($save==false){
            if($title=='')
                {
                    echo "*Please fill the required field";
                }
                else{
                    insert_data("category",['Title','Description','parent_category'],[[$title,$description,$parent]]);
                }
        }}
        $row=[];
        if(isset($_REQUEST['update']))
        {
            $save=true;
            $update=$_REQUEST['update'];
            $data=fetch_data("problem9","category","*","0","100",["id=$update"]);
            foreach($data AS $key=>$value)
            {
                $row=$value;
            }
            if(isset($_POST['submit'])){
                if($save==true){
                $data=update_column("category",[
                'Title'=>$title,
                'Description'=>$description,
                'parent_category'=>$parent],"id=".$_REQUEST['update']."");
                header("LOCATION:category.php");
            }}
        }
    ?>
    <h1>Category Add/List/Edit</h1>
    <div class="container">
        <div class="menu">
            <a href="category.php">Category</a>
            <a href="add_post.php">Post</a>
        </div>
        <div class="body">
            <form action="" method="POST">
                <div class="block1">
                    <div class="title">
                        <input type="text" name="title" placeholder="Title" value="<?php if(isset($_REQUEST['update'])) echo $row['Title']; ?>">
                        <span><?php echo $titleError;?></span>
                    </div>
                    <div class="description">
                        <input type="text" name="description" placeholder="description" value="<?php if(isset($_REQUEST['update'])) echo $row['Description']; ?>">
                    </div>
                    <div class="parent">
                        <select name="parent" id="">
                            <?php
                            $row1=fetch_data("problem9","category","Title,parent_category,id");
                            echo "<option></option>";
                            foreach($row1 AS $key=>$value){
                                if($row["id"]==$value['id']){
                                     $selected ='selected';
                                    }else{
                                         $selected='';
                                        }
                                echo "<option value='".$value["parent_category"]."' $selected>".$value["parent_category"]."</option>";
                            }?> 
                        </select>
                    </div>
                    <div class="save">
                        <input type="submit" name="submit" value="save">
                    </div>
                </div>
            </form>
            <div class="block2">
                <ul>
                    <?php
                        $row=fetch_data("problem9","category","Title,parent_category,id");
                        foreach($row as $key => $value){
                            echo "<li><a href='?update=".$value['id']."'>".$value["Title"]."</a></li>";
                        }
                        ?>
                </ul>
        </div>
    </div>
</body>
</html>