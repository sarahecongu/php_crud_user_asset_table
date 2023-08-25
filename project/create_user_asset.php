<?php
require_once('./connection/connect.php');




?>


<!DOCTYPE html>
<html>

<head>
    <title>Assets CRUD</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .image {
        /* background-image: url('https://img.freepik.com/premium-photo/interior-background-contemporary-shelves-wall-desktop-apartment-design-computer-living-generative-ai_163305-172176.jpg'); */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

        background-attachment: "fixed"
    }
</style>

<body class="image">

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light bg-dark text-white">
        <a class="navbar-brand text-white" href="#">Epicle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Services</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- searchbar -->
        <div class="row">
            <div class="col-md-12 mt-4">
                <form action="create_user_asset.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_asset"
                            placeholder="Search for an asset for the user">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 d-flex mt-4">


                <a href="add_user_asset.php" class="btn btn-success float-end  mb-3 "><i class="fas fa-plus "></i> Add
                    Asset</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead class="table-group-divider">
                        <tr>
                            <th>Id</th>
                            <th>Asset Name</th>
                            <th>User</th>
                            <th>Return date</th>
                            <th>Given date</th>
                         
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        
                    // $query = "SELECT user_asset.*, users.first_name, users.last_name, assets.name
                    // FROM user_asset
                    // LEFT JOIN users ON user_asset.user_id = users.id
                    //     LEFT JOIN assets ON user_asset.asset_id = assets.id
                    //             ORDER BY user_asset.id DESC";

                  $query ="SELECT user_asset.*, users.id, users.first_name, users.last_name, assets.name
                    FROM user_asset
                    LEFT JOIN users ON user_asset.user_id = users.id
                    LEFT JOIN assets ON user_asset.asset_id = assets.id
                    ORDER BY user_asset.id DESC ";


                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result) {
                            foreach ($result as $row) {
                                ?>

                                <tr>
                                    <td>
                                        <?= $row['id'] ?>
                                    </td>
                                    <td>
                                        <?= $row['name']; ?>
                                    </td>



                                    <td>
                                        <?= $row['first_name'] . " " . $row['last_name'] ?>
                                    </td>
                                    <td><?= $row['assigned_by'] ?></td>
                                    <td>
                                        <?= $row['return_date']; ?>
                                    </td>

                                    <td>
                                        <?= $row['given_date']; ?>
                                    </td>
                                   




                                    <!-- edit -->
                                    <td>
                                        <a href="update_user_asset.php?id=<?= $row['id'] ?>"
                                            class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-pencil-square"></i> EDIT
                                        </a>
                                    </td>

                                    <td>
                                        <form action="./server/handler.php" method="POST">
                                            <button type="submit" name="user_asset_delete" class="btn btn-danger btn-sm "
                                                value="<?= $row['id']; ?>"
                                                onclick="return confirm('Are you sure you want to delete user_asset?')">
                                                <i class="bi bi-trash3"></i> DELETE
                                            </button>

                                        </form>


                                    </td>
                                </tr>
                                <?php
                            }

                        } else {
                            ?>
                            <tr>
                                <td colspan="12">No Record</td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</body>

</html>



</body>

</html>