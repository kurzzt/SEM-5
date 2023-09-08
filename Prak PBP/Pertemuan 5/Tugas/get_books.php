<?php
    require_once('db_login.php');
    $title = $_GET['id'];
    //Asign a query
    $query = "SELECT * FROM books where title='".$title."'";
    $result = $db->query($query);
    if (!$result){
        die ("Could not query the database: <br />". $db->error);
    }
    // Fetch and display the results
    while ($row = $result->fetch_object()){
        echo 'Author: '.$row->author.'<br />';
        echo 'Title: '.$row->title.'<br />';
        echo 'Price: '.$row->price.'<br />';
    }
    $result->free();
    $db->close();
?>