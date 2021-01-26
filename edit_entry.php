<?php
    include "server.php";

    $value = $_GET['column'];
    $check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='$value'";
    $result = mysqli_query($db, $check_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $pre_time = $row['pre_time'];
        $post_time = $row['post_time'];
        $pre_blood_sugar = $row['pre_blood_sugar'];
        $post_blood_sugar = $row['post_blood_sugar'];
        $calories = $row['calories'];
        $carbs = $row['carbs'];
    }

    include "header.php";
?>

<html>
<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1><?php echo "Edit {$value}"; ?></h1>
            <form method="post" action="index.php">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Pre</th>
                        <th>Post</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Time</th>
                        <td>
                            <input type="time" name="pre_time" value="<?php echo $pre_time; ?>">
                        </td>
                        <td>
                            <input type="time" name="post_time" value="<?php echo $post_time; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Blood Sugar</th>
                        <td>
                            <input type="text" name="pre_blood_sugar" value="<?php echo $pre_blood_sugar; ?>">
                        </td>
                        <td>
                            <input type="text" name="post_blood_sugar" value="<?php echo $post_blood_sugar; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Calories</th>
                        <td>
                            <input type="text" name="calories" value="<?php echo $calories; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Carbs</th>
                        <td>
                            <input type="text" name="carbs" value="<?php echo $carbs; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="entry_type" value="<?php echo $value; ?>">
                            <button type="submit" class="btn" name="add_entry">Submit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>