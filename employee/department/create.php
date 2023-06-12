

<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/department.php');
  include_once('../../includes/college.php');
  checkEmployeeSession();


  
  $pageTitle = "Add Department";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addDepartment']))
    {


      $college_id = $_POST['college_id'];

      $name = $_POST['name'];

      if( empty($college_id)){
        $errors[] = "<li>College is requierd.</li>";
        $_SESSION["fail"] .= "<li>College is requierd.</li>";
        }
      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addDepartment(
                                    $college_id,
                                    $name,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Department Added successfuly!";
          $_SESSION["success"] = "Department Added successfuly!";
          header('Location:'. $PATH_ADMIN_DEPARTMENT .'index.php');
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
                            Add Department
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Departments List
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
                <!-- Department details card-->
                <div class="card mb-4">
                    <div class="card-header">Department Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (college_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="college_id">College</label>
                                    <select class="form-select" name="college_id" id="college_id" required>
                                        <option selected disabled value="">Select a College:</option>
                                        <?php foreach(getAllColleges() as $College) { ?>
                                        <option value="<?php echo $College['id']; ?>"> <?php echo $College['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addDepartment" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>


