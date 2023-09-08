<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
       header('location: login.php');
    }

    ?>
    <div class="card">
        <div class="card-header">Customers Data</div>
        <div class="card-body">
            <br>
            <a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a>
            <br /><br />
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
                <?php
                //include our login information
                require_once("db_login.php");
                $query = "SELECT * FROM customers ORDER BY customerid";
                $result = $db->query($query);
                if (!$result) {
                    die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query);
                }
                //execute the query
                $i = 1;
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row->name . '</td>';
                    echo '<td>' . $row->address . '</td>';
                    echo '<td>' . $row->city . '</td>';
                    echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit<a/>&nbsp;&nbsp; <a class="btn btn-danger btn-sm" href="delete_customer.php?id=' . $row->customerid . '">Delete</a></td>';
                    echo '</tr>';
                    $i++;
                }
                echo '</table>';
                echo '<br/>';
                echo 'Total Rows= ' . $result->num_rows;
                $result->free();
                $db->close();
                ?>
            </table>
            <br><br>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>