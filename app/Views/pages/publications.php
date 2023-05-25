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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">List of Websites</h4>
                                        <p class="card-title-desc"></p>    
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-pub">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>LOCATION</th>
                                                        <th>WEBSITE</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($allpub as $pub) { ?>
                                                    <tr>
                                                        <td><?= $pub['name'] ?></td>
                                                        <td><?= $pub['location'] ?></td>
                                                        <td><?= $pub['wordpress_url'] ?></td>
                                                        <!-- <td><a href="#" title="View Info"><button type="button" class="btn btn-info btn-sm waves-effect waves-light float-end"><i class="fas fa-clipboard-list align-middle me-2"></i> View Info</button></a></td> -->
                                                        <td><a href="#" title="View Info"><i class="fas fa-clipboard-list align-middle me-2"></i> View Info</a></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <a href="#" title="View Info"><button type="button" class="btn btn-success waves-effect waves-light"  data-bs-toggle="modal" data-bs-target=".modal"><i class="ri-file-add-line align-middle mr-1"></i> Add New Publication</button></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Details</h4>
                                        <p class="card-title-desc"></p>
                                            <form class="needs-validation" id="svpublication" novalidate>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-sm-6">
                                                    <label for="example-number-input" class="col-form-label">ID</label>
                                                    <div class="">
                                                        <input class="form-control" disabled type="number" value="" id="example-number-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                        <label for="example-number-input" class="col-form-label">PUB_ID</label>
                                                        <div class="">
                                                            <input class="form-control" type="number" value="0" id="example-number-input">
                                                        </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                        <label for="example-number-input" class="col-form-label">PARENT PUB_ID</label>
                                                        <div class="">
                                                            <input class="form-control" type="number" value="0" id="example-number-input">
                                                        </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                        <label for="example-number-input" class="col-form-label">GROUP PUB_ID</label>
                                                        <div class="">
                                                            <input class="form-control" type="number" value="0" id="example-number-input">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-url-input" class="col-sm-2 col-form-label">Website</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="url" id="example-url-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Location</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected="">...</option>
                                                        <option value="SA">SA</option>
                                                        <option value="QLD">QLD</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <!-- <div class="row mb-3">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Search</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="search"  id="example-search-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" id="example-email-input">
                                                </div>
                                            </div> -->
                                            <div class="row mb-3">
                                                <label for="example-url-input" class="col-sm-3 col-form-label">WP Rest API Endpoint</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="url" id="example-url-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">WP Rest API User</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-password-input" class="col-sm-3 col-form-label">WP Rest API Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                                </div>
                                            </div>
                                             <hr>           
                                            <div class="mb-3">
                                                <button class="btn btn-primary float-end" type="submit">Update</button>
                                            </div>
                                        </form>
                                        <!-- end row -->
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Publication</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- <form class="needs-validation" name="addpub" id="addpub" action="<?php echo base_url(); ?>publications/savepub" method="post"> -->
                                    <form class="needs-validation" action="/publications/savepub" name="addpub" id="addpub" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                    <label for="pub_id" class="col-form-label">PUB_ID*</label>
                                                    <div class="">
                                                        <input class="form-control" type="number" value="0" name="pub_id" id="pub_id">
                                                    </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="parent_pub_id" class="col-form-label">PARENT PUB_ID</label>
                                                <div class="">
                                                    <input class="form-control" type="number" value="0" name="parent_pub_id" id="parent_pub_id">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="group_pub_id" class="col-form-label">GROUP PUB_ID</label>
                                                <div class="">
                                                    <input class="form-control" type="number" value="0" name="group_pub_id" id="group_pub_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="website" class="col-sm-2 col-form-label">Website*</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="url" name="website" id="website">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                                <label for="location" class="col-sm-2 col-form-label">Location*</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" name="loc" id="loc">
                                                        <option value="" selected>...</option>
                                                        <option value="SA">SA</option>
                                                        <option value="QLD">QLD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="row mb-3">
                                            <label for="api_url" class="col-sm-5 col-form-label">WP Rest API Endpoint</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="url" name="api_url" id="api_url">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="api_user" class="col-sm-5 col-form-label">WP Rest API User</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" name="api_user" id="api_user">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="api_pass" class="col-sm-5 col-form-label">WP Rest API Password</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="password" value="" name="api_pass" id="api_pass">
                                            </div>
                                        </div>
                                        <div class="err_input"></div>
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" class="form-control" value="aaa" name="chk" id="chk" va>
                                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="pubsubmit" id="pubsubmit" class="btn btn-primary waves-effect waves-light">Save</button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        <!-- </div>/.modal -->
                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>