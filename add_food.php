<?php
include "server.php";
include "header.php";
?>

<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1>Add Meal or Snack</h1>
            <form method="post">
                <table>
                    <tbody>
                    <tr>
                        <th>Type</th>
                        <td>
                            <select name="type">
                                <option value="meal">Meal</option>
                                <option value="snack">Snack</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>
                            <input type="text" name="name" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Calories</th>
                        <td>
                            <input type="text" name="calories" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Carbs</th>
                        <td>
                            <input type="text" name="carbs" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn" name="add_food">Submit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            <?php
                if (isset($_POST['add_food'])) {
                    echo $_POST['name'] . " successfully added.";
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>
