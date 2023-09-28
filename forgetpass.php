<?php
require 'header.php';
include 'mail.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $errors = [];
    $email_search = "SELECT * FROM `users` where email='$email';";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['pass'];
        
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['email'] = $email_pass['email'];
        

        $otp = rand(100000,999999);

        $_SESSION['otp'] = $otp;

        sendMail($email, $otp);

        
    }
    else{
        $errors[] = "Entered Email is Incorrect";
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
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-2">Forget Password?</h3>
                            <div class="fw-normal text-muted mb-4">
                                Enter your email to reset your password.
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
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
                              <button type="submit" name="submit" class="btn btn-primary submit_btn my-4">Submit</button>
                              <a href="login.php"><button type="button" class="btn btn-secondary submit_btn my-4 ms-3">Cancel</button></a>
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>
</body>
<?php
require 'footer.php';
?>