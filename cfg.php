<?php

    $conn = new mysqli("localhost", "root", "", "minigame");
    
    if($conn->connect_error){
       die("Connection failed! ".$conn->connect_error);
    }

?>