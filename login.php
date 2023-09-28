<?php
require 'header.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }
    if (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter.";
    }
    if (!preg_match("/\d/", $password)) {
        $errors[] = "Password must contain at least one number.";
    }
    if (!preg_match("/\W/", $password)) {
        $errors[] = "Password must contain at least one special character.";
    }

    if (empty($errors)) {
        $email_search = "SELECT * FROM `users` where email='$email';";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass = $email_pass['pass'];
            if (password_verify($password, $db_pass)) {
                $_SESSION['name'] = $email_pass['name'];
                $_SESSION['email'] = $email_pass['email'];
?>
                <script>
                    location.replace("home.php");
                </script>
            <?php
            } else {
                $errors[] = "Entered Password is Wrong";
            
            }
        } else {
            $errors[] = "Entered Email is Incorrect";
        }
    }
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
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <section class="wrapper">
                <div class="container">
                    <div class="col-sm-10 offset-sm-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-4">Login</h3>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <?php
                            if (!empty($errors)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    foreach ($errors as $error) {
                                        echo "<p>$error</p>";
                                    }

                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="mt-2 text-end">
                                <a href="forgetpass.php" class="text-primary fw-bold text-decoration-none">Forget Password?</a>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary submit_btn w-100 my-4">Continue</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<?php
require 'footer.php'
?>