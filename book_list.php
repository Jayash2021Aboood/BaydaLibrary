<?php
  session_start();
  include('includes/lib.php');
  include('includes/book.php');
  $pageTitle = lang("Books List");
  ?>

<?php include('template/header.php'); ?>


<?php include('template/startNavbar.php'); ?>

<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Library Books'); ?>
                        </h1>
                    </div>
                    <div class="col-6 mb-3">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input class="form-control" id="search_term" name="search_term" type="text"
                                    placeholder="<?php echo lang('Search in books ...'); ?>"
                                    aria-label="<?php echo lang('Search for ...'); ?>" aria-describedby="button-search">
                                <button class="btn btn-primary" id="button-search" name="button-search"
                                    type="submit"><?php echo lang('Go'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <?php
                if(isset($_GET['search_term']) && !empty($_GET['search_term']))
                    $all = getAllBooksBySearch($_GET['search_term']);
                else
                    $all = getAllBooksBySearch("");
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Books Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
                        // var_dump($row);
                        // exit();
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <a href="book.php?id=<?php echo $row['id'] ?>"><img class="card-img-top"
                            src="<?php echo $PATH_PHOTOES . $row['book_image'] ?? 'book_default.jpg'; ?>"
                            alt="<?php echo $row['book_image'] ?>"></a>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $row['author_name']; ?></div>
                        <h2 class="card-title h4"><?php echo $row['name']; ?></h2>
                        <p class="card-text"><?php echo $row['detail']; ?></p>
                        <p class="card-text"><?php echo displayAvailableCount($row['available_copies_count']); ?></p>
                        <div class="text-end">
                            <a class="btn btn-success btn-sm"
                                href="<?php echo $PATH_PHOTOES . $row['book_file'] ; ?>"><?php echo lang('Download'); ?>
                            </a>
                            <a class="btn btn-primary btn-sm"
                                href="book.php?id=<?php echo $row['id'] ?>"><?php echo lang('Read more'); ?> →</a>
                            <?php if ( isset($row['book_file']) && !empty($row['book_file'])) { ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                            alt="..."></a>
                    <div class="card-body">
                        <div class="small text-muted">January 1, 2023</div>
                        <h2 class="card-title">Featured Post Title</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                            aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi
                            vero voluptate voluptatibus possimus, veniam magni quis!</p>
                        <a class="btn btn-primary" href="#!">Read more →</a>
                    </div>
                </div>
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0">
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>
<!-- محتوى الصفحة -->
<main class="page">

    <header class="py-10 mb-0 ">
        <div class="container-xl px-4 text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary">Our Books</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0">
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <?php

                $all = getAllBooksWithDetails();
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Book Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
                ?>

            <?php
                $total_book = $row['total_book'];
                // $author_name = $row['author_name'];
            ?>

            <div class="col-lg-4 mb-4">
                <!-- Knowledge base category card 5-->
                <a class="card card-progress lift lift-sm border-start-lg border-start-secondary"
                    href="book.php?id=<?php echo $row['id'] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">
                            <i class="me-2" data-feather="user"></i>
                            <?php echo $row['name'].' '; ?>
                        </h5>
                        <p class="card-text">Number of copies : <?php echo $row['number_copies']; ?></p>
                        <p class="card-text">Author name: <?php echo $row['author_id']; ?></p>
                    </div>
                    <div class="card-text">
                    </div>
                    <div class="card-footer">
                        <div class="small text-muted"><?php echo $total_book; ?> Books</div>

                    </div>
                    <!-- 
                    <div class="progress rounded-0">
                        <div class="progress-bar bg-<?php echo getRateColor($total_rate); ?>" role="progressbar"
                            style="width: <?php echo $total_rate ?>%" aria-valuenow="<?php echo $total_rate ?>"
                            aria-valuemin="0" aria-valuemax="100"><?php echo floor($total_rate) ?>%</div>
                    </div> -->
                </a>
            </div>
            <?php }}?>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>