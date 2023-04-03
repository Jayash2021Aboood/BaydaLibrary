<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/author.php');
  checkEmployeeSession();

  $pageTitle = "Edit Author";
  //$row = new Author(null);
   $id =  $name =  $phone =  $email =  $address =  $nationality = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getAuthorById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];
        $nationality = $row['nationality'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
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
    if(isset($_POST['updateAuthor']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $nationality = $_POST['nationality'];
      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getAuthorById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateAuthor( $id,  $name,  $phone,  $email,  $address,  $nationality, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Author Updated successfuly!";
          $_SESSION["success"] = "Author Updated successfuly!";
          header('Location:'. $PATH_ADMIN_AUTHOR .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Update Data";
          $_SESSION["fail"] = "Error when Update Data";
          $errors[] = "Error when Update Data";
        }
        
      }
      else
      {
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            Edit Author
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Authors List
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
                <!-- Author details card-->
                <div class="card mb-4">
                    <div class="card-header">Author Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="<?php echo $phone;?>" />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $email;?>" />
                                </div>
                                <!-- Form Group (address)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="address">Address</label>
                                    <input class="form-control" id="address" name="address" type="text"
                                        placeholder="Address" value="<?php echo $address;?>" />
                                </div>
                                <!-- Form Group (nationality)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="nationality">Nationality</label>
                                    <input class="form-control" id="nationality" name="nationality" type="text"
                                        placeholder="Nationality" value="<?php echo $nationality;?>" />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateAuthor" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>