<?php

    //===============================================================
    //========================Debugger===============================
    //===============================================================
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //===============================================================
    //====================Validation=================================
    //===============================================================
    $error_fields = array();
    if (! (isset($_POST['first_name']) && !empty($_POST['first_name']))){
        $error_fields[] = "first_name";
    }
    if (! (isset($_POST['last_name']) && !empty($_POST['last_name']))){
        $error_fields[] = "last_name";
    }
    if (! (isset($_POST['phone_no']) &&  !is_int($_POST['phone_no']) && !empty($_POST['phone_no']))){
        $error_fields[] = "phone_no";
    }
    if (! (isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL ))){
        $error_fields[] = "email";
    }
    if (! (isset($_POST['password']) && strlen($_POST['password']) > 5)){
        $error_fields[] = "password";
    }
    if($error_fields){
        header("Location: form.php?error_fields=" . implode(',', $error_fields));
        exit;
    }

    //=======================================================================
    //=======================Open The Connection=============================
    //=======================================================================
    $conn = mysqli_connect("localhost", "alaa", "iti", "blog");
    if(! $conn){
        mysqli_connect_error($conn);
        exit;
    }

    //===============================================================================================
    //==============Escape any special characters to avoid the sql injection=========================
    //===============================================================================================
    $firstName  =   mysqli_escape_string($conn, $_POST['first_name']);
    $lastName   =   mysqli_escape_string($conn, $_POST['last_name']);
    $phoneNo    =   mysqli_escape_string($conn, $_POST['phone_no']);
    $email      =   mysqli_escape_string($conn, $_POST['email']);
    $password   =   mysqli_escape_string($conn, $_POST['password']);

    //=================================================================
    //======================Insertion==================================
    //=================================================================
    $query  = "INSERT INTO `users`  (`first_name`, `last_name`, `phone_no`, `email`, `password`, `gender`) 
                VALUES ('".$firstName."', '".$lastName."', ".$phoneNo.", '".$email."', sha1('".$password."'), '".$_POST['gender']."')";

    if(mysqli_query($conn, $query)) {
        if ($_POST['gender'] == 'female') {
            echo "<h1 style='color: deeppink'> Hello " . $_POST['first_name'] . "</h1>";
        } else if ($_POST['gender'] == 'male') {
            echo "<h1 style='color: blue'> Hello " . $_POST['first_name'] . "</h1>";
        }
    }
    //===================================================================
    //========================Close The Connection=======================
    //===================================================================
    mysqli_close($conn);

