<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <?= $this->include('shared_pages/alert') ?>
                <h4 class="card-title mb-4">Form Ganti Password</h4>
                <p class="card-text">
                    Form untuk mengganti / mereset password.
                </p>
                <form class="form" method="post" action="/user/rpassword/updatepss">
                    <div class="form-body">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="feedback1" class="sr-only">Password Baru</label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" class="form-control <?= ($validation->hasError('pss1')) ? 'is-invalid' : ''; ?>" name=" pss1">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pss1'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="feedback1" class="sr-only">Konfirmasi Password</label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" class="form-control  <?= ($validation->hasError('pss2')) ? 'is-invalid' : ''; ?>" name="pss2">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pss2'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-light-primary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>