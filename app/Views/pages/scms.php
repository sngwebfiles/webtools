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
                        <?php //echo view('contents/scms-treeview'); ?>
                        <style>
                            .frame {
                            position: relative;
                            padding-bottom: 40.75%;
                            height: 0;
                            overflow: hidden;
                            }
                            .frame iframe {
                            position: absolute;
                            top:0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            }
                        </style>
                        <div class="frame">
                            <iframe id="ifrm" src="http://localhost/cicodes/Folder_tree/" width="1000" height="600"></iframe>
                        </div>
                         <br><br>       
                        <div class="button-items">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                Open in File Browser <i class="ri-folder-open-fill align-middle ms-2"></i> 
                            </button>
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                <i class="ri-upload-2-fill align-middle me-2"></i> Upload to ISSUU
                            </button>
                            <button type="button" class="btn btn-warning waves-effect waves-light">
                                <i class="ri-upload-cloud-2-line align-middle me-2"></i> Upload to Hosting
                            </button>
                        </div>


                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>


