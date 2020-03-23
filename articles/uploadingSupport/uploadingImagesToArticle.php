<?php
    if(isset($_POST["first-name"]) && isset($_FILES["first-photo"]) && !empty($_FILES["first-photo"]["tmp_name"])){
        $firstPhotoName = $_POST["first-name"];
        $firstPhotoName = htmlentities($firstPhotoName,ENT_QUOTES,"UTF-8");
        $dir = "../articlesImages/";
        $uploadOk = 1;
        $target_dirname = $dir.$_SESSION["zalogowany_id"]."/".$idForTheImage."_".$firstPhotoName.".webp";
        if(file_exists($target_dirname)){
          exitInstructions("First photo - Image already exists");
        }
        if($_FILES["first-photo"]["size"] > 36000000){
          exitInstructions("First photo - Image is too large");
        }
        $toCheckTheFormat= $dir.basename($_FILES["first-photo"]["name"]);
        $imageType = strtolower(pathinfo($toCheckTheFormat,PATHINFO_EXTENSION));
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif" && $imageType != "webp"){
          exitInstructions("First photo - Only jpg, png, jpeg,webp and gif format");
        }
        if($status == 2){
          if(move_uploaded_file($_FILES["first-photo"]["tmp_name"],$target_dirname)){
            $infoAboutIt = $polaczenie->query("INSERT INTO sent_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',0)");
            if(!$infoAboutIt) throw new Exception($polaczenie->error);
            if(!(isset($_POST["second-name"]) && isset($_FILES["second-photo"]))){
            
            }
            
          }
          else{
            exitInstructions("First photo - Failed to upload the image");
          }
        }
        else{
          $target_dirname = $dir.$_SESSION["zalogowany_id"]."/waiting/".$idForTheImage."_".$firstPhotoName.".webp";
          $checkIfExists = $polaczenie->query("SELECT * FROM waiting_articles_images_locations WHERE postId = $idForTheImage AND place = 0");
          if(!$checkIfExists) throw new Exception($polaczenie->connection_error);
          if($checkIfExists->num_rows == 0){
            if(move_uploaded_file($_FILES["first-photo"]["tmp_name"],$target_dirname)){
              $infoAboutIt = $polaczenie->query("INSERT INTO waiting_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',0)");
              if(!$infoAboutIt) throw new Exception($polaczenie->error);
              if(!(isset($_POST["second-name"]) && isset($_FILES["second-photo"]))){
              
              }
              
            }
            else{
              exitInstructions("First photo -Failed to upload the image");
            }
          }
          else{
            $row = $checkIfExists->fetch_assoc();
            unlink($row["address"]);
            $localImageId = $row["id"];
            if(move_uploaded_file($_FILES["first-photo"]["tmp_name"],$target_dirname)){
              
              $infoAboutIt = $polaczenie->query("UPDATE waiting_articles_images_locations SET address = '$target_dirname' WHERE id = $localImageId");
              if(!$infoAboutIt) throw new Exception($polaczenie->error);
              if(!(isset($_POST["second-name"]) && isset($_FILES["second-photo"]))){
                
              }
              
            }
            else{
              exitInstructions("First photo -Failed to upload the image");
            }
          }

        }

    }
    if(isset($_POST["second-name"]) && isset($_FILES["second-photo"]) && !empty($_FILES["second-photo"]["tmp_name"])){
        $secondPhotoName = $_POST["second-name"];
        $secondPhotoName = htmlentities($secondPhotoName,ENT_QUOTES,"UTF-8");
        $dir = "../articlesImages/";
        $uploadOk = 1;
        $target_dirname = $dir.$_SESSION["zalogowany_id"]."/".$idForTheImage."_".$secondPhotoName.".webp";
        if(file_exists($target_dirname)){
          exitInstructions("Second photo - Image already exists");
        }
        if($_FILES["second-photo"]["size"] > 36000000){
          exitInstructions("Second photo - Image is too large");
        }
        $toCheckTheFormat= $dir.basename($_FILES["second-photo"]["name"]);
        $imageType = strtolower(pathinfo($toCheckTheFormat,PATHINFO_EXTENSION));
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif" && $imageType != "webp"){
          exitInstructions("Second photo - Only jpg, png, jpeg,webp and gif format");
        }
        if($status == 2){
          if(move_uploaded_file($_FILES["second-photo"]["tmp_name"],$target_dirname)){
            $infoAboutIt = $polaczenie->query("INSERT INTO sent_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',1)");
            if(!$infoAboutIt) throw new Exception($connection->error);
          }
          else{
            exitInstructions("Second photo - Failed to upload the image");
          }
        }
        else{
          $target_dirname = $dir.$_SESSION["zalogowany_id"]."/waiting/".$idForTheImage."_".$secondPhotoName.".webp";
          $checkIfExists = $polaczenie->query("SELECT * FROM waiting_articles_images_locations WHERE postId = $idForTheImage AND place = 1");
          if(!$checkIfExists) throw new Exception($polaczenie->connection_error);
          if($checkIfExists->num_rows == 0){
            if(move_uploaded_file($_FILES["second-photo"]["tmp_name"],$target_dirname)){
              $infoAboutIt = $polaczenie->query("INSERT INTO waiting_articles_images_locations VALUES(NULL,$idForTheImage,'$target_dirname',1)");
              if(!$infoAboutIt) throw new Exception($connection->error);
              
            }
            else{
              exitInstructions("Second photo - Failed to upload the image");
            }
          }
          else{
            $row = $checkIfExists->fetch_assoc();
            unlink($row["address"]);
            $localImageId = $row["id"];
            if(move_uploaded_file($_FILES["second-photo"]["tmp_name"],$target_dirname)){
              $infoAboutIt = $polaczenie->query("UPDATE waiting_articles_images_locations SET address = '$target_dirname' WHERE id = $localImageId");
              if(!$infoAboutIt) throw new Exception($polaczenie->error);
              
            }
            else{
              exitInstructions("Second photo - Failed to upload the image");
            }
          }

        }

    }
    if($status == 2 && $flag == 1){
        $getPictures = $polaczenie->query("SELECT * FROM waiting_articles_images_locations WHERE postId = $idForTheImage ORDER BY place ASC");
        if(!$getPictures) throw new Exception($polaczenie->error);
        if($getPictures->num_rows > 0){
          for($i = 0 ; $i < $getPictures->num_rows; $i++){
            $row = $getPictures->fetch_assoc();
            $address = $row["address"];
            $newAddr = str_replace("waiting/",$postId."_",$address);
            rename($address,$newAddr);
            $confirm = $polaczenie->query("INSERT INTO sent_articles_images_locations VALUES(NULL,$postId,'$newAddr',$i)");
            if(!$confirm) throw new Exception($polaczenie->error);
        }
      }
      $makeSpace = $polaczenie->query("DELETE FROM waiting_articles_images_locations WHERE postId = $idForTheImage");
      if(!$makeSpace) throw new Exception($polaczenie->error);
    }
    exitInstructions("Your article has been sent");
?>