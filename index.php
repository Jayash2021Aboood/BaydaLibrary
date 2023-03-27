<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "Home";

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main>
    <header class="d-none d-md-block py-10  mb-4 bg-img-cover overlay overlay-60"
        style="background-image: url('assets/img/demo/demo-ocean-lg.jpg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;">
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
                <h1 class="text-white">Welcome to Engineer Services Provider</h1>
                <p class="lead mb-0 text-white-50">A passion to deliver the best
                </p>
            </div>
        </div>
    </header>

    <header class=" d-block d-md-none py-10  mb-4  overlay overlay-60"
        style="background-image: url('assets/img/demo/demo-ocean-lg.jpg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;">
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
                <h1 class="text-white">Welcome to Engineer Services Provider</h1>
                <p class="lead mb-0 text-white-50">A passion to deliver the best
                </p>
            </div>
        </div>
    </header>
    <!-- Main page content-->

    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <!-- Create Organization-->
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                <div class="card text-center h-100">
                    <div class="card-body px-5 pt-5 d-flex flex-column">
                        <div>
                            <div class="h3 text-primary">Create</div>
                            <p class="text-muted mb-4">Create an customer account to enjoy by provided
                                service</p>
                        </div>
                        <div class="icons-org-create align-items-center mx-auto mt-auto">
                            <i class="icon-users" data-feather="users"></i>
                            <i class="icon-plus fas fa-plus"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent px-5 py-4">
                        <div class="small text-center"><a class="btn btn-block btn-primary"
                                href="customerSignin.php">Create new customer account</a></div>
                    </div>
                </div>
            </div>
            <!-- Join Organization-->
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                <div class="card text-center h-100">
                    <div class="card-body px-5 pt-5 d-flex flex-column align-items-between">
                        <div>
                            <div class="h3 text-secondary">Join</div>
                            <p class="text-muted mb-4">Join to us as engineer to provide your servic to
                                community</p>
                        </div>
                        <div class="icons-org-join align-items-center mx-auto">
                            <i class="icon-user" data-feather="user"></i>
                            <i class="icon-arrow fas fa-long-arrow-alt-right"></i>
                            <i class="icon-users" data-feather="users"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent px-5 py-4">
                        <div class="small text-center"><a class="btn btn-block btn-secondary"
                                href="engineerSignin.php">Join as engineer</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include('template/footer.php') ?>