<?php include('./header.php') ?>

<?php
session_start();
if (!isset($_SESSION['username'])) {
   header('location: login.php');
}

require_once 'lib/db_login.php';
$id = "";

if (isset($_POST["submit"])) {
    $valid = true;
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = false;
    }

    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = false;
    }

    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = false;
    }

    if ($valid) {
        $address = $db->real_escape_string($address);
        $query = "INSERT INTO customers (name, address, city) VALUES ('$name','$address','$city') ";
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
        }
    }
}
?>
<div class="card m-5">
    <div class="card-header">Add Customers Data</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="">
                <div class="error"><?php if (isset($error_name)) {
                                        echo $error_name;
                                    } ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                <div class="error"><?php if (isset($error_address)) {
                                        echo $error_address;
                                    } ?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="city">city:</label>
                <select name="city" id="city" class="form-select" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected=true'; ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected=true'; ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected=true'; ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected=true'; ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include('./footer.php') ?>

<?php
    $db->close();
?>