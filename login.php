<?php
  session_start();
  $pageTitle = "Login";

if (isset($_SESSION['user'])) 
  {
    if(isset($_SESSION['userType']))
    {
        if($_SESSION['userType'] == 'a')
        {
            header('Location: admin/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'e')
        {
            header('Location: engineer/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'c')
        {
            header('Location: customer/index.php');
            exit();
        }
    }
    header('Location: index.php');
    exit();
  }
  
  include('includes/lib.php');
  $errors = array();

  $email = "";
  $password = "";
  if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if( !(isset($_POST['email']) && !empty($_POST['email']) )){
        $errors[] = "Email is requierd.";
        //$_SESSION["fail"] = "Email is requierd.";
    }

    if( !(isset($_POST['password']) && !empty($_POST['password']) )){
        $errors[] = "Passowrd is requierd.";
        //$_SESSION["fail"] = "Passowrd is requierd.";
    }
    
    if(count($errors) == 0)
    {
      //$logins = loginAdmin($username, $password);
      $logins = select("select * from webuser where email like '$email';");
      if(count($logins) > 0)
      {
        $userType = $logins[0]['usertype'];
        if($userType == 'a')
        {
            $admins = select("select * from admin where email like '$email' and password like '$password';");
            if(count($admins) > 0)
            {
                $_SESSION["userID"] = $admins[0]['id'];
                $_SESSION["user"] = $email;
                $_SESSION["userType"] = 'a';
                $_SESSION['success'] = "Welcome ".$admins[0]['email'];
                header('Location: admin/index.php');
                exit();
            }
            else
            {
                $_SESSION["message"] = "No Admin found with this data";
                $_SESSION["fail"] = "No Admin found with this data";
                $errors[] = "No Admin found with this data";
            }
        }
        else if($userType == 'e')
        {
            $engineers = select("select * from engineer where email like '$email' and password like '$password';");
            if(count($engineers) > 0)
            {

                if($engineers[0]['state'] == 'reject'){
                    $_SESSION["message"] = "your account has been rejected ... contact to adminstrator";
                    $_SESSION["fail"] = "your account has been rejected ... contact to adminstrator";
                    header('Location: login.php');
                    exit();
                }
                else if($engineers[0]['state'] == 'request'){
                    $_SESSION["message"] = "your account not accepted Yet ... contact to adminstrator";
                    $_SESSION["fail"] = "your account not accepted Yet ... contact to adminstrator";
                    header('Location: login.php');
                    exit();
                }
                else if($engineers[0]['state'] == 'accept')
                {
                    $_SESSION["userID"] = $engineers[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'e';
                    $_SESSION['success'] = "Welcome ".$engineers[0]['first_name'] ." ". $engineers[0]['last_name'] ;
                    header('Location: engineer/index.php');
                }
                else
                {
                    $_SESSION["message"] = "UnKnow engineer state ... contact admininstrator";
                    $_SESSION["fail"] = "UnKnow engineer state ... contact admininstrator";
                    $errors[] = "UnKnow engineer state ... contact admininstrator";
                }
            }
            else
            {
                $_SESSION["message"] = "No Enginner found with this data";
                $_SESSION["fail"] = "No Enginner found with this data";
                $errors[] = "No Enginner found with this data";
            }
        }
        else if($userType == 'c')
        {
            $customers = select("select * from customer where email like '$email' and password like '$password';");
            if(count($customers) > 0)
            {
                    $_SESSION["userID"] = $customers[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'c';
                    $_SESSION['success'] = "Welcome ".$customers[0]['first_name'] ." ". $customers[0]['last_name'] ;
                    header('Location: customer/index.php');
                    exit();
            }
            else
            {
                $_SESSION["message"] = "No Customer found with this data";
                $_SESSION["fail"] = "No Customer found with this data";
                $errors[] = "No Customer found with this data";
            }
        }
        else
        {
            $_SESSION["message"] = "UnKnow user state ... contact admininstrator";
            $_SESSION["fail"] = "UnKnow user state ... contact admininstrator";
            $errors[] = "UnKnow user state ... contact admininstrator";
        }
      }
      else
      {
        $_SESSION["message"] = "Email or password not correct!";
        $_SESSION["fail"] = "Email or password not correct!";
        $errors[] = "Email or password not correct!";
      }
      
    }
    else
    {
        foreach($errors as $error)
        {
            if( !(isset($_SESSION["fail"]) && !empty($_SESSION["fail"]) ))
            {
                $_SESSION["fail"] = $error;
            }
            else
            {
                $_SESSION["fail"] .= "</br>$error";
            }
        }
        //$_SESSION["message"] = "We cant found any acount for this email.";
        // $_SESSION["fail"] = "We cant found any acount for this email.";
        // $errors[] = "We cant found any acount for this email.";
    }

  }

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-10">
                <!-- Basic login form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        <!-- Login form-->
                        <form action="" method="POST">
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter Email " />
                            </div>
                            <!-- Form Group (password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Enter password" />
                            </div>
                            <!-- Form Group (remember password checkbox)-->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox"
                                        value="" />
                                    <label class="form-check-label" for="rememberPasswordCheck">Remember
                                        password</label>
                                </div>
                            </div>
                            <!-- Form Group (login box)-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="auth-password-basic.html">Forgot Password?</a>
                                <button class="btn btn-primary" name="login" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="index.php">Need an account? Sign up!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>