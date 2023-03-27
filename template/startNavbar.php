    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
        id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
                data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <?php 
            $mainPage = $PATH_SERVER;
            if(isAdmin())
                $mainPage = $PATH_ADMIN;
            if(isEngineer())
                $mainPage = $PATH_ENGINEER;
            if(isCustomer())
                $mainPage = $PATH_CUSTOMER;
         ?>
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php echo $mainPage; ?>">Bayda Library</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- Documentation Dropdown-->

            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the lg breakpoint-->
            <li class="nav-item dropdown no-caret me-3 d-lg-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline me-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2" />
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </form>
                </div>
            </li>

            <?php if(isLogin()){ ?>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><img class="img-fluid"
                        src="<?php echo $PATH_SERVER ?>assets/img/illustrations/profiles/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img"
                            src="<?php echo $PATH_SERVER ?>assets/img/illustrations/profiles/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">Valerie Luna</div>
                            <div class="dropdown-user-details-email">
                                <a href="/cdn-cgi/l/email-protection"><?php echo getLoginEmail();?>
                                </a>
                            </div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo $mainPage; ?>profile.php">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <?php if(isEngineer()){ ?>
                    <a class="dropdown-item" href="<?php echo $PATH_ENGINEER; ?>my_bookings.php">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        My Bookings
                    </a>
                    <?php } ?>

                    <?php if(isCustomer()){ ?>
                    <a class="dropdown-item" href="<?php echo $PATH_CUSTOMER; ?>my_bookings.php">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        My Bookings
                    </a>
                    <?php } ?>

                    <a class="dropdown-item" href="<?php echo $PATH_SERVER; ?>logout.php">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>

            <?php }?>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">

                        <?php if(isLogin()){ ?>


                        <!-- ============================================================  -->
                        <!-- ==============   Admin Pages Link      ==================  -->
                        <!-- ============================================================  -->
                        <?php if(isAdmin()){ ?>
                        <!-- Sidenav Menu Heading (Account)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <div class="sidenav-menu-heading d-sm-none">Account</div> -->
                        <!-- Sidenav Link (Alerts)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="bell"></i></div>
                            Alerts
                            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                        </a> -->
                        <!-- Sidenav Link (Messages)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            Messages
                            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                        </a> -->
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading">Control Panel</div>

                        <!-- Sidenav Accordion (Dashboard)-->
                        <!-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#collapseDashboards" aria-expanded="false"
                            aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="dashboard-1.html">
                                    Default
                                    <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
                                </a>
                                <a class="nav-link" href="dashboard-2.html">Multipurpose</a>
                                <a class="nav-link" href="dashboard-3.html">Affiliate</a>
                            </nav>
                        </div> -->

                        <a class="nav-link" href="<?php echo $PATH_ADMIN; ?>">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            Home
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_ADMIN; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Admin
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_AUTHOR; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Author
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_BOOK; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Book
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_COLLEGE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            College
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_DEPARTMENT; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Department
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_EMPLOYEE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Employee
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_ISSUE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Issue
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_LANGUAGE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Language
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_LEVEL; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Level
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_LIBRARY; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Library
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_PUBLISHER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Publisher
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_SECTION; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Section
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_SETTING; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Setting
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_STUDENT; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Student
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_BOOKING; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            Booking
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_RATING; ?>">
                            <div class="nav-link-icon"><i class="fa fa-star" aria-hidden="true"></i></div>
                            Rating
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_CUSTOMER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                            Customer
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_ENGINEER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-helmet-safety"></i> </div>
                            Engineer
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_SERVICE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                            Service
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_SERVICE_TYPE; ?>">
                            <div class="nav-link-icon"> <i class="fa fa-list"></i></div>
                            Service Type
                        </a>

                        <!-- ============================================================  -->
                        <!-- ==============   Engineer Pages Link      ==================  -->
                        <!-- ============================================================  -->

                        <?php }else if(isEngineer()){ ?>

                        <div class="sidenav-menu-heading">Control Panel</div>
                        <a class="nav-link" href="<?php echo $PATH_ENGINEER; ?>">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            Home
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ENGINEER_SERVICE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                            Service
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ENGINEER; ?>my_bookings.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            My Booking
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>faq.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-question"></i></div>
                            FAQ
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>about_us.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
                            About Us
                        </a>

                        <!-- ============================================================  -->
                        <!-- ==============   Customer Pages Link      ==================  -->
                        <!-- ============================================================  -->

                        <?php }else if(isCustomer()){ ?>
                        <!-- Sidenav Menu Heading (Account)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <div class="sidenav-menu-heading d-sm-none">Account</div> -->
                        <!-- Sidenav Link (Alerts)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="bell"></i></div>
                            Alerts
                            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                        </a> -->
                        <!-- Sidenav Link (Messages)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            Messages
                            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                        </a> -->
                        <div class="sidenav-menu-heading">Control Panel</div>

                        <a class="nav-link" href="<?php echo $PATH_CUSTOMER;?>index.php">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            Home
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>service_type.php">
                            <div class="nav-link-icon"> <i class="fa fa-list"></i>
                            </div>
                            Categories
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>service_list.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                            Services
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>engineer_list.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-helmet-safety"></i> </div>
                            Engineer
                        </a>
                        <a class="nav-link" href="<?php echo $mainPage; ?>my_bookings.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            My Booking
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>faq.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-question"></i></div>
                            FAQ
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>about_us.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
                            About Us
                        </a>

                        <?php } ?>




                        <!-- ============================================================  -->
                        <!-- ==============   Visitor Pages Link      ==================  -->
                        <!-- ============================================================  -->
                        <?php }else{ ?>
                        <div class="sidenav-menu-heading">Fast Access</div>

                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>index.php">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            Home
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>service_type.php">
                            <div class="nav-link-icon"> <i class="fa fa-list"></i>
                            </div>
                            Categories
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>service_list.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                            Services
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER;?>engineer_list.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-helmet-safety"></i> </div>
                            Engineer
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>faq.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-question"></i></div>
                            FAQ
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>about_us.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
                            About Us
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>login.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                            Login
                        </a>
                        <?php } ?>




                    </div>
                </div>
                <?php
                    if(isLogin())
                    {
                ?>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?php echo $_SESSION['user']; ?></div>
                    </div>
                </div>
                <?php } ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <!--  ======== Statrt Content ============ -->
            <?php if ( isset($_SESSION['success']) ){ ?>
            <div class="alert alert-success alert-dismissible fade show" id="successmessage" role="alert">
                <strong><?php echo $_SESSION['success'];  $_SESSION['success'] = null; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>

            <?php if ( isset($_SESSION['fail']) ){ ?>
            <div class="alert alert-danger alert-dismissible fade show" id="failmessage" role="alert">
                <strong><?php echo $_SESSION['fail'];  $_SESSION['fail'] = null; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>