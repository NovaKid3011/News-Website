<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }
    require "../database.php";

    $query = "SELECT * FROM posts";
    $result = mysqli_query($conn, $query);
    
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
                <div class="container">
                    <div class="row mt-5">
                        <div class="col">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h2 class="display-6 text-center">Posts</h2>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <td> Post ID </td>
                                            <td> Title Name </td>
                                            <td> Category </td>
                                            <td> Description </td>
                                            <td> Image </td>
                                            <td> Date Uploaded </td>
                                            <td> Edit </td>
                                            <td> Delete </td>
                                        </tr>
                                        <tr>
                                        <?php
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $id = $row['id'];
                                                    $titlename = $row['title_name'];
                                                    $category = $row['category'];
                                                    $description = $row['description'];
                                                    $image = $row['image'];
                                                    $dateuploaded = $row['date_uploaded'];
                                                
                                        ?>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $titlename ?></td>
                                            <td><?php echo $category ?></td>
                                            <td><?php echo $description ?></td>
                                            <td><img src="<?php echo "uploads/".$image ?>" width="100px" alt="image"></td>
                                            <td><?php echo $dateuploaded ?></td>
                                            <td><a href="edit-post.php?editid=<?php echo $id ?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="delete-post.php?deleteid=<?php echo $id ?>" class="btn btn-danger">Delete</a></td>

                                        </tr>
                                        <?php
                                            }
                                            }
                                        ?>

                                    </table>
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