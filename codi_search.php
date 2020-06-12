<?php
    session_start();
    //add to database
    require "config/config.php";
    if ( !isset($_GET['category'])
        || !isset($_GET['colors'])
        || empty($_GET['category'])
        || empty($_GET['colors'])
        || !is_numeric($_GET['category'])) {
        echo "Category and color are required.";
        exit();
    }
    else {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            //echo $mysqli->connect_error;
            exit();
        }
        $mysqli->set_charset("utf8");

        $sql_user = 'SELECT DISTINCT filepath FROM clothes
            INNER JOIN clothes_has_colors
            ON clothes.id = clothes_has_colors.clothes_id
            WHERE user_id = ' . $_SESSION['user_id'] .
            ' AND category_id = ' . $_GET['category'] . ' AND (0';

        //parse colors
        $colorArr = explode(" ", trim($_GET['colors']));
        foreach($colorArr as $value) {
            $sql_user .= (' OR clothes_has_colors.colors_id = ' . $value);
        }
        $sql_user .= ');';

        $result_user = $mysqli->query($sql_user);
        if ($result_user == false) {
            //echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        if ($result_user->num_rows == 0) {
            echo "No results";
            exit();
        }

        $mysqli->close();

        // Put all results into associative array
        $results_array = [];
        while($row = $result_user->fetch_assoc()['filepath']) {
            array_push($results_array, $row);
        }
        echo json_encode($results_array);
    }
?>