<?php

require 'header.php';

if(!isset($_SESSION['name'])){
	header('location:index.php');
}

if(isset($_POST['submit'])){
    $new_pass = $_POST['np'];
    $confirm_pass = $_POST['cnp'];
    $errors = [];
    if (strlen($new_pass) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match("/[A-Z]/", $new_pass)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }
    if (!preg_match("/[a-z]/", $new_pass)) {
        $errors[] = "Password must contain at least one lowercase letter.";
    }
    if (!preg_match("/\d/", $new_pass)) {
        $errors[] = "Password must contain at least one number.";
    }
    if (!preg_match("/\W/", $new_pass)) {
        $errors[] = "Password must contain at least one special character.";
    }
    if (empty($errors)) {
    if($new_pass==$confirm_pass){
        $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
        $pass_update = "UPDATE `users` SET `pass`='$new_pass' where email='".$_SESSION['email']."';";
        $query = mysqli_query($con,$pass_update);
        header("location:logout.php");
        }
    else{
        $errors[] = "Confirm Password is Wrong!!!!!!!!!";
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
				</nav>
			</div>
			<section class="wrapper">
                <div class="container">
                    <div class="col-sm-10 offset-sm-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-2">Setup New Password</h3>
                            <div class="fw-normal text-muted mb-4">
                                Already have reset your password ? <a href="cancel.php" class="text-primary fw-bold text-decoration-none">LogIn</a>
                            </div>
                              <div class="form-floating mb-4">
                                <input name="np" type="password" class="form-control" id="floatingPassword" placeholder="Password">
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
                              <div class="form-floating mb-3">
                                <input name="cnp" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Confirm Password</label>
                              </div>
                              <button name="submit" type="submit" class="btn btn-primary submit_btn my-4">Submit</button>
                              
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