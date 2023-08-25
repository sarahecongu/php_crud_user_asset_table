<?php

require_once('./connection/connect.php');



?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
       if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        $sql = "SELECT * FROM users  WHERE id=:users_id ";
        $stmt = $conn->prepare($sql);
        $data = [':users_id' => $user_id];
        $stmt->execute($data);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


    }
    ?>


    <form action="./server/handler.php" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="pwd">password:</label>
            <input type="password" class="form-control" name="pwd" value="<?php echo $user['pwd']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="userupdate"><i class="fas fa-check"></i> Update User</button>
        <a href="users.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </form>
</div>


</body>
</html>
