<?php
require_once('./connection/connect.php');
// require_once('./server/search.users.php');









?>
<!DOCTYPE html>
<html>

<head>
    <title>Users CRUD</title>
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Users CRUD</title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .image {
                background-image: url('https://img.freepik.com/premium-photo/interior-background-contemporary-shelves-wall-desktop-apartment-design-computer-living-generative-ai_163305-172176.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 500px;
                background-attachment: fixed
            }
        </style>
    </head>

    <body class="image">

        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light bg-dark text-white">
            <a class="navbar-brand text-white" href="#">Epicle </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item text-white">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item text-white">
                        <a href="./server/logout.php?logout=true" class="btn btn-danger float-end"
                            onclick="return confirm('Are you sure you want to log out?')">Logout</a>

                    </li>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-5">
            <!-- searchbar -->
            <div class="row">
                <div class="col-md-12 mt-4">
                    <form action="users.php" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control text-center" name="search_user"
                                placeholder="Search for a user">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class=" ">
                <a href="users_add.php" class="btn btn-success fixed mt-4 mb-3 float-mid-center"><i
                        class="fas fa-user-plus"></i>
                    Add User</a>
            </div>


            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users ORDER BY id DESC";
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
                                            <?= ucfirst($row['first_name']); ?>
                                        </td>
                                        <td>
                                            <?= ucwords(substr($row['last_name'], 0, 2)) . strtolower(substr($row['last_name'], 2)); ?>
                                        </td>
                                        <td>
                                            <?= $row['email'] ?>
                                        </td>
                                        
                                        <td>
                                            <?= $row['created_at']; ?>
                                        </td>
                                        <td>
                                            <?= $row['updated_at']; ?>
                                        </td>
                                      

                                        <td>
                                            <a href="users_update.php?id=<?= $row['id'] ?>"
                                                class="btn btn-success btn-sm float-end">
                                                <i class="bi bi-pencil-square"></i> EDIT
                                            </a>
                                        </td>
                                        <td>
                                            <form action="./server/handler.php" method="POST">
                                                <button type="submit" name="userdelete" class="btn btn-danger btn-sm float-end"
                                                    value="<?= $row['id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete user?')">
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