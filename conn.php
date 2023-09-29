<?php 
    // conn1
    // vars to create connection string
    $server_name = "sql12.freemysqlhosting.net";
    $db_uname = "sql12649916";
    $db_pass = "KwxUANLqCH";
    $db_name = "sql12649916";
    $table_name = "useraccounts";

    // connection string
    $conn = mysqli_connect($server_name,$db_uname,$db_pass,$db_name);

    if(!$conn){
        die("Connection Failed! Error Code : " . mysqli_connect_error()); // display error
    }
    
?>