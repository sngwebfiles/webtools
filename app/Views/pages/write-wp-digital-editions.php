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
                        <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Create Digital Editions Paid</h3>
                                        <p class="card-title-desc"></p>
                                        <form class="needs-validation" novalidate>
                                            <div class="row">
                                            <h4 class="card-title">Where to Submit</h4>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <select class="form-select" id="validationCustom03" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid state.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h4 class="card-title">https://beaudeserttimes.com.au/digital-editions/</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="validationCustom01" class="form-label">Post Title</label>
                                                        <input type="text" class="form-control" id="validationCustom01"
                                                            placeholder="" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <h4 class="card-title">PDF File</h4><p> select one either URL or Upload.</p>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="validationCustom01" class="form-label">URL Path</label>
                                                        <input type="text" class="form-control" id="validationCustom01"
                                                            placeholder="" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="validationCustom01" class="form-label">Upload</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="customFile">
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="validationCustom03" class="form-label">Category</label>
                                                        <select class="form-select" id="validationCustom03" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid state.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="validationCustom04" class="form-label">Taxonomy</label>
                                                        <select class="form-select" id="validationCustom04" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid city.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="validationCustom05" class="form-label">Tags</label>
                                                        <input type="text" class="form-control" id="validationCustom05"
                                                            placeholder="" required>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid zip.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Featured Image</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="customFile">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <form method="post">
                                                    <textarea id="elm1" name="area"></textarea>
                                                </form>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                                    required>
                                                <label class="form-check-label" for="invalidCheck">
                                                    Agree to terms and conditions
                                                </label>
                                                <div class="invalid-feedback">
                                                    You must agree before submitting.
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
    
                                        <h4 class="card-title">PDF Viewer Selected</h4>
                                        <div class="imageview"></div>
        
                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
    
                                        <h4 class="card-title">View Featured Image Selected</h4>
                                        <div class="imageview"></div>
        
                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- </div> -->

                        <!-- Page Content End -->
                    </div>
                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>