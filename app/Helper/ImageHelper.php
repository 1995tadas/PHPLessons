<?php


namespace App\Helper;


use Intervention\Image\ImageManager;

class ImageHelper
{

    public function upload (){
            $filename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $imageletter =[];
            for($i=0;$i<3;$i++){
                $letter =mb_substr($filename, $i, 1, "UTF-8");
                $imageletter[$i]=$letter;
            }
            $targetDirectory = "/var/www/html/mvc/uploads/".$imageletter[0]."/".$imageletter[1].'/'.$imageletter[2].'/';


        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }


        $target_file = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

}

public static  function generate ($image,$width,$height){
    $targetDirectory = "/var/www/html/mvc/uploads/".$image[0]."/".$image[1].'/'.$image[2].'/';
    $target_file=$targetDirectory.$image;
    if(!file_exists($targetDirectory .$width.'x'.$height.$image)){
    $manager = new ImageManager(array('driver' => 'imagick'));
    $generated = $manager->make($target_file)->resize($width, $height);
    $generated->save($targetDirectory .$width.'x'.$height.$image,60);
}
    return $image[0]."/".$image[1].'/'.$image[2].'/'.$width.'x'.$height.$image;
}

}