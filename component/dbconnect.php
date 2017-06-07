<?php
    //Enter your database connection details here.
    $host = 'testingforfun.space'; //HOST NAME.
    $db_name = 'gio_bookstore'; //Database Name
    $db_username = 'gio_root'; //Database Username
    $db_password = 'h4nsk3mpl0ganteng'; //Database Password

    try
    {
        $pdo = new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
    }
    catch (PDOException $e)
    {
        exit('Error Connecting To DataBase');
    }
?>
