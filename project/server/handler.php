<?php

session_start();
require_once('../connection/connect.php');
// creating a new user
if (isset($_POST['usersubmit'])) {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    try {
        $sql = "INSERT INTO users (first_name, last_name, email, pwd) VALUES (:firstname, :lastname, :email, :pwd)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstname', $first_name);
        $stmt->bindParam(':lastname', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        echo "User created successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    header('Location: ../users.php');
    exit(0);
}
if (isset($_POST['userupdate'])) {
    $user_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    try {
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name,email = :email WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        echo "User updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../users.php');
    exit(0);
}

// deleting a user

if (isset($_POST['userdelete'])) {
    $user_id = $_POST['userdelete'];

    try {
        $sql = "DELETE FROM users WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();
        echo "User deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../users.php');
    exit(0);
}

// category

if (isset($_POST['categorysubmit'])) {
    $category_name = $_POST['name'];

    try {
        $sql = "INSERT INTO categories (name) VALUES (:category_name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_name', $category_name);

        $stmt->execute();
        echo "Category created successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../create_category.php');
    exit(0);
}


// read

try {
    $sql = "SELECT * FROM categories";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        }
    } else {
        echo "No categories found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// update

if (isset($_POST['categoryupdate'])) {

    $category_id = $_POST['id'];
    $category_name = $_POST['name'];

    try {
        $sql = "UPDATE categories SET name = :category_name WHERE id = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':category_id', $category_id);

        $stmt->execute();
        echo "Category updated successfully.";


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../create_category.php');
    exit(0);
}
// delete

if (isset($_POST['categorydelete'])) {
    $category_id = $_POST['categorydelete'];

    try {
        $sql = "DELETE FROM categories WHERE id = :categories_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categories_id', $category_id);

        $stmt->execute();
        echo "Category deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../create_category.php');
    exit(0);
}
// user asset

// CREATE operation

if (isset($_POST['add_user_asset'])) {
    $user_id = $_POST['user_id'];
    $asset_id = $_POST['asset_id'];
    $assigned_by = $_POST['assigned_by'];
    $given_date = $_POST['given_date'];
    $return_date = $_POST['return_date'];

    try {
        $sql = "INSERT INTO user_asset (user_id, asset_id, assigned_by, given_date, return_date)
                VALUES (:user_id, :asset_id, :assigned_by, :given_date, :return_date)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':asset_id', $asset_id);
        $stmt->bindParam(':assigned_by', $assigned_by);
        $stmt->bindParam(':given_date', $given_date);
        $stmt->bindParam(':return_date', $return_date);

        $stmt->execute();
        echo "User Asset added successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header("location:../create_user_asset.php");
    exit();
}




// update
if (isset($_POST['update_user_asset'])) {
    $user_asset_id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $asset_id = $_POST['asset_id'];
    $assigned_by = $_POST['assigned_by'];
    $given_date = $_POST['given_date'];
    $return_date = $_POST['return_date'];

    try {
        $sql = "UPDATE user_asset SET user_id = :user_id, asset_id = :asset_id,
                assigned_by = :assigned_by, given_date = :given_date, return_date = :return_date
                WHERE id = :user_asset_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':asset_id', $asset_id);
        $stmt->bindParam(':assigned_by', $assigned_by);
        $stmt->bindParam(':given_date', $given_date);
        $stmt->bindParam(':return_date', $return_date);
        $stmt->bindParam(':user_asset_id', $user_asset_id);

        $stmt->execute();
        echo "User Asset updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
// delete
if (isset($_POST['delete_user_asset'])) {
    $user_asset_id = $_POST['id'];

    try {
        $sql = "DELETE FROM user_asset WHERE id = :user_asset_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_asset_id', $user_asset_id);
        $stmt->execute();
        echo "User Asset deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



// Assets

if (isset($_POST['assetsubmit'])) {
    $asset_name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
   

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'images/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    try {
        $insertQuery = "INSERT INTO assets (name,quantity, category_id,image)
                        VALUES (:asset_name, :quantity, :category_id, :asset_image)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':asset_name', $asset_name);
        $insertStmt->bindParam(':quantity', $quantity);
        $insertStmt->bindParam(':category_id', $category_id);
        $insertStmt->bindParam(':asset_image', $imagePath);
       

        $insertStmt->execute();
        echo "Asset created successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
     header('Location: ../create_asset.php');
     exit(0);
}

// Read operation
try {
    
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
        }
    } else {
        echo "No assets found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Update operation
if (isset($_POST['assetupdate'])) {
    $asset_id = $_POST['id'];
    $asset_name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];

        $imagePath = $result['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $newImagePath = 'images/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $newImagePath);
        $imagePath = $newImagePath;
    

    try {
        $sql = "UPDATE assets SET name = :asset_name, quantity = :quantity, image = :asset_image, category_id = :category_id WHERE id = :asset_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':asset_name', $asset_name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':asset_image', $imagePath);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':asset_id', $asset_id);

        $stmt->execute();
        echo "Asset updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../create_asset.php');
     exit(0);
}
}
// Delete operation
if (isset($_POST['assetdelete'])) {
    $asset_id = $_POST['assetdelete'];

    try {
        $sql = "DELETE FROM assets WHERE id = :asset_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':asset_id', $asset_id);

        $stmt->execute();
        echo "Asset deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location: ../create_asset.php');
    exit(0);
}


