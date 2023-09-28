<?php

require 'header.php';

if (!isset($_SESSION['name'])) {
    header('location:login.php');
}
?>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-md">
                    <div class="navbar-brand">TechnoHacks Internship</div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center align-items-center">
                <br><br><br>
                <h1>Hiiiii, <?php echo $_SESSION['name']; ?>🌙</h1>
                <hr>
                <a href="currency_exchange.php"><button type="button" class="btn btn-light btn-lg p-4 my-4 ms-4">
                        <p>
                            Task 2
                        </p>
                        <p>
                            Currency Exchange
                        </p>
                    </button>
                </a>
                <a href="countdown_timer.php"><button type="button" class="btn btn-light btn-lg p-4 my-4 ms-4">
                        <p>
                            Task 3
                        </p>
                        <p>
                        Countdown Timer
                        </p>
                    </button>
                </a>
            </div>


        </div>
    </div>

</body>
<?php
require 'footer.php';
?>