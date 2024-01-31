<?php
session_start();
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid bg-body-tertiary">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">ALO NEWS</a>
                        </li>
                    </ul>
                    
                    <?php if(!isset($_SESSION["user"])): ?>

                        <form class="d-flex" role="search">
                            <a href="login-form.php" class="btn btn-outline-success" type="submit">Login</a>
                        </form>
                        <form class="d-flex" role="search">
                            <a href="registration-form.php" class="btn btn-outline-success" type="submit">Registration</a>
                        </form>

                    <?php else: ?>

                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                            </ul>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            </nav>          
        </div>  
    </div>

    <div class="container min-vh-100 p-5">
            <?php
                $query = "SELECT * FROM posts";
                $result = mysqli_query($conn, $query);

                while($data = $result->fetch_assoc()){
            ?>

            <div class="card my-5" style="width: 75%;">
            <img src="admin/uploads/<?php echo $data['image'] ?>" class="card-img-top" alt="image" width="40%" height="40%">
            <div class="card-body">
                <h4 class="card-title"><?php echo $data['title_name'] ?></h4>
                <p class="card-title">Date Uploaded: <?php echo $data['date_uploaded'] ?></p>
                <p class="card-text">Description: <?php echo $data['description'] ?></p>
                <btn class="btn btn-primary"><?php echo $data['category'] ?></btn>
            </div>
            </div>

            <?php
                }
            ?>
    </div>

<!--                     echo "<h2>{$data['title_name']}</h2> <h5>Category: {$data['category']}</h5> <p>Date Uploaded: {$data['date_uploaded']}</p>";
                    echo "<img src='admin/uploads/{$data['image']}' width='40%' height='40%'>";
                    echo "<p>Description: {$data['description']}</p>";    -->            

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></script>

</body>
</html>              