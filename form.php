<?php
    //===============================================================
    //=================Check For Errors==============================
    //===============================================================
    $error_array = array();
    if($_GET['error_fields']){
        $error_array = explode(',', $_GET['error_fields']);
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Form</title>
        <link href="form.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
     <!-- Body of Form starts -->
        <div class="container">
            <form action="./process.php" method="post">
                <!--First name-->
                <div class="box">
                    <label for="firstName" class="fl fontLabel"> First Name: </label>
                    <div class="new iconBox">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <label>
                            <input type="text" name="first_name" placeholder="First Name"
                                   class="textBox">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                    if(in_array("first_name", $error_array)){
                        echo "<p style='color: red; padding: 2px'>* Please Enter First Name</p>";
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
                                   placeholder="Last Name" class="textBox">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("last_name", $error_array)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Second Name</p>";
                }
                ?>
                <!--Second name-->


                <!---Phone No.------>
                <div class="box">
                    <label for="phone" class="fl fontLabel"> Phone No.: </label>
                    <div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="text"  name="phone_no" maxlength="10" placeholder="Phone No." class="textBox">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("phone_no", $error_array)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter Phone Number</p>";
                }
                ?>
                <!---Phone No.---->


                <!---Email ID---->
                <div class="box">
                    <label for="email" class="fl fontLabel"> Email ID: </label>
                    <div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="fr">
                        <label>
                            <input type="email"  name="email" placeholder="Email Id" class="textBox">
                        </label>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                if(in_array("email", $error_array)){
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
                if(in_array("password", $error_array)){
                    echo "<p style='color: red; padding: 2px'>* Please Enter password Greater than 5</p>";
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


                <!--Terms and Conditions------>
                <div class="box terms">
                    <label>
                        <input type="checkbox" name="Terms" >
                    </label> &nbsp; I accept the terms and conditions
                </div>
                <!--Terms and Conditions------>


                <!---Submit Button------>
                <div class="box" style="background: #2d3e3f">
                    <input type="Submit" name="Submit" class="submit" value="SUBMIT">
                </div>
                <!---Submit Button----->
            </form>
        </div>
    <!--Body of Form ends--->
    </body>
</html>