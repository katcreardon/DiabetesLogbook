<?php
    include "server.php";
    $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m"),
        date("d") - 1, date("Y")));

    if (isset($_POST['change_date'])) {
        $date = $_POST['prev_date'];
    } else {
        $date = $yesterday;
    }

    $breakfast_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='Breakfast'";
    $bf_result = mysqli_query($db, $breakfast_check_query);
    if (mysqli_num_rows($bf_result) < 1) {
        $bf_empty = true;
        $bf_calories = "0";
        $bf_carbs = "0";
    }
    while ($field = mysqli_fetch_assoc($bf_result)) {
        if (is_null($field['pre_time'])) {
            $bf_pre_time = "";
        } else {
            $bf_pre_time = date('g:i A', strtotime($field['pre_time']));
        }
        if (is_null($field['post_time'])) {
            $bf_post_time = "";
        } else {
            $bf_post_time = date('g:i A', strtotime($field['post_time']));
        }
        $bf_pre_blood_sugar = $field['pre_blood_sugar'];
        $bf_post_blood_sugar = $field['post_blood_sugar'];
        if (is_null($field['calories'])) {
            $bf_calories = "0";
        } else {
            $bf_calories = $field['calories'];
        }
        if (is_null($field['carbs'])) {
            $bf_carbs = "0";
        } else {
            $bf_carbs = $field['carbs'];
        }
    }

    $lunch_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='Lunch'";
    $l_result = mysqli_query($db, $lunch_check_query);
    if (mysqli_num_rows($l_result) < 1) {
        $l_empty = true;
        $l_calories = "0";
        $l_carbs = "0";
    }
    while ($field = mysqli_fetch_assoc($l_result)) {
        if (is_null($field['pre_time'])) {
            $l_pre_time = "";
        } else {
            $l_pre_time = date('g:i A', strtotime($field['pre_time']));
        }
        if (is_null($field['post_time'])) {
            $l_post_time = "";
        } else {
            $l_post_time = date('g:i A', strtotime($field['post_time']));
        }
        $l_pre_blood_sugar = $field['pre_blood_sugar'];
        $l_post_blood_sugar = $field['post_blood_sugar'];
        if (is_null($field['calories'])) {
            $l_calories = "0";
        } else {
            $l_calories = $field['calories'];
        }
        if (is_null($field['carbs'])) {
            $l_carbs = "0";
        } else {
            $l_carbs = $field['carbs'];
        }
    }

    $s1_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='First Snack'";
    $s1_result = mysqli_query($db, $s1_check_query);
    if (mysqli_num_rows($s1_result) < 1) {
        $s1_empty = true;
        $s1_calories = "0";
        $s1_carbs = "0";
    }
    while ($field = mysqli_fetch_assoc($s1_result)) {
        if (is_null($field['calories'])) {
            $s1_calories = "0";
        } else {
            $s1_calories = $field['calories'];
        }
        if (is_null($field['carbs'])) {
            $s1_carbs = "0";
        } else {
            $s1_carbs = $field['carbs'];
        }
    }

    $d_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='Dinner'";
    $d_result = mysqli_query($db, $d_check_query);
    if (mysqli_num_rows($d_result) < 1) {
        $d_empty = true;
        $d_calories = "0";
        $d_carbs = "0";
    }
    while ($field = mysqli_fetch_assoc($d_result)) {
        if (is_null($field['pre_time'])) {
            $d_pre_time = "";
        } else {
            $d_pre_time = date('g:i A', strtotime($field['pre_time']));
        }
        if (is_null($field['post_time'])) {
            $d_post_time = "";
        } else {
            $d_post_time = date('g:i A', strtotime($field['post_time']));
        }
        $d_pre_blood_sugar = $field['pre_blood_sugar'];
        $d_post_blood_sugar = $field['post_blood_sugar'];
        if (is_null($field['calories'])) {
            $d_calories = "0";
        } else {
            $d_calories = $field['calories'];
        }
        if (is_null($field['carbs'])) {
            $d_carbs = "0";
        } else {
            $d_carbs = $field['carbs'];
        }
    }

    $s2_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='Second Snack'";
    $s2_result = mysqli_query($db, $s2_check_query);
    if (mysqli_num_rows($s2_result) < 1) {
        $s2_empty = true;
        $s2_calories = "0";
        $s2_carbs = "0";
    }
    while ($field = mysqli_fetch_assoc($s2_result)) {
        if (is_null($field['calories'])) {
            $s2_calories = "0";
        } else {
            $s2_calories = $field['calories'];
        }
        if (is_null($field['carbs'])) {
            $s2_carbs = "0";
        } else {
            $s2_carbs = $field['carbs'];
        }
    }

    $bed_check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='Bedtime'";
    $bed_result = mysqli_query($db, $bed_check_query);
    if (mysqli_num_rows($bed_result) < 1) {
        $bed_empty = true;
    }
    while ($field = mysqli_fetch_assoc($bed_result)) {
        if (is_null($field['pre_time'])) {
            $bed_pre_time = "";
        } else {
            $bed_pre_time = $field['pre_time'];
        }
        $bed_pre_blood_sugar = $field['pre_blood_sugar'];
    }

    $total_calories = $bf_calories + $l_calories + $s1_calories + $d_calories + $s2_calories;
    $total_carbs = $bf_carbs + $l_carbs + $s1_carbs + $d_carbs + $s2_carbs;

    include "header.php";
