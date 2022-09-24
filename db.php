<?php
    //======================================================================
    //====================Open The Connection===============================
    //======================================================================
    $conn = mysqli_connect('localhost', 'alaa', '', 'blog');
    if(!$conn){
        mysqli_connect_error();
        exit;
    }
    //======================================================================
    //===================Operation==========================================
    //======================================================================
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        echo "ID => " . $row['id'] . "<br>";
        echo "First Name => " . $row['first_name'] . "<br>";
        echo "Last Name => " . $row['last_name'] . "<br>";
        echo "Phone => " . $row['phone_no'] . "<br>";
        echo str_repeat("-", 50) . "<br><br>";
    }
    //======================================================================
    //==================Close The Connection================================
    //======================================================================
    mysqli_free_result($result);
    mysqli_close($conn);