<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($FILES["fileupload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//check if $uploadOk is set to 0 by an error
if(isset($_POST["submit"]) && ($uploadOk == 0)){
    echo "Your image was not uploaded";
    //if everything is ok, try to upload file
} else{
    if(move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file)){
        echo "Your image has been uploaded";
    }else{
        echo "Error Upload image";
    }
}


//check the image file size
if($_FILES["fileupload"]["name"] > 500000){
    echo "File is too large";
    $uploadOk = 0;
}

//check image file format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
    echo "Only jpg, png, and jpeg are allowed";
    $uploadOk = 0;
}


?>