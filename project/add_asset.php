<?php
require_once('./connection/connect.php');
session_start();

       
$sql = "SELECT * FROM categories"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);






?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Asset</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">Epicle</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a href="./server/logout.php?logout=true" class="btn btn-danger float-end"
                onclick="return confirm('Are you sure you want to log out?')">Logout</a>
                
            </li>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Add Asset</h2>
    <form action="./server/handler.php" method="POST" enctype="multipart/form-data">


        <div class="form-group">
            <label for="name">Asset Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="qtity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" required>
        </div>
  
    <div class="form-group">
    <label for="id">Category:</label>
    <select class="form-control" name="category_id" required>
        <option value="" disabled selected>Select a category</option>
        <?php
        
        foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
}
        ?>
    </select>
    </div>

        
        <div class="form-group">
            <label for="asset_image" >Image:</label>
            <input type="file" class="form-control" name="image" required>

</div>
        <button type="submit" class="btn btn-success" name="assetsubmit"><i class="fas fa-check"></i> Add Asset</button>
        <a href="create_asset.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </form>
</div>


</body>
</html>
