<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: ../index.php");
}
require "../database.php";

$id = $_GET['editid'];

if (isset($_POST['edit'])) {
    $titlename = $_POST['posttitle'];
    $cat = $_POST['cat'];
    $description = $_POST['postdescription'];
    $image = $_FILES["postimage"]["name"];
    
    // Validate file extension
    $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
    } else {
        // Rename the image file
        $imgnewfile = md5($image) . "." . $extension;

        // Move the uploaded file to the destination directory
        move_uploaded_file($_FILES["postimage"]["tmp_name"], "uploads/" . $imgnewfile);

        // Use prepared statement to avoid SQL injection
        $query = "UPDATE `posts` SET title_name = ?, category = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $titlename, $cat, $description, $imgnewfile, $id);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            header('Location: manage-post.php');
            exit();
        } else {
            echo "Something went wrong. Please try again.";
        }

        // Close the statement
        $stmt->close();
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
        <!-- Main content area -->
        <div class="col-md-12 col-lg-12 p-5">
            <!-- Main content -->
            <main>

                <?php
                    if(isset($id)){
                        $select = "SELECT * FROM posts WHERE id = $id";
                        $result = mysqli_query($conn, $select);
                        $row = mysqli_fetch_array($result);

                ?>

                <form name="editpost" method="post" enctype="multipart/form-data" class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Post Title</label>
                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" value="<?php echo $row['title_name'] ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1" >Category</label>
                        <select class="form-control" name="cat" id="cat" required>
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
                                <textarea class="summernote" name="postdescription"><?php echo $row['description'] ?></textarea>
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
                    <button type="submit" name="edit" class="btn btn-custom waves-effect waves-light btn-md bg-dark text-white">Edit</button>
                    <a href="manage-post.php" class="btn btn-secondary" type="button">Back</a>
                </form>

                <?php
                    }
                ?>
                
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></script>

</body>
</html>