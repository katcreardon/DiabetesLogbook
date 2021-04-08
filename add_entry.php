<?php
    include "server.php";
    session_start();
    $_SESSION['search_type'] = 'meal';
    $value = $_GET['column'];
    $date = $_GET['date'];

    // Set calories and carbs fields based on search
    if (isset($_POST['submit_search'])) {
        $name = $_POST['food_input'];
        $query = "SELECT calories, carbs FROM meals WHERE name='$name'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($field = mysqli_fetch_assoc($result)) {
                $calories = $field['calories'];
                $carbs = $field['carbs'];
            }
        }
    }
    include "header.php";
?>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Initialize autocomplete -->
<script>
    $(function() {
        $("#food_input").autocomplete({
            source: "server.php",
        });
    });
</script>

<body>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1><?php echo $value; ?></h1>
            <form method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
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
                                <input type="time" name="pre_time">
                            </td>
                            <td>
                                <input type="time" name="post_time">
                            </td>
                        </tr>
                        <tr>
                            <th>Blood Sugar</th>
                            <td>
                                <input type="text" name="pre_blood_sugar">
                            </td>
                            <td>
                                <input type="text" name="post_blood_sugar">
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
                                <input type="hidden" name="date" value="<?php echo $date; ?>">
                                <button type="submit" class="btn" name="add_entry">Submit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="w3-twothird" style="margin-top: 20px">
            <label>Search for Food:</label>
            <div>
                <form method="post">
                    <input type="text" name="food_input" id="food_input" style="width: 60%"/>
                    <input type="submit" name="submit_search"/>
                </form>
            </div>
        </div>
    </div>
</div

</body>
</html>