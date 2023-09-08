<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Logout</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <?php
        session_start();
        if(isset($_SESSION['username'])){
            unset($_SESSION['username']);
            session_destroy();
        }
        header('Location: login.php');
    ?>
    <body>
        <div class="card">
            <div class="card-header">Customers Data</div>
            <div class="card-body">
            </div>
        </div>
    </body>
</html>