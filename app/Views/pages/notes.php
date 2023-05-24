<body data-topbar="dark">
        <div id="layout-wrapper">   
        <?php echo view('partials/topbar'); ?>
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <?php echo view('partials/userpic'); ?>
                    <?php echo view('partials/menuleft'); ?>
                </div>
            </div>

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <?php echo view('partials/breadcrumbs'); ?>
                        <!-- Page Content Start -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">My Notes</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Shared to me</span>    
                                </a>
                            </li>
                        </ul>
                                 
                        <div class="tab-content p-3_ text-muted">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <?php echo view('contents/mynotes'); ?>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <?php echo view('contents/sharednotes'); ?>
                            </div>
                        </div>
                        <div class="button-items" style="margin-bottom:10px;">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                <i class="ri-file-add-line align-middle mr-1"></i>Add New Notes
                            </button>
                        </div>
                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Notes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Cras mattis consectetur purus sit amet fermentum.
                                            Cras justo odio, dapibus ac facilisis in,
                                            egestas eget quam. Morbi leo risus, porta ac
                                            consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque
                                            nisl consectetur et. Vivamus sagittis lacus vel
                                            augue laoreet rutrum faucibus dolor auctor.</p>
                                        <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                                            Praesent commodo cursus magna, vel scelerisque
                                            nisl consectetur et. Donec sed odio dui. Donec
                                            ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->


                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>


