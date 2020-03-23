<section class="soundUpload">
    <div class="upload-buttonsContainer">
        <button class="multimedia-mode sound-opener">Sound</button>
        <button class="multimedia-mode video-opener">Video</button>
    </div>
    <form method = "post" action = "articles/uploadingSupport/postSound.php" enctype="multipart/form-data" class = "soundUpload-form">
        <section class = "postHeader">
            Title of sound <input type = "text" name = "title" class = "titleInput" required/>
        </section>
        <main class = "mainUploadSection">
            <input type = "file" name = "fileToUpload" class = "soundForUpload" style = "display: none;" required/>
            <input type="button" value="Browse..." class = "forUploadBtn" onclick="document.querySelector('.soundForUpload').click();" />
            <section class = "submitSection">
                <input name = "submit" type="submit" class = "uploadSubmitButton" value = "Send this sound to public"/>
            </section>
            </main>
        </form>
        <form action="articles/uploadingSupport/postVideo.php" enctype="multipart/form-data" method="post" class = "videoUpload-form">
        <section class = "postHeader">
            Title of video <input type = "text" name = "title" class = "titleInput" required/>
        </section>
        <main class = "mainUploadSection">
            <input type = "file" name = "fileToUpload" class = "videoForUpload" style = "display: none;" required/>
            <input type="button" value="Browse..." class = "forUploadBtn" onclick="document.querySelector('.videoForUpload').click();" />
        </main>   
        <section class="video-icon">
            <section class = "postHeader photo-header">
                Video icon (optional) <input type = "text" name = "video-icon-title" class = "titleInput" />
            </section>
            <main class = "mainUploadSection">
                <input type = "file" name = "photoToUpload" class = "photoForUpload" style = "display: none;"/>
                <input type="button" value="Browse..." class = "forUploadBtn" onclick="document.querySelector('.photoForUpload').click();" />
                <section class = "submitSection">
                    <input name = "submit" type="submit" class = "uploadSubmitButton" value = "Send this video to public"/>
                </section>
            </main>    
        </section>  
      
    </form>
</section>