<?php
    //========================================================================
    //============================Connect to DB===============================
    //========================================================================
    $conn = mysqli_connect("localhost", "alaa", "iti", "blog");
    if(! $conn){
        mysqli_connect_error();
        exit;
    }

    //=======================================================================
    //===================SELECT Query========================================
    //=======================================================================
    $query = "SELECT * FROM `users`";

    //=======================================================================
    //===================Search Query========================================
    //=======================================================================
    if($_GET['search']){
        $search = mysqli_escape_string($conn, $_GET['search']);
        $query .= " WHERE `users`.`first_name` LIKE '%".$search."%' OR `users`.`last_name` LIKE '%".$search."%' OR `users`.`email` LIKE '%".$search."%'";
    }
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Users</title>
        <meta charset="UTF-8">
        <link href="form.css" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 style="color: #2d3e3f; text-align: center;padding: 10px">List Of Users</h1>
        <br>
        <div class="form-group col-md-4" style="margin-left: 10%; margin-bottom: 2.5%">
            <form method="GET">
                <label for="example-search-input"></label>
                <input class="form-control rounded-0 py-2" type="search" id="example-search-input" name="search" placeholder="Search...">
            </form>
        </div>
        <br>
        <!-- /.form-group -->
        <table style="padding: 10px; text-align: center" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?= $row['id']?></td>
                    <td><?= $row['first_name']?></td>
                    <td><?= $row['last_name']?></td>
                    <td><?= $row['phone_no']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['gender']?></td>
                    <td><?= ($row['admin']) ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="./info.php?id=<?= $row['id']?>"><button style="margin-right: 10px" class="btn btn-info">Info</button></a>
                        <a href="./update.php?id=<?= $row['id']?>"><button style="margin-right: 10px" class="btn btn-warning">Update</button></a>
                        <a href="./delete.php?id=<?= $row['id']?>"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><h3>Users</h3></td>
                    <td colspan="3"><h3 style="color: #ff6600"><?= mysqli_num_rows($result)?></h3></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <a href="./add.php"><button class="btn btn-primary" >Add User</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>