<?php
    $error_field = array();
    //===============================================================================
    //================================Open The Connection============================
    //===============================================================================
    $conn = mysqli_connect("localhost", "alaa", "iti", "blog");
    if(! $conn){
        mysqli_connect_error();
        exit;
    }

    //==============================================================================
    //======================Select User=============================================
    //==============================================================================
    $id     =   filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $select =   "SELECT * FROM `users` WHERE `users`.`id` = ".$id." LIMIT 1 ";
    $result =   mysqli_query($conn, $select);
    $row    =   mysqli_fetch_assoc($result);

    //==============================================================================
    //===============================Validation=====================================
    //==============================================================================
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

        //===============================================================================
        //============Escape special Characters to avoid sql injection===================
        //===============================================================================
        if (! $error_field) {
            $first_name = mysqli_escape_string($conn, $_POST['first_name']);
            $last_name = mysqli_escape_string($conn, $_POST['last_name']);
            $phone_no = mysqli_escape_string($conn, $_POST['phone_no']);
            $email = mysqli_escape_string($conn, $_POST['email']);
            $password = mysqli_escape_string($conn, $_POST['password']);
            $admin = $_POST['admin'];
            $gender = $_POST['gender'];

            //================================================================================
            //===========================Update Operation=====================================
            //================================================================================
            $query = "UPDATE `users` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`phone_no`=".$phone_no.",
                    `email`='".$email."',`password`=sha1('".$password."'), `admin`=".$admin.", `gender`='".$gender."' WHERE `users`.`id`=".$id;
            if(mysqli_query($conn,$query)){
                header("Location: allUsers.php");
                exit;
            }else{
                mysqli_error($conn);
            }
        }
    }
    //====================================================================================
    //==========================Close Connection==========================================
    //====================================================================================
    mysqli_free_result($result);
    mysqli_close($conn);
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
        <form method="POST">
            <!--First name-->
            <div class="box">
                <label for="firstName" class="fl fontLabel"> First Name: </label>
                <div class="new iconBox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="fr">
                    <label>
                        <input type="text" name="first_name" placeholder="First Name"
                               class="textBox" value="<?=(isset($row['first_name'])) ? $row['first_name'] : '' ?>">
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
                               placeholder="Last Name" class="textBox" value="<?=(isset($row['last_name'])) ? $row['last_name'] : '' ?>">
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

            <!--hidden id-->
            <input type="hidden" name="id" id="id" value="<?=(isset($row['id'])) ? $row['id'] : '' ?>">
            <!--hidden id-->

            <!---Phone No.------>
            <div class="box">
                <label for="phone" class="fl fontLabel"> Phone No.: </label>
                <div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                <div class="fr">
                    <label>
                        <input type="text"  name="phone_no" maxlength="10" placeholder="Phone No." class="textBox" value="<?=(isset($row['phone_no'])) ? $row['phone_no'] : '' ?>">
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
                        <input type="email"  name="email" placeholder="Email Id" class="textBox" value="<?=(isset($row['email'])) ? $row['email'] : '' ?>">
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
                        <input type="Password"  name="password" placeholder="Password" class="textBox" value="<?=(isset($row['password'])) ? $row['password'] : '' ?>">
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
                    <input type="radio" name="gender" value="male" <?=($row['gender'])=='male'? 'checked' : ''?> >
                </label> Male &nbsp; &nbsp; &nbsp; &nbsp;
                <label>
                    <input type="radio" name="gender" value="female" <?=($row['gender'])=='female'? 'checked' : ''?> >
                </label> Female
            </div>
            <!---Gender--->

            <!---admin----->
            <div class="box radio">
                <label for="gender" class="fl fontLabel"> Admin: </label>
                <label>
                    <input type="radio" name="admin" value="0" <?=($row['admin'])==0? 'checked' : ''?>  >
                </label> user &nbsp; &nbsp; &nbsp; &nbsp;
                <label>
                    <input type="radio" name="admin" value="1" <?=($row['admin'])==1? 'checked' : ''?>  >
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

