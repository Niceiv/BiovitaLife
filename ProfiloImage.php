<?php

?>
<div class="col-md-4">
    <!-- Profile picture card-->
    <div class="card mb-3 gx-3">
        <div class=" text-center">Foto Profilo</div>
        <div class="card-body text-center">
            <!-- Profile picture image-->
            <div class="avatar-wrapper">
                <img class="profile-pic" src="" />
                <div class="upload-button">
                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                </div>
                <input class="file-upload" enctype="multipart/form-data" id="FileToUpload" name="FileToUpload"
                    type="file" accept="image/*" />
            </div>
            <!-- Profile picture help block-->
            <div class="small font-italic text-muted "><input type="submit" value="Carica"></div>
            <!-- Profile picture upload button-->

        </div>
    </div>

</div>