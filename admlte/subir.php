<?php
    //Check if the file is well uploaded
print_r($_FILES);
    if($_FILES['file']['error'] > 0) { echo 'Error during uploading, try again'.$_FILES['file']['error']; }
    
    //We won't use $_FILES['file']['type'] to check the file extension for security purpose
    
    //Set up valid image extensions
    $extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );
    
    //Extract extention from uploaded file
        //substr return ".jpg"
        //Strrchr return "jpg"
        
    $extUpload = strtolower( substr( strrchr($_FILES['file']['name'], '.') ,1) ) ;
    //Check if the uploaded file extension is allowed
    
    if (in_array($extUpload, $extsAllowed) ) { 
    
    //Upload the file on the server
    
    $name = "uplodas/{$_FILES['file']['name']}";
    $result = move_uploaded_file($_FILES['file']['tmp_name'], $name);
    
    if($result){echo "ok";}
        
    } else { echo 'File is not valid. Please try again'; }
    
?>