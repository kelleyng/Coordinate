<?php
    session_start();
    if (!isset($_FILES["fileToUpload"]["name"]) || empty($_FILES["fileToUpload"]["name"])) {
        $error = "Image required.";
    }
    else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error = "File already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 400000) {
            $error = "Your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = "Only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }
        if (!isset($error) || !$error) {
            //add to database
            require "config/config.php";
            if ( !isset($_POST['category'])
                || !isset($_POST['colors'])
                || empty($_POST['category'])
                || empty($_POST['colors']) ) {
                $error = "Category and/or color are missing.";
            }
            else {
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($mysqli->connect_errno) {
                    //echo $mysqli->connect_error;
                    exit();
                }
                $mysqli->set_charset("utf8");

                $addStmt = $mysqli->prepare(
                    'INSERT INTO clothes(user_id, category_id, filepath) VALUES(?,?,?);');
                $addStmt->bind_param('iis', $_SESSION['user_id'], $_POST['category'], $target_file);
                $executed = $addStmt->execute();
                if(!$executed) {
                    //echo $mysqli->error;
                    $mysqli->close();
                    exit();
                }

                //get clothes_id
                $sql_clothes = 'SELECT id FROM clothes WHERE filepath LIKE \'' . $target_file . '\';';
                $result_clothes = $mysqli->query($sql_clothes);
                if ($result_clothes == false) {
                    //echo $mysqli->error;
                    $mysqli->close();
                    exit();
                }
                $clothes_id = $result_clothes->fetch_assoc()['id'];

                //parse colors
                $colorArr = explode(" ", trim($_POST['colors']));

                foreach($colorArr as $value) {
                    $linkStmt = $mysqli->prepare(
                        'INSERT INTO clothes_has_colors(clothes_id, colors_id) VALUES(?,?);');
                    $linkStmt->bind_param('ii', $clothes_id, $value);
                    $executed = $linkStmt->execute();
                    if(!$executed) {
                        //echo $mysqli->error;
                        $mysqli->close();
                        exit();
                    }
                }
                $mysqli->close();
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!-- mobile first -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="styles/shared.css">
    <link rel="stylesheet" href="styles/upload_confirmation.css">
    <title>Upload Confirmation</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container text-center">
        <h1 id="title">coordinate</h1>
        <?php if(isset($error) && !empty($error)): ?>
            <p id="fail"><?php echo $error?></p>
        <?php else: ?>
            <p id="success" class="row justify-content-center">Succesfully uploaded</p>
        <?php endif; ?>
        <a id="back-btn" class="row btn btn-warning" type="button" href="upload.php">return to upload page</a>
    </div>
    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>