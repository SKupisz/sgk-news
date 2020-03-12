<?php
    if(isset($_POST["first-name"]) && isset($_FILES["first-photo"])){
        $firstPhotoName = $_POST["first-name"];
        $firstPhotoName = htmlentities($firstPhotoName,ENT_QUOTES,"UTF-8");
        $dir = "../articlesImages/";
        $uploadOk = 1;
        $target_dirname = $dir.$_SESSION["zalogowany_id"]."/".$firstPhotoName.".webp";
        if(file_exists($target_dirname)){
          exitInstructions("Image already exists");
        }
        if($_FILES["first-photo"]["size"] > 36000000){
          exitInstructions("Image is too large");
        }
        $toCheckTheFormat= $dir.basename($_FILES["first-photo"]["name"]);
        $imageType = strtolower(pathinfo($toCheckTheFormat,PATHINFO_EXTENSION));
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif" && $imageType != "webp"){
          exitInstructions("Only jpg, png, jpeg,webp and gif format");
        }
        if(move_uploaded_file($_FILES["first-photo"]["tmp_name"],$target_dirname)){
          $infoAboutIt = $polaczenie->query("INSERT INTO sent_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',0)");
          if(!$infoAboutIt) throw new Exception($connection->error);
          if(!(isset($_POST["second-name"]) && isset($_FILES["second-photo"]))){
            exitInstructions("Your article has been sent");
          }
          
        }
        else{
          exitInstructions("Failed to upload the image");
        }
    }
    if(isset($_POST["second-name"]) && isset($_FILES["second-photo"])){
        $secondPhotoName = $_POST["second-name"];
        $secondPhotoName = htmlentities($secondPhotoName,ENT_QUOTES,"UTF-8");
        $dir = "../articlesImages/";
        $uploadOk = 1;
        $target_dirname = $dir.$_SESSION["zalogowany_id"]."/".$secondPhotoName.".webp";
        if(file_exists($target_dirname)){
          exitInstructions("Image already exists");
        }
        if($_FILES["second-photo"]["size"] > 36000000){
          exitInstructions("Image is too large");
        }
        $toCheckTheFormat= $dir.basename($_FILES["second-photo"]["name"]);
        $imageType = strtolower(pathinfo($toCheckTheFormat,PATHINFO_EXTENSION));
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif" && $imageType != "webp"){
          exitInstructions("Only jpg, png, jpeg,webp and gif format");
        }
        if(move_uploaded_file($_FILES["second-photo"]["tmp_name"],$target_dirname)){
          $infoAboutIt = $polaczenie->query("INSERT INTO sent_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',1)");
          if(!$infoAboutIt) throw new Exception($connection->error);
          exitInstructions("Your article has been sent");
        }
        else{
          exitInstructions("Failed to upload the image");
        }
    }
?>