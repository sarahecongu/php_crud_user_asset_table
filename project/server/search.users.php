<?php
require_once('./connection/connect.php');

if (isset($_POST['search_user']) && !empty($_POST['search_user'])) {
    $search =$_POST['search_user'];
    $query = "SELECT * FROM users WHERE first_name=:search_user || last_name=:search_user || email = :search_user ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':search_user', $search, PDO::PARAM_STR);
} else {
    $query = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $conn->prepare($query);
}