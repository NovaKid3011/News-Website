<?php
    session_start();

    $user_id = $_SESSION["user_id"];

    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }

    require "../database.php";

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
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Name: <?php echo $fetch['firstname'].$fetch['lastname']; ?></li>
                                    <li class="list-group-item">Email: <?php echo $fetch['email'] ?></li>
                                    <li class="list-group-item">Role: <?php echo $fetch['role'] ?></li>
                                    <a href="edit-user-profile.php" class="btn btn-primary">Edit</a>
                                </ul>
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