?>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <div style="margin-top: 20px; margin-bottom: 20px">
                <form method="post">
                    <label for="date">Select a date:</label>
                    <input type="date" id="date" name="prev_date" value="<?php echo $date; ?>"
                           max="<?php echo $yesterday; ?>">
                    <input type="submit" name="change_date"/>
                </form>
            </div>
            <h1 style="margin-bottom: 20px"><?php echo date('l\, F j\, Y', strtotime($date)); ?></h1>
            <table class="log-table">
                <thead>
                <tr>
                    <th rowspan="2"></th>
                    <th colspan="2">Breakfast</th>
                    <th colspan="2">Lunch</th>
                    <th colspan="2" rowspan="2">Snack</th>
                    <th colspan="2">Dinner</th>
                    <th colspan="2" rowspan="2">Snack</th>
                    <th colspan="2" rowspan="2">Bedtime</th>
                </tr>
                <tr>
                    <th>Pre</th>
                    <th>Post</th>
                    <th>Pre</th>
                    <th>Post</th>
                    <th>Pre</th>
                    <th>Post</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Time</th>
                    <td>
                        <?php echo $bf_pre_time; ?>
                    </td>
                    <td>
                        <?php echo $bf_post_time; ?>
                    </td>
                    <td>
                        <?php echo $l_pre_time; ?>
                    </td>
                    <td>
                        <?php echo $l_post_time; ?>
                    </td>
                    <td colspan="2" rowspan="2"></td>
                    <td>
                        <?php echo $d_pre_time; ?>
                    </td>
                    <td>
                        <?php echo $d_post_time; ?>
                    </td>
                    <td colspan="2" rowspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th>Blood Sugar</th>
                    <td>
                        <?php echo $bf_pre_blood_sugar; ?>
                    </td>
                    <td>
                        <?php echo $bf_post_blood_sugar; ?>
                    </td>
                    <td>
                        <?php echo $l_pre_blood_sugar; ?>
                    </td>
                    <td>
                        <?php echo $l_post_blood_sugar; ?>
                    </td>
                    <td>
                        <?php echo $d_pre_blood_sugar; ?>
                    </td>
                    <td>
                        <?php echo $d_post_blood_sugar; ?>
                    </td>
                    <td colspan="2">
                        <?php echo $bed_pre_blood_sugar; ?>
                    </td>
                </tr>
                <tr>
                    <th>Calories</th>
                    <td colspan="2">
                        <?php echo $bf_calories."/400";?>
                    </td>
                    <td colspan="2">
                        <?php echo $l_calories."/400";?>
                    </td>
                    <td colspan="2">
                        <?php echo $s1_calories."/200";?>
                    </td>
                    <td colspan="2">
                        <?php echo $d_calories."/400";?>
                    </td>
                    <td colspan="2">
                        <?php echo $s2_calories."/200";?>
                    </td>
                    <td colspan="2" rowspan="2"></td>
                </tr>
                <tr>
                    <th>Carbs</th>
                    <td colspan="2">
                        <?php echo $bf_carbs."/45" ?>
                    </td>
                    <td colspan="2">
                        <?php echo $l_carbs."/50" ?>
                    </td>
                    <td colspan="2">
                        <?php echo $s1_carbs."/20" ?>
                    </td>
                    <td colspan="2">
                        <?php echo $d_carbs."/50" ?>
                    </td>
                    <td colspan="2">
                        <?php echo $s2_carbs."/20" ?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <?php
                    if ($bf_empty) {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='add_entry.php'>
                                 <input type='hidden' name='column' value='Breakfast'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Add'>
                            </form>
                       </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='edit_entry.php'>
                                <input type='hidden' name='column' value='Breakfast'>
                                <input type='hidden' name='date' value='" . $date . "'>
                                <input type='submit' value='Edit'>
                            </form>
                         </td>";
                    }
                    if ($l_empty) {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='add_entry.php'>
                                <input type='hidden' name='column' value='Lunch'>
                                <input type='hidden' name='date' value='" . $date . "'>
                                <input type='submit' value='Add'>
                            </form>
                         </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='edit_entry.php'>
                                 <input type='hidden' name='column' value='Lunch'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Edit'>
                             </form>
                         </td>";
                    }
                    if ($s1_empty) {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='add_snack.php'>
                                 <input type='hidden' name='column' value='First Snack'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Add'>
                             </form>
                         </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='edit_snack.php'>
                                 <input type='hidden' name='column' value='First Snack'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Edit'>
                             </form>
                         </td>";
                    }
                    if ($d_empty) {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='add_entry.php'>
                                <input type='hidden' name='column' value='Dinner'>
                                <input type='hidden' name='date' value='" . $date . "'>
                                <input type='submit' value='Add'>
                            </form>
                        </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='edit_entry.php'>
                                 <input type='hidden' name='column' value='Dinner'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Edit'>
                             </form>
                         </td>";
                    }
                    if ($s2_empty) {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='add_snack.php'>
                                <input type='hidden' name='column' value='Second Snack'>
                                <input type='hidden' name='date' value='" . $date . "'>
                                <input type='submit' value='Add'>
                            </form>
                        </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                            <form method='get' action='edit_snack.php'>
                                <input type='hidden' name='column' value='Second Snack'>
                                <input type='hidden' name='date' value='" . $date . "'>
                                <input type='submit' value='Edit'>
                            </form>
                        </td>";
                    }
                    if ($bed_empty) {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='add_bedtime.php'>
                                 <input type='hidden' name='column' value='Bedtime'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Add'>
                             </form>
                         </td>";
                    } else {
                        echo
                            "<td colspan='2'>
                             <form method='get' action='edit_bedtime.php'>
                                 <input type='hidden' name='column' value='Bedtime'>
                                 <input type='hidden' name='date' value='" . $date . "'>
                                 <input type='submit' value='Edit'>
                             </form>
                         </td>";
                    }
                    ?>
                </tr>
                </tbody>
            </table>
            <table style="margin-top: 20px">
                <caption><h3>Totals</h3></caption>
                <tr>
                    <th>Calories</th>
                    <td><?php echo $total_calories."/1500"; ?></td>
                </tr>
                <tr>
                    <th>Carbs</th>
                    <td><?php echo $total_carbs."/170"; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

</body>
</html>
