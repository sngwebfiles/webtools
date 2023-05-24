<body data-topbar="dark">
        <div id="layout-wrapper">   
        <?php echo view('partials/topbar'); ?>
            <div class="vertical-menu">

                <div data-simplebar class="h-100">
                    <div class="user-profile text-center mt-3">
                        <div class="">
                            <img src="<?php echo base_url(); ?>assets/images/users/abt.png" alt="" class="avatar-md rounded-circle">
                        </div>
                        <div class="mt-3">
                            <h4 class="font-size-16 mb-1"><?= esc($name) ?></h4>
                            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Web Developer</span>
                        </div>
                    </div>
                    <?php echo view('partials/menuleft'); ?>
                </div>
            </div>

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <?php echo view('partials/breadcrumbs'); ?>
                        <!-- Page Content Start -->
                        <div><?php echo $content; ?></div>
                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>


