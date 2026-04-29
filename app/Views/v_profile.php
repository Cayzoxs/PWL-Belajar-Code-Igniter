<?= $this->extend('layout'); ?> 
<?= $this->section('content'); ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">Profile Information</h5>
                
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8">
                        <?= session()->get('username') ?> 
                        <span class="badge bg-danger"><?= session()->get('role') ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8 text-primary">
                        <?= session()->get('email') ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">Login Time</div>
                    <div class="col-lg-9 col-md-8">
                        <?= session()->get('login_time') ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                    <div class="col-lg-9 col-md-8">
                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Sudah Login</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>