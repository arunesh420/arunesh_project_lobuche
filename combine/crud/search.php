<?php
require_once "config.php";
if(isset($_POST["search_keyword"]) && isset($_POST["search_field"])){
    $search_keyword=$_POST["search_keyword"];
    $search_field=$_POST["search_field"];
    if ($search_field=="first_name"){
        $sql="FROM persons WHERE first_name LIKE '%".$search_keyword."%'";
        $result=mysqli_query($conn,$sql);
    }elseif ($search_field=="last_name"){
        $sql="FROM persons WHERE last_name LIKE '%".$search_keyword."%'";
        $result=mysqli_query($conn,$sql);
    }elseif ($search_field=="email"){
        $sql="FROM persons WHERE email LIKE '%".$search_keyword."%'";
        $result=mysqli_query($conn,$sql);
    }
}
?>
<?php //include "../header.php"?>
    <html>
    <head><title>Retrieve</title></head>
    <body>
    <a href="create.php">Create</a>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($result as $row){ ?>
        <tr>
            <td><?php echo$row['id']?></td>
            <td><img src="upload/<?php echo $row['image']?>" height= "2%" width="5%"></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td><?php echo $row['email']?></td>
            <td><a href="update_detalis.php"?id=<?php echo $row["id"]?>">Edit</a></td>
            <td><a href="delete_details.php? id=<?php echo $row["id"]?>">Delete</a> </td>
        </tr>

    <?php } ?>
</table>
</body>
</html>

<html>
<head>
    <title> search</title>
</head>
<body>
<a herf="create.php">create</a>
                <form action="search.php" method="post">
                    <input type ="text" name=""search_keyword" required>
                    <select name="search_field" required>
                        <option vavle ="first_name" selected> first Name</option>
                        <option vavle ="last_name" selected>Last Name</option>
                        <option vavle ="email" selected> email</option>
                    </select>
                    <input type ="submit" valve="search">
                </form>
    </body>
    </html>
<?php //include "../footer.php"?>