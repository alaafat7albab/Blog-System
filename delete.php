<?php
    //==============================================================================
    //=================Connect to DB================================================
    //==============================================================================
    $conn = mysqli_connect("localhost", "alaa", "iti", "blog");
    if(! $conn){
        mysqli_connect_error();
        exit;
    }

    //================================================================================
    //========================Select user & Delete Operation==========================
    //================================================================================
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "DELETE FROM `users` WHERE `users`.`id` =" .$id. " LIMIT 1 ";
    if(mysqli_query($conn, $query)){
        header("Location: allUsers.php");
        exit;
    }else{
        echo $query;
        echo mysqli_error($conn);
    }

    //==================================================================================
    //=====================Close The Connection=========================================
    //==================================================================================
    mysqli_close($conn);