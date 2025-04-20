<div class="modal-primary me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog">
        <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Perincian Faktur
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            No Faktur
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->no_faktur ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Supplier
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->nama_supplier ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            Tanggal Terima Barang
                        </div>
                        <div class="col-10">
                            : <?= $data[0]->tgl_faktur ?>
                        </div>
                    </div>
                    <?= $this->include('tabel/detil_faktur')  ?>
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