<?php echo view('templates/header'); ?>
<main class="flex-shrink-0">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="wrapper thank-you-page">
                <div class="thank-you-pop">
                    <img src="tick.png" alt="">
                    <h1>Dashboard</h1>
                    <h3 class="cupon-pop">Welcome:
                        <span>
                            <?php if (!empty($session)) {
                                print $session->get('fname');
                            } else {
                                print "User";
                            } ?>
                        </span>
                    </h3>
                </div>
                <hr>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo view('templates/footer'); ?>