<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Registration Form
                    </div>

                    <?php

                        if (isset($_POST["submit"])){
                            $firstname = $_POST["firstname"];
                            $lastname = $_POST["lastname"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $confirmpassword = $_POST["confirmPassword"];
                            $role = $_POST["role"];

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $errors = array();

                            if (empty($firstname) OR empty($lastname) OR empty($email) OR empty($password) OR empty($confirmpassword) OR empty($role)){
                                array_push($errors, "All fields are required!");
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                array_push($errors, "Email is not valiid!");
                            }
                            if (strlen($password)<8){
                                array_push($errors, "Password must be at least 8 characters long!");
                            }
                            if ($password!==$confirmpassword){
                                array_push($errors, "Password does not match!");
                            }

                            require_once "database.php";
                            $sql = "SELECT * FROM users WHERE email = '$email'";
                            $result = mysqli_query($conn, $sql);
                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount>0){
                                array_push($errors,"Email already exists");
                            }
                            if (count($errors)>0){
                                foreach ($errors as $error){
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            }
                            else{
                                $sql = "INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                                if ($preparestmt){
                                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $passwordHash, $role);
                                    mysqli_stmt_execute($stmt);
                                    echo "<div class='alert alert-success'>You are registered succesfully.</div>";
                                }
                                else{
                                    die("Something went wrong.");
                                }
                            }
                        }

                    ?>

                    <div class="card-body">
                        <form action="registration-form.php" method="post">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" name="role" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Admin">
                                    <label class="form-check-label" for="inlineRadio1"><span class="badge bg-danger">Admin User</span></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="role" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Regular">
                                    <label class="form-check-label" for="inlineRadio2"><span class="badge bg-warning">Regular user</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Register</button>
                            <a href="index.php" class="btn btn-secondary" type="button">Back</a>
                        </form>
                        <div><p>Already Registered? <a href="login-form.php">Login Here</a></p></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</body>
</html>