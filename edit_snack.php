<?php
    include "server.php";

    $value = $_GET['column'];
    $check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='$value'";
    $result = mysqli_query($db, $check_query);

    while ($row = mysqli_fetch_assoc($result)) {;
        $calories = $row['calories'];
        $carbs = $row['carbs'];
    }

    include('header.php');
?>

<html>
<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1><?php echo "Edit {$value}"; ?></h1>
            <form method="post" action="index.php">
                <table>
                    <tbody>
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
                            <button type="submit" class="btn" name="edit_snack">Submit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
<!--                <div class="input-group">-->
<!--                    <label>Calories</label>-->
<!--                    <input type="text" name="calories" value="--><?php //echo $calories; ?><!--" required>-->
<!--                </div>-->
<!--                <div class="input-group">-->
<!--                    <label>Carbs</label>-->
<!--                    <input type="text" name="carbs" value="--><?php //echo $carbs; ?><!--" required>-->
<!--                </div>-->
<!--                <div class="input-group">-->
<!--                    <input type="hidden" name="entry_type" value="--><?php //echo $value; ?><!--">-->
<!--                    <button type="submit" class="btn" name="edit_snack">Submit</button>-->
<!--                </div>-->
            </form>
        </div>
    </div>
</div>
</body>
</html>
