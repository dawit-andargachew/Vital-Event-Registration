<?php
session_start();

$ssn =$_SESSION["ssn"] ??null;


// // connect to datebase
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=vital_registration_database', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// qouery the databse
$statement = $pdo->prepare('SELECT * FROM death_table WHERE  p_ssn = :ssn');
$statement->bindValue(':ssn', $ssn);
$statement->execute();
$death_info = $statement->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Death registration page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Montserrat&family=Open+Sans:wght@700&family=Poppins:wght@500&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="./style/style.css">
</head>

<body>

    <!-- common  -->
    <!-- <div class="img-div">
<img class="img" src="images/logo.png" alt="logo-image">
    </div> -->


    <div>
        <header>
            <div id="company-name">
                <a href="index.php">
                    <h1 id="vital-events">Vital Events Registration</h1>
                </a>
            </div>
            <nav>
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a> <!-- kale -->
                <a href="#to-footer">Contact Us</a>

                <!-- log in or logout -->
                <?php if (isset($_SESSION['ssn'])) {?>
                <a id="nav-login"  href="choice.php"> <?php echo $_SESSION['name'] ?> </a>
                <!-- <a href="./tools/logout.php"> Logout</a> -->
                <?php } else {?>
                <a id="nav-login" href="_login.php"> LogIn</a>
                <?php }?>
            </nav>



        </header>

        <!-- <div id="intro">
            <div class="moto">
                <p>Welcome to</p>
                <h1>Vital Events Registration</h1>
                <p>Document your life events anytime, anywhere!</p>
            </div>
        </div> -->

    </div>

    <!-- common nav bar end -->
    <!-- common nav bar end -->

    <!--  the death is displayed here -->
    <?php if (isset($_SESSION['ssn'])) {?>

    <div>
        <a class="add-add" href="A_add-death.php">Add Death</a>
    </div>
    <div class="person-container">

        <!--! info begins here -->
        <?php if (empty($death_info)): ?>

        <div class="no-personal-info">
            Death information is not provided yet.
        </div>
        <?php endif; ?>
        <?php foreach ($death_info as $i => $element) {?>
        <div class="person-info">
            <div class="p-image">
                <img src="<?php echo $element['image']?>" alt="here is image" />
            </div>

            <div class="p-ssn">
                <p>SSN : <?php echo $element['d_ssn'] ?> </p>
            </div>

            <div class="p-name">
                <div>
                    <p>Name : <?php echo $element['name'] ?></p>
                    <p>Father Name : <?php echo $element['f_name'] ?></p>
                    <p>Grand F.Name : <?php echo $element['g_name'] ?></p>
                </div>
                <div>
                    <p>Birth Date : <?php echo $element['birth_date'] ?> </p>
                    <p>Birth Place : <?php echo $element['birth_place'] ?></p>
                    <p>Sex : <?php echo $element['sex'] ?></p>
                </div>
            </div>

            <div class="p-actions">

                <!-- for update -->
                <form action="B_edit-death.php">
                    <input type="hidden" name="edit" value="<?php echo $element['d_ssn']?>" />
                    <button class="edit" type="submit">Edit</button>
                </form>

                <!-- for delete -->
                <form method="post" action="C_delete-death.php">
                    <input type="hidden" name="delete" value="<?php echo $element['d_ssn']?>" />
                    <button class="delete" type="submit">Delete</button>
                </form>

            </div>
        </div>
        <?php }?>

        <!--! display ends here -->

    </div>

    <?php } else {?>

    <div class="please-login">

        <p> Please log in first </p>
        <a id="please-link" href="_login.php"> Go to log in page</a>
    </div>

    <?php }?>




    <!--  for footer -->
    <!-- footer for all pages -->
    <div id="to-footer" class="footer">
        <h3>Vital Events Registration Agency</h3>
        <div class="footer-links">
            <a href="#">Site Map</a>
            <a href="#">Copyright</a>
            <a href="#">Privacy</a>
            <a href="#">Disclaimer</a>
            <a href="#">Accessibility</a>
        </div>
        <div class="soc-media-icons">
            <a href="https://www.facebook.com/Addis-Ababa-University-496255483792611/?ref=br_tf">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a>
            <a href="https://www.facebook.com/Addis-Ababa-University-496255483792611/?ref=br_tf">
                <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="https://www.facebook.com/Addis-Ababa-University-496255483792611/?ref=br_tf">
                <ion-icon name="logo-twitter"></ion-icon>
            </a>
        </div>
        <p>Copyright &copy; 2022 Events Registration Agency</p>
    </div>





    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>