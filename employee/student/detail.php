
<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/student.php');
  include_once('../../includes/department.php');
  include_once('../../includes/level.php');

  checkAdminSession();

  $pageTitle = "Detail Student";
  $row = new Student(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getStudentById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = 'There is No data for this id';
          $_SESSION["fail"] = 'There is No data for this id';
      }

    }
    else
    {
      $_SESSION["message"] = 'No data for display';
      $_SESSION["fail"] = 'No data for display';
    }

  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['deleteStudent']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteStudent($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Student Detaild successfuly!";          
          $_SESSION["success"] = "Student Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_STUDENT .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Detail Data";
          $_SESSION["fail"] = "Error when Detail Data";

          $errors[] = "Error when Detail Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Detail';
        $_SESSION["fail"] = 'No data for Detail';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Detail';
      $_SESSION["fail"] = 'No data for Detail';
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
                            Detail Student
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
                    <div class="card-header">Student Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="<?php echo $row['name'];?>" readonly />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="<?php echo $row['phone'];?>" readonly />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $row['email'];?>" readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                                        value="<?php echo $row['password'];?>" readonly />
                                </div>
                                <!-- Form Group (department_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="department_id">Department</label>
                                    <select disabled class="form-select" name="department_id" id="department_id" required>
                                        <option disabled value="">Select a Department:</option>
                                        <?php foreach(getAllDepartments() as $Department) { ?>
                                        <option <?php if($row['department_id'] == $Department['id']) echo "selected" ?> value="<?php echo $Department['id']; ?>"> <?php echo $Department['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (level_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="level_id">Level</label>
                                    <select disabled class="form-select" name="level_id" id="level_id" required>
                                        <option disabled value="">Select a Level:</option>
                                        <?php foreach(getAllLevels() as $Level) { ?>
                                        <option <?php if($row['level_id'] == $Level['id']) echo "selected" ?> value="<?php echo $Level['id']; ?>"> <?php echo $Level['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="active" name="active"
                                        type="checkbox" disabled
                                        <?php if($row['active'] == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button">Edit</a>
                            <a href="index.php" class="btn btn-primary" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
