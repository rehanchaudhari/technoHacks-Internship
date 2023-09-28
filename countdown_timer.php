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
                            <a class="nav-link" href="home.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="converter">
                <div class="container-fluid banner">
                    <section class="wrapper">
                        <div class="container">
                            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                               
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3 class="text-dark fw-bolder fs-4 mb-2">Countdown Timer</h3>
                                    </div>
                                    <div class="card-body">

                                        <button id="start" class="btn btn-success submit_btn my-4">Start</button>
                                        <button id="stop" class="btn btn-danger submit_btn my-4">Stop</button>
                                        <button id="reset" class="btn btn-warning submit_btn my-4">Reset</button>
                                        <button id="restart" class="btn btn-dark submit_btn my-4">Restart</button>

                                    </div>
                                    <div class="card-footer text-muted">

                                        <div id="timer">00:00:00</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-center fw-bold mb-4">

                                            <label for="datetime">Enter Date and Time:</label>
                                            <input type="datetime-local" class="form-control" id="datetime" required>
                                        </div>
                                        <button id="start1" class="btn btn-primary submit_btn my-4">Start Countdown</button>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <div id="timer1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <script src="js/ct.js"></script>
</body>

<?php
require 'footer.php';
?>