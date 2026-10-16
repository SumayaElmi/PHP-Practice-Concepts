
<!DOCTYPE html>
<html>
<head>
    <title>Upload Files in PHP</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select Your File
    <hr>
    <input type="file" name="scertificate" required>
    <hr>
    <input type="submit" name="submit" value="Upload File">
</form>

<?php
if (isset($_POST['submit'])) {

    if (
        isset($_FILES['scertificate']) &&
        $_FILES['scertificate']['error'] === UPLOAD_ERR_OK
    ) {

        echo "File Name: " .
            htmlspecialchars($_FILES['scertificate']['name']) . "<br>";

        echo "File Size: " .
            $_FILES['scertificate']['size'] . " bytes<br>";

        echo "Temporary Name: " .
            htmlspecialchars($_FILES['scertificate']['tmp_name']) . "<br>";

        echo "File Type: " .
            htmlspecialchars($_FILES['scertificate']['type']) . "<br>";

        $folder = "C:/Users/HP/Downloads/move files/";

        if (!is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        $temp = $_FILES['scertificate']['tmp_name'];
        $filename = basename($_FILES['scertificate']['name']);
        $destination = $folder . $filename;

        if (move_uploaded_file($temp, $destination)) {
            echo "<br>File has been uploaded successfully.";
        } else {
            echo "<br>Failed to upload the file.";
        }

    } else {
        echo "File upload failed or no file was selected.";
    }
}
?>

</body>
</html>
