<?php
//Check if the form is submitted
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"]==0){
        $allowed = array("jpg"=>"image/jpg", "jpeg"=>"image/jpeg", "gif"=>"image/gif", "png"=>"image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        //Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)){
            die("Error: Please select a valid file format");
        }

        //Verify file size - 5MB maximum
        $maxsize = 1024*1024;
        if($filesize>$maxsize){
            die("Error! file size is larger than the allowed limit");
        }
        if(in_array($filetype, $allowed)){
            //check whether file exists before uploading it.
            if(file_exists("uploaded/".$filename)){
                echo $filename."is already exists";
            }else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploaded/".$filename);
                echo "Your file was uploaded successfully.";
            }
        }else{
            echo "Error: Problem while uploading";
        }

    }else{
        echo "Error ".$_FILES["photo"]["error"];
    }
}
?>


<html>
<head>
    <title>File upload form</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <h2>Upload File</h2>
    <input type="file" name="photo">
    <input type="submit" value="Upload Image">
</form>
</body>
</html>