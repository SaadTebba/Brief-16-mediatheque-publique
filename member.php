<?php

include "connection.php";
$id = $_GET['id'];

$statement = $conn->prepare("DELETE FROM `reservation` WHERE `Reservation_Expiration_Date` < NOW()");
$statement->execute();

$statement = $conn->prepare("DELETE FROM `borrowings` WHERE `Reservation_Code` IN (SELECT `Reservation_Code` FROM `reservation` WHERE `Reservation_Expiration_Date` < NOW())");
$statement->execute();

?>

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

        <header class="fixed-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <img src="images/logo.png" class="d-inline-block align-top mx-3 logo" alt="logo">
                    <a class="navbar-brand text-white">Solibrary</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link text-white" aria-current="page" href="member.php?id=<?php echo $id; ?>">Home</a>
                            <a class="nav-link text-white" href="member.php?id=<?php echo $id; ?>">Contact</a>
                            <a class="nav-link text-white" href="aboutMembers.php?id=<?php echo $id; ?>">About</a>
                            <a class="nav-link text-white explore" onclick="scrollDown()">Explore</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon text-white"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Profile dropdown -->

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle bg-transparent border-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php

                            $statement = $conn->prepare("SELECT * FROM `members` WHERE id = $id");
                            $statement->execute();
                            $memberDetails = $statement->fetch();

                            echo $memberDetails['Nickname'];

                            ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="memberProfile.php?id=<?php echo $id; ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="myReservations.php?id=<?php echo $id; ?>">My Reservations</a></li>
                            <li><a class="dropdown-item" href="index.php">Log out</a></li>
                        </ul>
                    </div>

                </div>
            </nav>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>
                </ul>
            </div>
        </header>

        <div id="backgroundImg" class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <h1 class="text-white text-wrap mb-4" onclick="testiWsf()">Discover your favorite books, magazines, novels and more with us!</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="down-arrow" onclick="scrollDown()"></div>

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

                <div class="card d-inline-block mb-5 mx-2">
                    <div class="row">
                        <div class="col-md-4 images-container">
                            <img src="<?php echo $item['Cover_Image']; ?>" class="img-fluid rounded-start" alt="Card image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-start" <?php $id = $item['Item_Code']; ?>>
                                <form method="POST">
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
                                    <input type="hidden" name="item_id" value="<?php echo $id ?>">
                                    <button class="btn btn-primary border rounded-pill px-5" id="reserve" name="reserve">Reserve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            };

            if (isset($_POST["reserve"])) {

                if ($item['Status'] == 'Available') {

                    $ResDate = date("Y-m-d H:i:s");
                    $ResExpDate = date("Y-m-d H:i:s", strtotime("+1 days"));

                    $nickname = $memberDetails['Nickname'];
                    $item_id = $_POST['item_id'];

                    $statement = $conn->prepare("INSERT INTO `reservation` (Reservation_Date, Reservation_Expiration_Date, Item_Code, Nickname) VALUES (?, ?, ?, ?)");
                    $statement->execute([$ResDate, $ResExpDate, $item_id, $nickname]);
                } else { ?>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Item Not Available</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Sorry, the item you selected is not available at the moment. Please try again later.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script> $(document).ready(function() { $('#myModal').modal('show'); }); </script>

            <?php }
            }

            ?>

        </div>

        <!-- ::::::::::::::::::::::::::::::::::: Footer (Copyright, social media icons) ::::::::::::::::::::::::::::::::::: -->

        <?php include "footer.php" ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>

</html>