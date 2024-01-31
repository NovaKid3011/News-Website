<?php

session_start();

$user_id = $_SESSION["user_id"];

if(!isset($_SESSION["user"])){
    header("Location: ../index.php");
}

require "../database.php";

if(isset($_POST['edit'])){

    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];

    mysqli_query($conn, "UPDATE users SET firstname = '$edit_firstname', lastname = '$edit_lastname', email = '$edit_email' WHERE id = '$user_id'") or die('query failed');

    $old_password = $_POST['old_password'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $newhashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

    if(!empty($oldpassword) || !empty($newpassword) || !empty($confirmnewpassword)){
        if(password_verify($old_password, $oldpassword)){
            echo "Old Password does not match!";
        }elseif($newpassword != $confirmnewpassword){
            echo "Confirm Password does not match!";
        }else{
            mysqli_query($conn, "UPDATE users SET password = '$newhashed_password' WHERE id = $user_id") or die('query failed');
            echo "All information has been updated successfully";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar min-vh-100">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="user-profile.php">User Profile</a></li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Posts
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-post.php">Add Post</a></li>
                                <li><a class="dropdown-item" href="manage-post.php">Manage Post</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content area -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-0">
            <!-- Navbar -->
            <nav class="navbar navbar-dark bg-dark mb-4 px-2">
                <a href="../logout.php" class="btn btn-warning">Logout</a>
            </nav>

            <!-- Main content -->
            <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    $select = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'")
                                    or die('query failed');
                                    if(mysqli_num_rows($select) > 0){
                                        $fetch = mysqli_fetch_assoc($select);
                                    }
                                ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="firstname">First Name:</label>
                                        <input type="text" class="form-control" id="firstname" name="edit_firstname" value="<?php echo $fetch['firstname'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name:</label>
                                        <input type="text" class="form-control" id="lastname" name="edit_lastname" value="<?php echo $fetch['lastname'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="edit_email" value="<?php echo $fetch['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="old_password" value="<?php echo $fetch['password']; ?>">
                                        <label for="password">Old Password:</label>
                                        <input type="password" class="form-control" id="password" name="oldpassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password:</label>
                                        <input type="password" class="form-control" id="password" name="newpassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm New Password:</label>
                                        <input type="password" class="form-control" id="password" name="confirmnewpassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                    <a href="user-profile.php" class="btn btn-secondary" type="button">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></script>

</body>
</html>