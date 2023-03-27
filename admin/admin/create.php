

<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/admin.php');
  checkAdminSession();


  
  $pageTitle = "Add Admin";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addAdmin']))
    {


      $email = $_POST['email'];

      $password = $_POST['password'];

      if( empty($email)){
        $errors[] = "<li>Email is requierd.</li>";
        $_SESSION["fail"] .= "<li>Email is requierd.</li>";
        }
      if( empty($password)){
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addAdmin(
                                    $email,
                                    $password,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Admin Added successfuly!";
          $_SESSION["success"] = "Admin Added successfuly!";
          header('Location:'. $PATH_ADMIN_ADMIN .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Adding Data";
          $_SESSION["fail"] = "Error when Adding Data";
          $errors[] = "Error when Adding Data";
        }
        
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>



<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            Add Admin
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Admins List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Admin details card-->
                <div class="card mb-4">
                    <div class="card-header">Admin Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="" required  />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addAdmin" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



