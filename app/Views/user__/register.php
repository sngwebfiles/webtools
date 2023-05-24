<?php echo view('templates/header'); ?>
<main class="flex-shrink-0">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h2 class="mt-5 text-center">Register User</h2>
                <p>&nbsp;</p>
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url(); ?>register" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="username" placeholder="User Name" value="<?= set_value('username') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="fname" placeholder="Name" value="<?= set_value('fname') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php echo view('templates/footer'); ?>