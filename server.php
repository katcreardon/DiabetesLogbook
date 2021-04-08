<?php
    include "datalogin.php";
    session_start();
    $date = $_POST['date'];
    $entry_type = $_POST['entry_type'];

    // Insert values for breakfast, lunch, and dinner
    if (isset($_POST['add_entry'])) {
        // Receive all input values from the form
        if (empty($_POST['pre_time'])) {
            $pre_time = "NULL";
        } else {
            $pre_time = "'" . mysqli_real_escape_string($db, $_POST['pre_time']) . "'";
        }
        if (empty($_POST['post_time'])) {
            $post_time = "NULL";
        } else {
            $post_time = "'" . mysqli_real_escape_string($db, $_POST['post_time']) . "'";
        }
        if (empty($_POST['pre_blood_sugar'])) {
            $pre_blood_sugar = "NULL";
        } else {
            $pre_blood_sugar = "'" . mysqli_real_escape_string($db, $_POST['pre_blood_sugar']) . "'";
        }
        if (empty($_POST['post_blood_sugar'])) {
            $post_blood_sugar = "NULL";
        } else {
            $post_blood_sugar = "'" . mysqli_real_escape_string($db, $_POST['post_blood_sugar']) . "'";
        }
        if (empty($_POST['calories'])) {
            $calories = "NULL";
        } else {
            $calories = "'" . mysqli_real_escape_string($db, $_POST['calories']) . "'";
        }
        if (empty($_POST['carbs'])) {
            $carbs = "NULL";
        } else {
            $carbs = "'" . mysqli_real_escape_string($db, $_POST['carbs']) . "'";
        }

        // Add entry to database
        $query = "INSERT INTO entries (entry_number, date, entry_type, pre_time, post_time, pre_blood_sugar,
                     post_blood_sugar, calories, carbs) VALUES (NULL, '$date', '$entry_type', ".$pre_time.", 
                     ".$post_time.", ".$pre_blood_sugar.", ".$post_blood_sugar.", ".$calories.", ".$carbs.")";
        mysqli_query($db, $query);
    }

    // Edit values for breakfast, lunch, and dinner
    if (isset($_POST['edit_entry'])) {
        if (empty($_POST['pre_time'])) {
            $pre_time = "NULL";
        } else {
            $pre_time = "'" . mysqli_real_escape_string($db, $_POST['pre_time']) . "'";
        }
        if (empty($_POST['post_time'])) {
            $post_time = "NULL";
        } else {
            $post_time = "'" . mysqli_real_escape_string($db, $_POST['post_time']) . "'";
        }
        if (empty($_POST['pre_blood_sugar'])) {
            $pre_blood_sugar = "NULL";
        } else {
            $pre_blood_sugar = "'" . mysqli_real_escape_string($db, $_POST['pre_blood_sugar']) . "'";
        }
        if (empty($_POST['post_blood_sugar'])) {
            $post_blood_sugar = "NULL";
        } else {
            $post_blood_sugar = "'" . mysqli_real_escape_string($db, $_POST['post_blood_sugar']) . "'";
        }
        if (empty($_POST['calories'])) {
            $calories = "NULL";
        } else {
            $calories = "'" . mysqli_real_escape_string($db, $_POST['calories']) . "'";
        }
        if (empty($_POST['carbs'])) {
            $carbs = "NULL";
        } else {
            $carbs = "'" . mysqli_real_escape_string($db, $_POST['carbs']) . "'";
        }

        // Update entry
        $query = "UPDATE entries SET pre_time=".$pre_time.", post_time=".$post_time.", 
                    pre_blood_sugar=".$pre_blood_sugar.", post_blood_sugar=".$post_blood_sugar.", 
                    calories=".$calories.", carbs=".$carbs." WHERE date='$date' AND entry_type='$entry_type'";
        mysqli_query($db, $query);
    }

    // Insert values for snacks
    if (isset($_POST['add_snack'])) {
        $calories = mysqli_real_escape_string($db, $_POST['calories']);
        $carbs = mysqli_real_escape_string($db, $_POST['carbs']);

        $query = "INSERT INTO entries (entry_number, date, entry_type, pre_time, post_time, pre_blood_sugar, 
                     post_blood_sugar, calories, carbs) VALUES (NULL, '$date', '$entry_type', NULL, NULL, NULL, NULL,
                     '$calories', '$carbs')";
        mysqli_query($db, $query);
    }

    // Edit values for snack
    if (isset($_POST['edit_snack'])) {
        if (empty($_POST['calories'])) {
            $calories = "NULL";
        } else {
            $calories = "'" . mysqli_real_escape_string($db, $_POST['calories']) . "'";
        }
        if (empty($_POST['carbs'])) {
            $carbs = "NULL";
        } else {
            $carbs = "'" . mysqli_real_escape_string($db, $_POST['carbs']) . "'";
        }

        // Update entry
        $query = "UPDATE entries SET calories=".$calories.", carbs=".$carbs." WHERE date='$date' AND 
                        entry_type='$entry_type'";
        mysqli_query($db, $query);
    }

    // Insert blood sugar for bedtime
    if (isset($_POST['add_bedtime'])) {
        $blood_sugar = $_POST['blood_sugar'];

        $query = "INSERT INTO entries (entry_number, date, entry_type, pre_time, post_time, pre_blood_sugar, 
                     post_blood_sugar, calories, carbs) VALUES (NULL, '$date', '$entry_type', NULL, NULL, 
                     '$blood_sugar', NULL, NULL, NULL)";
        mysqli_query($db, $query);
    }

    // Edit blood sugar for bedtime
    if (isset($_POST['edit_bedtime'])) {
        $blood_sugar = "'" . mysqli_real_escape_string($db, $_POST['blood_sugar']) . "'";

        $query = "UPDATE entries SET pre_blood_sugar=".$blood_sugar." WHERE date='$date' AND entry_type='$entry_type'";
        mysqli_query($db, $query);
    }

    // Add food to database
    if (isset($_POST['add_food'])) {
        $name = $_POST['name'];
        $calories = $_POST['calories'];
        $carbs = $_POST['carbs'];

        if (strcmp($_POST['type'], "meal") == 0) {
            $query = "INSERT INTO meals (meal_number, name, calories, carbs) 
                        VALUES (NULL, '$name', '$calories', '$carbs')";
        } else {
            $query = "INSERT INTO snacks (snack_number, name, calories, carbs) 
                        VALUES (NULL, '$name', '$calories', '$carbs')";
        }
        mysqli_query($db, $query);
    }

    // Autocomplete search
    if (isset($_GET['term'])) {
        if (strcmp($_SESSION['search_type'], 'meal') == 0) {
            $query = "SELECT * FROM meals WHERE name LIKE '%{$_GET['term']}%' ORDER by name ASC";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($user = mysqli_fetch_array($result)) {
                    $res[] = $user['name'];
                }
            } else {
                $res = array();
            }
            //return json res
            echo json_encode($res);
        } else if (strcmp($_SESSION['search_type'], 'snack') == 0) {
            $query = "SELECT * from snacks WHERE name LIKE '%{$_GET['term']}%' ORDER by name ASC";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($user = mysqli_fetch_array($result)) {
                    $res[] = $user['name'];
                }
            } else {
                $res = array();
            }
            //return json res
            echo json_encode($res);
        }
    }