<?php

include "connection.php";
$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brief-16 - Admin</title>
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
                            <a class="nav-link text-white" aria-current="page" href="admin.php?id=<?php echo $id; ?>">Home</a>
                            <a class="nav-link text-white" href="admin.php?id=<?php echo $id; ?>">Contact</a>
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
                            <li><a class="dropdown-item" href="adminProfile.php?id=<?php echo $id; ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="addAdmins.php?id=<?php echo $id; ?>">Add admins</a></li>
                            <li><a class="dropdown-item" href="addItems.php?id=<?php echo $id; ?>">Add an item</a></li>
                            <li><a class="dropdown-item" href="borrowReturn.php?id=<?php echo $id; ?>">Borrowings & Returnings</a></li>
                            <li><a class="dropdown-item" href="reservations.php?id=<?php echo $id; ?>">Reservations</a></li>
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
                        <h1 class="text-white text-wrap mb-4">Discover your favorite books, magazines, novels and more with us!</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="down-arrow" onclick="scrollDown()"></div>

        <!-- ::::::::::::::::::::::::::::::::::: Cards container (Search, Cards, Pagination) ::::::::::::::::::::::::::::::::::: -->

        <div class="container">
            <table class="table border mt-3">

                <thead>
                    <tr>
                        <th>Nickname</th>
                        <th>Item reserved</th>
                        <th>Reservation date</th>
                        <th>Reservation expiration date</th>
                        <th>Mark as borrowed</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $statement = $conn->prepare("SELECT * FROM `reservation`");
                    $statement->execute();
                    $reservations = $statement->fetchAll();

                    foreach ($reservations as $reservation) {

                        echo "<tr>";
                        echo "<td>" . $reservation['Nickname'] . "</td>";
                        echo "<td>";

                        $item_code = $reservation['Item_Code'];
                        $resId = $reservation['Reservation_Code'];

                        $statement = $conn->prepare("SELECT * FROM `item` WHERE `Item_Code` = $item_code");
                        $statement->execute();
                        $item = $statement->fetch();

                        echo $item["Title"] . "</td>";
                        echo "<td>" . $reservation['Reservation_Date'] . "</td>";
                        echo "<td>" . $reservation['Reservation_Expiration_Date'] . "</td>";
                        echo "<td><form method='POST'><input type='hidden' name='resCode' value='$resId'><button class='btn btn-primary' name='borrowed'>Mark as borrowed</button></form></td>";
                        echo "</tr>";
                    }

                    if (isset($_POST["borrowed"])) {

                        $resCode = $_POST["resCode"];

                        $statement = $conn->prepare("SELECT * FROM `reservation` WHERE Reservation_Code = '$resCode'");
                        $statement->execute();
                        $toGetNickname = $statement->fetch(PDO::FETCH_ASSOC);
                        $nickname = $toGetNickname["Nickname"];

                        $borrowDate = date("Y-m-d H:i:s");

                        $statement = $conn->prepare("INSERT INTO `borrowings` (Borrowing_Date, Borrowing_Return_Date, Item_Code, Nickname, Reservation_Code) VALUES ('$borrowDate', NULL, '$item_code', '$nickname', '$resCode')");
                        $statement->execute();

                        $statement = $conn->prepare("DELETE FROM `reservation` WHERE `Reservation_Code` = :resCode");
                        $statement->bindParam(":resCode", $resCode);
                        $statement->execute();

                    }


                    ?>
                </tbody>

            </table>

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