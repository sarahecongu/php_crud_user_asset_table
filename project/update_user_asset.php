
<?php
require_once('./connection/connect.php');
// Fetch and display asset options
$assetQuery = "SELECT id, name FROM assets";
$assetStmt = $conn->prepare($assetQuery);
$assetStmt->execute();
$assets = $assetStmt->fetchAll(PDO::FETCH_ASSOC);


// Fetch and display user options
$userQuery = "SELECT id, first_name, last_name FROM users";
$userStmt = $conn->prepare($userQuery);
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);





if (isset($_GET['id'])) {

    $user_asset_id = $_GET['id'];

    $sql = "SELECT * FROM user_asset WHERE id = :user_asset_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_asset_id', $user_asset_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);



}







?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit user_asset</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">Epic</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Services</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Update Assets</h2>


        <form action="./server/handler.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
          

            <div class="form-group">
    <label for="user_id">User_Name</label>
    <select class="form-control" name="id" required>
        <?php
        foreach ($users as $user) {
            $selected = ($user['id'] == $result['user_id']) ? "selected" : "";
            echo "<option value='" . $user['id'] . "' $selected>" . $user['first_name'] . " " . $user['last_name'] . "</option>";
        }
        ?>
    </select>
</div>


<div class="form-group">
    <label for="asset_id">Asset_Name</label>
    <select class="form-control" name="id" required>
        <?php
        foreach ($assets as $asset) {
            $selected = ($asset['id'] == $result['asset_id']) ? "selected" : "";
            echo "<option value='" . $asset['id'] . "' $selected>" . $asset['name'] . "</option>";
        }
        ?>
    </select>
</div>
<div class="form-group">
                <label for="assigned_by">Assigned By:</label>
                <input type="text" name="assigned_by" value="<?= $row['assigned_by'] ?>" required class="form-control">
                
            </div>
           
            <div class="form-group">
                <label for="return_date">return_date</label>
                <input type="date" class="form-control" name="return_date" value="<?php echo $result['return_date'] ?>" required>
            </div>
            




            <button type="submit" class="btn btn-primary" name="update_user_asset"><i class="fas fa-check"></i> Update
                Asset</button>
            <a href="update_user_asset.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back </a>
        </form>
    </div>
</body>

</html>