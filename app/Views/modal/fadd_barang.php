<div class="modal-primary me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog">
        <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Form Tambah Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="form-add-barang" method="POST" action="/admin/master_barang/simpan">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="kode" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode">
                                <div class="invalid-feedback" id="error-kode"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="induk" class="col-sm-3 col-form-label">Group</label>
                            <div class="col-sm-9">
                                <select type="text" name="induk" class="form-control">
                                    <option value="">-- Pilih Group --</option>
                                    <?php foreach ($group as $g) : ?>
                                        <option value="<?= $g->kode ?>"><?= $g->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                            <div class="col-sm-9">
                                <select type="text" name="satuan" class="form-control">
                                    <option value="">-- Pilih Satuan --</option>
                                    <?php foreach ($satuan as $s) : ?>
                                        <option value="<?= $s->id ?>"><?= $s->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="min" class="col-sm-3 col-form-label">Min Stok</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="min">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="harga" step="0.01" min="0">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" name="kode_lokasi" class="form-control" value="<?= $data->kode_lokasi ?>" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>