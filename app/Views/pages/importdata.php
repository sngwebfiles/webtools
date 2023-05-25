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
                                <a class="nav-link active" data-bs-toggle="tab" href="#import" role="tab">
                                    <span class="d-block d-sm-none"><i class=" ri-money-dollar-circle-line"></i></span>
                                    <span class="d-none d-sm-block">Import XML</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#upload" role="tab">
                                    <span class="d-block d-sm-none"><i class="ri-gift-2-line"></i></span>
                                    <span class="d-none d-sm-block">Upload to WP Post</span>    
                                </a>
                            </li>
                        </ul>
                                 
                        <div class="tab-content p-3_ text-muted">
                            <div class="tab-pane active" id="import" role="tabpanel">
                                
                                <div class="card" style="border:1px solid #ced4da !important;border-top:0px !important;border-radius: 0.25rem; border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <!-- <form method="post" id="uploadimport" action="uploadimport" enctype="multipart/form-data"> -->
                                                
                                                    <form action="importdata/upload" name="xmlfile" id="xmlfile" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field() ?>
                                                        <label for="validationCustom01" class="form-label">Upload XML File</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="uploadxml" id="uploadxml">

                                                            <div class="col-sm-4">
                                                            <select class="form-select" name="website" id="website">
                                                                <option value="" selected>...</option>
                                                                <option value="plainsproducer.com.au">plainsproducer.com.au</option>
                                                                <option value="epadvocate.com.au">epadvocate.com.au</option>
                                                                <option value="fleurieusun.com.au">fleurieusun.com.au</option>
                                                                <option value="twowellsecho.com.au">twowellsecho.com.au</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1" style="display: inline-flex;">
                                                            <button type="submit" name="submit" id="submitxml" class="btn btn-primary waves-effect waves-light">
                                                                Import XML to Database <i class="ri-upload-2-fill align-middle ms-2"></i> 
                                                            </button>
                                                            <div id="xml_loading"><p><img src="assets/images/loading.gif" /> Please Wait</p></div>
                                                        </div>
                                                        <div id="xml_res"></div>
                                                    </form>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="button-items col-12" style="margin-bottom:10px;">
                                                    <button type="button" type="button" onclick="location.href='importdata/truncate'" class="btn btn-warning waves-effect waves-light float-end " style="position:relative">
                                                        Delete All Records <i class="ri-delete-bin-line align-middle ms-2"></i> 
                                                    </button>
                                                    <button type="button" type="button" onclick="location.href='importdata/deleteempty'" class="btn btn-warning waves-effect waves-light float-end " style="position:relative">
                                                        Delete Empty Rows <i class="ri-delete-back-fill align-middle ms-2"></i> 
                                                    </button>
                                                </div> 
                                            </div>
                                        </div>

                                        <hr>
                                        <h5 class="form-label">Imported Data from XML</h5>
                                        <!-- <table id="datatablepaid" class="table table-bordered dt-responsive nowrap table-pub" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
                                        <form name="post_list" method="post" onSubmit="return delete_confirm();"/>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-pub" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select_all" value=""/></th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Category</th>
                                                <th>Featured Image</th>
                                                <th>By Line</th>
                                                <th>Date Created</th>
                                                <th>Date Modified</th>
                                            </tr>
                                            </thead>
        
                                            <tbody>
                                            <?php $count = 0; foreach ($xmlimport as $pub) { $count++;  ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" name="checked_id[]" class="checkbox" value="<?= $pub['id'] ?>"/>
                                                         <? //echo $count; ?>
                                                    </div>
                                               </td>
                                                <td><?= $pub['title'] ?></td>
                                                <td><?php 
                                                    if (strlen($pub['content']) > 10)
                                                    {
                                                    $str = substr(htmlentities($pub['content']), 0, 100) . '...';
                                                    echo $str;
                                                    } else {
                                                        echo $pub['content'] ;
                                                    }
                                                ?></td>
                                                <td><?= $pub['category'] ?></td>
                                                <td><a href="<?= base_url().$pub['featured_image'] ?>" target="_blank"><?= $pub['featured_image'] ?></a></td>
                                                <td width="100px"><?= $pub['by_line'] ?></td>
                                                <td width="150px"><?= $pub['date_created'] ?></td>
                                                <td width="150px"><?= $pub['last_modified'] ?></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <button type="submit" id="delete_selected" name="bulk_delete_submit" class="btn btn-warning waves-effect waves-light" style="position:relative">
                                            Delete Selected <i class=" ri-delete-bin-2-line align-middle ms-2"></i> 
                                        </button>

                                        </form>            
                                    </div>
                                </div>
                                <?php //echo view('contents/digital-edition-paid'); ?>
                            </div>
                            <div class="tab-pane" id="upload" role="tabpanel">
                                <div class="card" style="border:1px solid #ced4da !important;border-top:0px !important;border-radius: 0.25rem; border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                    <div class="card-body">
                                        <form name="wppostupload" id="wppostupload" method="post">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select WP Post Location</label>
                                                        <select class="form-select" name="pub_id" id="pub_id">
                                                            <option value="" selected>...</option>
                                                            <?php foreach ($wpaddpost as $pub) {   ?>
                                                                <?php echo "<option value='".$pub['pub_id']."'>".$pub['name'] ."</option>"; ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Number of Post to Add in Wordpress</label>
                                                        <input type="number" class="form-control" id="num_post" name="num_post" value="1" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-items col-md-12" style="margin-bottom:10px;">
                                                <button type="submit" id="addallpost__" class="btn btn-primary waves-effect waves-light">
                                                Add Post to Wordpress <i class="ri-edit-2-fill align-middle ms-2"></i> 
                                                </button>
                                                <!-- <button type="button" id="addpost_selected" class="btn btn-info waves-effect waves-light">
                                                    Add to Story Post Selected <i class=" ri-delete-bin-2-line align-middle ms-2"></i> 
                                                </button> -->
                                                <div id="loadingup"><p><img src="assets/images/loading.gif" /> Please Wait</p></div>
                                                <p id="upsucc"></p>
                                            </div>
                                        </form>                    

                                    </div>
                                </div>     
                            </div>
                        </div>

                        <!-- Page Content End -->
                    </div>


 


                </div>
                <?php echo view('partials/footer'); ?>
            </div>
        </div>


