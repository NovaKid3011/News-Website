<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }
    require "../database.php";

    if(isset($_POST['submit']))
    {
    $titlename=$_POST['posttitle'];
    $category=$_POST['category'];
    $description=$_POST['postdescription'];
    $image=$_FILES["postimage"]["name"];
    // get the image extension
    $extension = substr($image,strlen($image)-4,strlen($image));
    // allowed extensions
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if(!in_array($extension,$allowed_extensions))
    {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    }
    else
    {
    //rename the image file
    $imgnewfile=md5($image).$extension;
    // Code for move image into directory
    move_uploaded_file($_FILES["postimage"]["tmp_name"],"uploads/".$imgnewfile);
    
    $status=1;
    $query=mysqli_query($conn,"insert into posts(title_name,category,description,image) values('$titlename','$category','$description','$imgnewfile')");
    if($query)
    {
    header('Location: manage-post.php');
    }
    else{
    echo "Something went wrong . Please try again.";
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
                <form name="addpost" method="post" enctype="multipart/form-data" class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Post Title</label>
                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category" id="category" required>
                            <option value="Business">Business</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Sports">Sports</option>
                            <option value="Technology">Technology</option>    
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                <textarea class="summernote" name="postdescription" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                <input type="file" class="form-control" id="postimage" name="postimage" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom waves-effect waves-light btn-md">Save and Post</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></script>

</body>
</html>