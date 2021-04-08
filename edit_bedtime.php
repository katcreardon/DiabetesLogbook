<?php
    include "server.php";
    $value = $_GET['column'];
    $date = $_GET['date'];
    $check_query = "SELECT * FROM entries WHERE date='$date' AND entry_type='$value'";
    $result = mysqli_query($db, $check_query);
    while ($row = mysqli_fetch_assoc($result)) {;
        $blood_sugar = $row['pre_blood_sugar'];
    }
    include "header.php";
?>

<html>
<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1><?php echo "Edit {$value}"; ?></h1>
            <form method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                <table>
                    <tbody>
                    <tr>
                        <th>Blood Sugar</th>
                        <td>
                            <input type="text" name="blood_sugar" value="<?php echo $blood_sugar; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="entry_type" value="<?php echo $value; ?>">
                            <input type="hidden" name="date" value="<?php echo $date; ?>">
                            <button type="submit" class="btn" name="edit_bedtime">Submit</button>
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
