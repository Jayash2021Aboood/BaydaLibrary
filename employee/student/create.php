

<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/student.php');
  include_once('../../includes/department.php');
  include_once('../../includes/level.php');
  checkEmployeeSession();


  
  $pageTitle = "Add Student";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addStudent']))
    {


      $name = $_POST['name'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $department_id = $_POST['department_id'];

      $level_id = $_POST['level_id'];

      $state = $_POST['state'];

      $active = ( isset( $_POST['active']))? 1:0;

      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
      if( empty($password)){
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }
      if( empty($department_id)){
        $errors[] = "<li>Department is requierd.</li>";
        $_SESSION["fail"] .= "<li>Department is requierd.</li>";
        }
      if( empty($level_id)){
        $errors[] = "<li>Level is requierd.</li>";
        $_SESSION["fail"] .= "<li>Level is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addStudent(
                                    $name,
                                    $phone,
                                    $email,
                                    $password,
                                    $department_id,
                                    $level_id,
                                    $state,
                                    $active,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Student Added successfuly!";
          $_SESSION["success"] = "Student Added successfuly!";
          header('Location:'. $PATH_ADMIN_STUDENT .'index.php');
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
                            Add Student
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Students List
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
                <!-- Student details card-->
                <div class="card mb-4">
                    <div class="card-header">Student Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="" required  />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value=""   />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value=""   />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                                        value="" required  />
                                </div>
                                <!-- Form Group (department_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="department_id">Department</label>
                                    <select class="form-select" name="department_id" id="department_id" required>
                                        <option selected disabled value="">Select a Department:</option>
                                        <?php foreach(getAllDepartments() as $Department) { ?>
                                        <option value="<?php echo $Department['id']; ?>"> <?php echo $Department['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                                <!-- Form Group (level_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="level_id">Level</label>
                                    <select class="form-select" name="level_id" id="level_id" required>
                                        <option selected disabled value="">Select a Level:</option>
                                        <?php foreach(getAllLevels() as $Level) { ?>
                                        <option value="<?php echo $Level['id']; ?>"> <?php echo $Level['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="" required  />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="active" name="active"
                                        type="checkbox" />
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addStudent" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



