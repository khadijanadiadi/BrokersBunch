<?php
// Include the database configuration file
include '../config/config.php';
$statusMsg = '';

// File upload path
$targetDir = "../app/uploads/";
$fileName = basename($_FILES["certificate"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["certificate"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFilePath))
		{
            // Insert image file name into database
            $insert = $db->query("INSERT into broker (certificate) VALUES ('".$fileName."')");
            if($insert)
			{
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }
			else
			{
                $statusMsg = "File upload failed, please try again.";
            } 
        }
		else
		{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }
	else
	{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}
else
{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>