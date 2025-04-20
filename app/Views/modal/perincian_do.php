<div class="modal-primary me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog">
        <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Perincian DO
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            No DO
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->no_do ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Customer
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->nama_customer ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            Tanggal Keluar Barang
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->tgl_do ?>
                        </div>
                    </div>
                    <?= $this->include('tabel/detil_do')  ?>
                    <!-- <div class="row mb-3">
                        <div class="col-3 text-end">
                            Mengetahui</br></br></br>
                            Admin Gudang
                        </div>
                        <div class="col-6 text-end">
                            Penerima</br></br></br>
                            Penerima Barang
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>