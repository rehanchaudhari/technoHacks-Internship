<?php
require 'header.php';

if(!isset($_SESSION['name'])){
	header('location:index.php');
}

if(isset($_POST['submit'])){
  $errors = [];
  $d1 = $_POST['d1'];
  $d2 = $_POST['d2'];
  $d3 = $_POST['d3'];
  $d4 = $_POST['d4'];
  $d5 = $_POST['d5'];
  $d6 = $_POST['d6'];

  $op_check = "$d1$d2$d3$d4$d5$d6";

  if($op_check==$_SESSION['otp']){
    header("location:newpass.php");
  }
  else{
    $errors[] = "Wrong OTP!!!!!!!!!";
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
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-2">Otp Verification</h3>
                            <div class="fw-normal text-muted mb-4">
                                Enter the Verification code we sent to
                            </div>

                            <div class="d-flex align-items-center justify-content-center fw-bold mb-4">                           
                                  <span><?php echo $_SESSION['email'];   ?>
                            </div>

                            <div class="otp_input text-start mb-2">
                                <label for="digit">Type your 6 digit security code</label>
                                <div class="d-flex align-items-center justify-content-betweeen mt-2">
                                    <input type="text" name="d1" maxlength="1" id="d1" class="form-control" placeholder="" onkeyup="move(event, '', 'd1', 'd2')">
                                    <input type="text" name="d2" maxlength="1" id="d2" class="form-control" placeholder="" onkeyup="move(event, 'd1', 'd2', 'd3')">
                                    <input type="text" name="d3" maxlength="1" id="d3" class="form-control" placeholder="" onkeyup="move(event, 'd2', 'd3', 'd4')">
                                    <input type="text" name="d4" maxlength="1" id="d4" class="form-control" placeholder="" onkeyup="move(event, 'd3', 'd4', 'd5')">
                                    <input type="text" name="d5" maxlength="1" id="d5" class="form-control" placeholder="" onkeyup="move(event, 'd4', 'd5', 'd6')">
                                    <input type="text" name="d6" maxlength="1" id="d6" class="form-control" placeholder="" onkeyup="move(event, 'd5', 'd6', '')">
                                </div>
                                
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
                              
                              <div class="fw-normal text-muted mb-2">
                                Did't want to change ? <a href="cancel.php" class="text-primary fw-bold text-decoration-none">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>

  <script>
    function move(e, p, c, n){
      var length = document.getElementById(c).value.length;
      var maxlength = document.getElementById(c).getAttribute("maxlength");
      if(length == maxlength && n!== ""){
        document.getElementById(n).focus();
      }
      if(e.key === "Backspace" && p!== ""){
        document.getElementById(p).focus();
      }
    }
  </script>
</body>
<?php
require 'footer.php';
?>