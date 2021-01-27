<nav class="headnav navbar navbar-light bg-sunshine py-4">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $root ?>index.php">
            <img src="<?php echo $root ?>assets/img/logo.png" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            MY V BIKE RENTAL
        </a>
        <div class="user-menu">
            <a href="<?php echo $root ?>account/login.php"><i class="fas fa-user-circle"></i></a>
            <a href="#search-modal" data-toggle="modal"><i class="fas fa-search"></i></a>
            <a onclick="menu();return false;" href="#"><i class="fas fa-bars"></i></a>
        </div>
    </div>
</nav>
<nav class="topnav navbar navbar-expand-lg navbar-light bg-sunshine d-none">
    <div></div>
    <div class="mx-auto order-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav text-center">
                <a class="nav-link <?php if ($nav == 'rent') {
                                        echo 'active';
                                    } ?>" href="rent">Rent</a>
                <a class="nav-link <?php if ($nav == 'contact') {
                                        echo 'active';
                                    } ?>" href="<?php echo $root ?>contact.php">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
<div class="modal fade" id="search-modal" tabindex="-1" aria-labelledby="search-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="<?php echo $root ?>rent">
                    <div class="form-group row m-3">
                        <input type="text" class="form-control" name="search" placeholder="Search">
                    </div>
                    <div class="text-center mt-5 mb-3 mx-3">
                        <input type="submit" class="btn btn-warning" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>