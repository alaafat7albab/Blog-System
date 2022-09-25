<?php
    //===============================================================================
    //========================Validation=============================================
    //===============================================================================
    $error_field = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!(isset($_POST['first_name']) && !empty($_POST['first_name']))) {
            $error_field[] = "first_name";
        }
        if (!(isset($_POST['last_name']) && !empty($_POST['last_name']))) {
            $error_field[] = "last_name";
        }
        if (!(isset($_POST['phone_no']) && !is_int($_POST['phone_no']))) {
            $error_field[] = "phone_no";
        }
        if (!(isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
            $error_field[] = "email";
        }
        if (!(isset($_POST['password']) && strlen($_POST['password']) > 5)) {
            $error_field[] = "password";
        }

        //================================Saving Data to DB=================================
        //==================================================================================
        //==================================================================================
        if (!$error_field) {
            //===============Connect to DB==================================================
            $conn = mysqli_connect("localhost", "alaa", "iti", "blog");
            if (!$conn) {
                mysqli_connect_error();
                exit;
            }

            //=============Escape special characters to avoid sql injection=================
            $firstName = mysqli_escape_string($conn, $_POST['first_name']);
            $lastName = mysqli_escape_string($conn, $_POST['last_name']);
            $phoneNo = mysqli_escape_string($conn, $_POST['phone_no']);
            $email = mysqli_escape_string($conn, $_POST['email']);
            $password = mysqli_escape_string($conn, $_POST['password']);
            $gender = $_POST['gender'];
            $admin = $_POST['admin'];

            //===========================Insertion===========================================
            $query = "INSERT INTO `users`  (`first_name`, `last_name`, `phone_no`, `email`, `password`, `gender`, `admin`) 
                VALUES ('" . $firstName . "', '" . $lastName . "', " . $phoneNo . ", '" . $email . "', sha1('" . $password . "'), '" . $gender . "', ".$admin.")";
            if (mysqli_query($conn, $query)) {
                header("Location: allUsers.php ");
                exit;
            } else {
                mysqli_errno($conn);
            }
            //=============================Close Connection===========================
            mysqli_close($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin :: Add User</title>
        <meta charset="UTF-8">
        <link href="form.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <form method="post">
                <!--First name-->
                <div class="box">
                    <label for="firstName" class="fl fontLabel"> First Name: </label>
                    <div class="new iconBox">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <label>
                            <input type="text" name="first_name" placeholder="First Name"
                                   class="textBox" value="<?=$_POST['first_name']?>">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("first_name", $error_field)){
                    echo "<div style='color: red; padding: 2px'>* Please Enter First Name</div>";
                }
                ?>
                <!--First name-->

                <!--Second name-->
                <div class="box">
                    <label for="secondName" class="fl fontLabel"> Second Name: </label>
                    <div class="fl iconBox"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="text"  name="last_name"
                                   placeholder="Last Name" class="textBox" value="<?=$_POST['last_name']?>">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("last_name", $error_field)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Last Name</p>";
                }
                ?>
                <!--Second name-->

                <!---Phone No.------>
                <div class="box">
                    <label for="phone" class="fl fontLabel"> Phone No.: </label>
                    <div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="text"  name="phone_no" maxlength="10" placeholder="Phone No." class="textBox" value="<?=$_POST['phone_no']?>">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("phone_no", $error_field)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Valid Phone Number</p>";
                }
                ?>
                <!---Phone No.---->

                <!---Email ID---->
                <div class="box">
                    <label for="email" class="fl fontLabel"> Email ID: </label>
                    <div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="email"  name="email" placeholder="Email Id" class="textBox" value="<?=$_POST['email']?>">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("email", $error_field)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Valid Email</p>";
                }
                ?>
                <!--Email ID----->

                <!---Password------>
                <div class="box">
                    <label for="password" class="fl fontLabel"> Password </label>
                    <div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="Password"  name="password" placeholder="Password" class="textBox">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("password", $error_field)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Password Greater Than 5</p>";
                }
                ?>
                <!---Password---->

                <!---Gender----->
                <div class="box radio">
                    <label for="gender" class="fl fontLabel"> Gender: </label>
                    <label>
                        <input type="radio" name="gender" value="male" >
                    </label> Male &nbsp; &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="gender" value="female" >
                    </label> Female
                </div>
                <!---Gender--->

                <!---admin----->
                <div class="box radio">
                    <label for="gender" class="fl fontLabel"> Admin: </label>
                    <label>
                        <input type="radio" name="admin" value="0" >
                    </label> user &nbsp; &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="admin" value="1" >
                    </label> admin
                </div>
                <!---admin--->

                <!---Submit Button------>
                <div class="box" style="background: #2d3e3f">
                    <input type="Submit" name="Submit" class="submit" value="SUBMIT">
                </div>
                <!---Submit Button----->
            </form>
        </div>
    </body>
</html>
