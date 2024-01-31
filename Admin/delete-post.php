<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: ../index.php");
}
    require_once "../database.php";

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM posts WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('Location: manage-post.php');
        }else{
            die(mysqli_error($conn));
        }
    }
?>