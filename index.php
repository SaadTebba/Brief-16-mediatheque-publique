<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brief-16</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?<?= time(); ?>">
</head>

<body>

    <main>

        <!-- ::::::::::::::::::::::::::::::::::: Header (navbar, h1, button, arrow, 100vh) ::::::::::::::::::::::::::::::::::: -->

        <?php include "header.php" ?>

        <!-- ::::::::::::::::::::::::::::::::::: Cards container (Search, Cards, Pagination) ::::::::::::::::::::::::::::::::::: -->

        <div class="container">
            <form method="POST">
                <div class="input-group m-5">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                    <select class="border" name="filter_search">
                        <option value="All">All</option>
                        <option value="Books">Books</option>
                        <option value="Music">Music</option>
                        <option value="Audio books">Audio books</option>
                        <option value="Movies">Movies</option>
                        <option value="Comics">Comics</option>
                    </select>
                    <button type="submit" class="btn searchbtn border" title="Search"><i class="fas fa-search filtersearch"></i></button>
                </div>
            </form>
        </div>


        <div class="container text-center">

            <?php

            $cards = 6;

            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }

            $starting = ($page - 1) * $cards;

            if (isset($_POST['search'])) {

                $searched_value = $_POST['search'];

                if ($_POST['filter_search'] == 'All') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Title LIKE '{$searched_value}%'"); // add ((( LIMIT $starting, $cards ))) for pagination
                } elseif ($_POST['filter_search'] == 'Books') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Category_Code = 1 AND Title LIKE '{$searched_value}%'");
                } elseif ($_POST['filter_search'] == 'Music') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Category_Code = 2 AND Title LIKE '{$searched_value}%'");
                } elseif ($_POST['filter_search'] == 'Audio books') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Category_Code = 3 AND Title LIKE '{$searched_value}%'");
                } elseif ($_POST['filter_search'] == 'Movies') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Category_Code = 4 AND Title LIKE '{$searched_value}%'");
                } elseif ($_POST['filter_search'] == 'Comics') {
                    $statement = $conn->prepare("SELECT * FROM `item` WHERE Category_Code = 5 AND Title LIKE '{$searched_value}%'");
                }
            } else {
                $statement = $conn->prepare("SELECT * FROM `item`");
            }

            $statement->execute();
            $items = $statement->fetchAll();

            if ($items == null) {
                echo "<h3 id='noResults' class='mb-5'>Unfortunately, there are no matches for your search</h3>";
                $statement = $conn->prepare("SELECT * FROM item WHERE 1 = 0");
                $statement->execute();
                $items = $statement->fetchAll();
            }

            foreach ($items as $item) {

            ?>

                <div class="card d-inline-block mb-3 mx-2">
                    <div class="row">
                        <div class="col-md-4 images-container">
                            <img src="<?php echo $item['Cover_Image']; ?>" class="img-fluid rounded-start" alt="Card image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-start" <?php $id = $item['Item_Code']; ?>>
                                <h5 class="card-title"><span class="fw-bold" style="max-width: 600px;">Title:</span> <?php echo $item['Title']; ?></h5>
                                <p class="card-text">
                                    <span class="fw-bold">Status:</span> <?php echo $item['Status']; ?><br>
                                    <span class="fw-bold">Author:</span> <?php echo $item['Author_Name']; ?><br>
                                    <span class="fw-bold">Category:</span> <?php
                                                                            $categoryId = $item['Category_Code'];
                                                                            $statement = $conn->prepare("SELECT * FROM `category` WHERE `Category_Code` = $categoryId");
                                                                            $statement->execute();
                                                                            $category = $statement->fetch();
                                                                            echo $category['Category_Name'];
                                                                            ?>
                                </p>
                                <a class="btn border rounded-pill px-5" href="details.php?id=<?php echo $id; ?>">Details</a>

                                <button class="btn btn-primary border rounded-pill px-5 indexReserve" data-bs-toggle="modal" data-bs-target="#exampleModal">Reserve</button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">You have to be a member!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                In order to reserve one of our items you have to be a member, click the button below to sign up.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="signup.php" type="button" class="btn btn-primary">Sign up</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php }; ?>

        </div>

        <!-- ::::::::::::::::::::::::::::::::::: Footer (Copyright, social media icons) ::::::::::::::::::::::::::::::::::: -->

        <?php include "footer.php" ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>

</body>

</html>