<?php
include "server.php";
$value = $_GET['column'];
include "header.php";
?>

<html>
<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1><?php echo $value; ?></h1>
            <form method="post" action="index.php">
                <table>
                    <tbody>
                        <tr>
                            <th>Calories</th>
                            <td>
                                <input type="text" name="calories">
                            </td>
                        </tr>
                        <tr>
                            <th>Carbs</th>
                            <td>
                                <input type="text" name="carbs">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="entry_type" value="<?php echo $value; ?>">
                                <button type="submit" class="btn" name="add_snack">Submit</button>
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