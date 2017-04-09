<?php

/* Import DB Configuration */
include "../db/dbconfig.php";

/* Allow for Session Use */
session_start();

/* Possible Error Message */
$error = "";

// Get Post Varibles
$mail = $_POST["mail"];
$pass = $_POST["pass"];

// Connect to Database
$db = connectDB();

/* Handle Login Request if applicable */
if (isset($_POST["login"]) && !empty($_POST["user"]) && !empty($_POST["pass"])) {

    $rawQuery = "
        SELECT username FROM users
        WHERE email=:mail AND password=MD5(:pass)
    ";

    // Run SQL
    $prepQuery = $db->prepare("$rawQuery");
    $prepQuery->bindParam(":mail", $mail, PDO::PARAM_STR);
    $prepQuery->bindParam(":pass", $pass, PDO::PARAM_STR);
    $prepQuery->execute();

    // Get Results
    $result = $prepQuery->fetch();

    // Update Accordingly
    if ($result != FALSE && isset($result["username"])) {
        $_SESSION["user"] = $result["username"];
        /* Redirect */
    } else {
        $error = "Incorrect Username or Password";
    }

} else if (isset($_POST["register"])
    && !empty($_POST["mail"])
    && !empty($_POST["pass"])) {

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    /* Perform Registration */
    $rawQuery = "
        INSERT INTO users
        VALUES (:user, MD5(:pass))
    ";

    // Run SQL
    $prepQuery = $db->prepare("$rawQuery");
    $prepQuery->bindParam(":user", $user, PDO::PARAM_STR);
    $prepQuery->bindParam(":pass", $pass, PDO::PARAM_STR);
    $prepQuery->execute();

    // Redirect
    header("Location: ./soon2.php");
    exit();

}

/* Close the Database Connection */
closeDB($db);

?>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anthony Zheng">

        <title>Log In / Sign Up</title>

        <!-- Font -->
        <link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

        <!-- Core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/style.css" rel="stylesheet">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top"><img src="../img/bonit.png"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="hidden">
                            <a href="../index.html#page-top"></a>
                        </li>
                        <li>
                            <a href="../index.html#about">About</a>
                        </li>
                        <li>
                            <a href="../index.html#services">Services</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../index.html">Home</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- About Section -->
        <section id="about" class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3><span class="red">Log In!</span> Not a pro? <span class="green">Join today and become one!</span></h3>
                        <form action="" method="POST">
                            <div class="row form-group text-left">
                                <div class="col-sm-offset-3 col-sm-6 input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input class="form-control" type="text" name="user" id="user" placeholder="Username" required autofocus>
                                </div>
                            </div>
                            <div class="row form-group text-left">
                                <div class="col-sm-offset-3 col-sm-6 input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                    <input class="form-control" type="password" name="pass" id="pass" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6 input-group">
                                    <button>Sign In</button>
                                    <button>Join In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>Copyright &copy; 2017 The Heapsters</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Framework -->
        <script src="https://unpkg.com/vue@2.1.7/dist/vue.js"></script>

        <!-- Libs -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Main Scripts -->
        <script src="../js/jquery.easing.min.js"></script>
        <script src="../js/scroll.js"></script>
        <script src="../js/app.js"></script>

    </body>

</html>
