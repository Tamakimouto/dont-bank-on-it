<?php

/* Allow Session Use */
session_start();

?>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anthony Zheng">

        <title>Don't Bank on It!</title>

        <!-- Font -->
        <link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

        <!-- Core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/style.css" rel="stylesheet">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <div id="app">

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
                        </ul>
                        <input class="find" type="text" v-model="bankQry" placeholder="Search for Banks by Name or Zip">
                        <button class="qry-enter" @click="search">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="../index.html"><span class="glyphicon glyphicon-home"></span> Home (logout)</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>

            <!-- Search Area - Reuse About Section -->
            <section id="about" class="about-section" v-if="page == 1">
                <div class="container">
                    <div class="row searchExplain" v-if="searchRes.length == 0">
                        <h1>Welcome <?php echo $_SESSION["user"]; ?>!</h1>
                        <p>
                            Getting started with <span class="red">!</span><span class="green">BONIT</span>
                            is easy, just type in a bank name or zip code (or both) above to locate your bank.
                        </p>
                        <p class="red animated fadeIn searchErr" v-if="searchNum">Oops! We couldn't find what you were looking for.</p>
                    </div>
                    <div class="row searchExplain" v-if="searchRes.length != 0">
                        <p>Great! We found you {{ searchRes.length }} result(s).</p>
                    </div>
                    <div class="row searchResult" v-for="branch in shownBranches">
                        <div class="col-sm-offset-1 col-sm-10 animated fadeIn text-left">
                            <h2 class="resTitle" @click="loadBranch(branch)">
                                <span class="green"> {{ branch.name }} </span> - <span class="red"> FDIC# {{ branch.id }} </span>
                            </h2>
                            <p>
                                {{ branch.address }} <br>
                                {{ branch.city }}, {{ branch.state }} {{ branch.zip }}
                            </p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="showMore" @click="shown += 10" v-if="shown < searchRes.length">
                            Show More
                        </button>
                    </div>
                </div>
            </section>

            <!-- Branch Page - Reuse About Section -->
            <section id="about" class="about-section" v-if="page == 2">
                <div class="container">
                    <div class="row text-center">
                        <h2 class="green"> {{ selectedBranch.name }} </h2>
                        <p class="red">
                            {{ selectedBranch.address }};
                            {{ selectedBranch.city }}, {{ selectedBranch.state }} {{ selectedBranch.zip }}
                        </p>
                        <p>
                            Branch Identification Number: {{ selectedBranch.bId }} <br>
                            Company FDIC Number: {{ selectedBranch.id }}
                        </p>
                        <h3>Complaints about this bank in the area</h3>
                        <p v-for="complaint in complaints"> {{ complaint.complaint_what_happened }} </p>
                    </div>
                </div>
            </section>

        </div> <!-- APP END -->

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
