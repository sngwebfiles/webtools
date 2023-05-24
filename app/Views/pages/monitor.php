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

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Select Date</h6>

                            <div style="display: inline-flex;">
                                <div class="col-md-7" style="margin-right: 4px;">
                                    <input class="form-control" type="date" value="2011-08-19" id="dtdate">
                                </div>
                                <div class="col-md-5 mt-1">
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">
                                        Search <i class="fas fa-search align-middle ms-2"></i> 
                                    </button>
                                </div>        
                            </div>
                        </div>
                    
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                    <span class="d-block d-sm-none"><i class=" ri-money-dollar-circle-line"></i></span>
                                    <span class="d-none d-sm-block">PAID</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                    <span class="d-block d-sm-none"><i class="ri-gift-2-line"></i></span>
                                    <span class="d-none d-sm-block">FREE</span>    
                                </a>
                            </li>
                        </ul>
                                 
                        <div class="tab-content p-3_ text-muted">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <?php echo view('contents/digital-edition-paid'); ?>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <?php echo view('contents/digital-edition-free'); ?>
                            </div>
                        </div>
                        
                        <div class="button-items col-md-6 col-xl-3" style="margin-bottom:10px;">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                Execute All <i class="ri-folder-open-fill align-middle ms-2"></i> 
                            </button>
         
                        </div>
                            
                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>


