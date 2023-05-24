<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="https://techarise.com">S3 File Upload</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">Home</a>
          </li>

        </ul>
        <form class="d-flex">
          <?php if (!empty(session())) { ?>
            <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>/user/logout">Logout</a>
          <?php } else {
          ?>
            <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>/register">Login <?php print_r(session()->get('fname')); ?> </a>
          <?php
          } ?>
        </form>
      </div>
    </div>
  </nav>
</header>