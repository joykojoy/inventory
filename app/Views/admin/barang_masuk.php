<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card">
        <div class="card-body">
            <button class="btn btn-sm bg-indigo text-light btn-backto-brgmasuk mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward" viewBox="0 0 16 16">
                    <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z" />
                </svg>&nbsp
                Back
            </button>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="nomer_faktur" class="form-label">Nomor Faktur</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="no_input-faktur" 
                               value="<?= $no_faktur ?>" readonly>
                        <button class="btn btn-outline-secondary" type="button" disabled>
                            <i class="bi bi-app"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_faktur" class="form-label">Tanggal terima barang</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="tglreceived" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nomer_faktur" class="form-label">Nama Supplier</label>
                    <div class="input-group mb-3">
                        <select type="text" id="supplier" class="form-control">
                            <option value="">-- Pilih supplier --</option>
                            <?php foreach ($supplier as $s) : ?>
                                <option value="<?= $s->kode ?>"><?= $s->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <h6 class="card-header bg-indigo bg-gradient text-light py-2"> Form Input Penerimaan Barang </h6>
                <div class="card-body mt-3">

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label class="form-label">Kode Barang</label>
                            <div class="input-group mb-3">
                                <input type="text" name="kode_brg" class="form-control" id="kode_brg_input">
                                <button class="btn btn-success btn-cari-item" type="button"><i class="bi bi-search"></i></button>
                                <button class="btn btn-primary" type="button" id="startScanning">
                                    <i class="bi bi-upc-scan"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_brg" class="form-control" id="nama_brg_input" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jumlah Barang</label>
                            <input type="number" name="jumlah_brg" class="form-control" id="jumlah_brg_input">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Satuan</label>
                            <input type="number" name="hpp" class="form-control" id="hpp">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Aksi</label>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info" id="reload-itemTemp" title="Reload">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>&nbsp
                                <button type="button" class="btn btn-success" id="add-itemTemp" title="Simpan">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <h6 class="card-header mt-3 text-center"> Detil Perincian Fakur </h6>
                    <div class="div-cari-item-brg"></div>
                    <div class="divbarangmasuk"></div>
                    <div class="row text-end">
                        <div class="col">
                            <button type="button" class="btn bg-indigo text-light btn-simpan-brgmasuk">
                                <i class="bi bi-file-earmark-text-fill"></i>&nbsp&nbspSimpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pindahkan scanner container ke bagian bawah body -->
<div id="scanner-container" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <div id="interactive" style="width: 640px; height: 480px; position: relative;"></div>
    <div class="scanner-overlay"></div>
    <div class="scanner-buttons" style="text-align: center; margin-top: 10px;">
        <button class="btn btn-danger" type="button" id="stopScanning">
            <i class="bi bi-x-circle"></i> Stop Scanning
        </button>
    </div>
</div>
<?php $this->endSection() ?>

<?= $this->section('css') ?>
<style>
#interactive.viewport {
    width: 640px;
    height: 480px;
    position: relative;
}

#interactive.viewport > canvas, 
#interactive.viewport > video {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.scanner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.3);
    pointer-events: none;
}

@media (forced-colors: active) {
    #interactive.viewport {
        forced-color-adjust: none;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Load QuaggaJS dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check prerequisites
    console.log('Quagga availability:', typeof Quagga);
    console.log('getUserMedia availability:', !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia));
    
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.error('Camera API not available');
        alert('Camera API not supported in this browser');
        return;
    }

    if (typeof Quagga === 'undefined') {
        console.error('Quagga not loaded');
        alert('Barcode scanner library not loaded');
        return;
    }

    const startButton = document.getElementById('startScanning');
    const stopButton = document.getElementById('stopScanning');
    const scannerContainer = document.getElementById('scanner-container');
    let isScanning = false;

    startButton.addEventListener('click', async function() {
        try {
            console.log('Testing camera access...');
            // Test camera access first
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: "environment",
                    width: { min: 640 },
                    height: { min: 480 }
                } 
            });
            
            // Stop test stream
            stream.getTracks().forEach(track => track.stop());
            
            // Start scanner
            initScanner();
        } catch (err) {
            console.error('Camera access error:', err);
            alert('Error accessing camera: ' + err.message);
        }
    });

    async function initScanner() {
        if (isScanning) return;
        
        console.log('Initializing scanner...');
        scannerContainer.style.display = 'block';

        try {
            await new Promise((resolve, reject) => {
                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector("#interactive"),
                        constraints: {
                            facingMode: "environment",
                            width: { min: 640 },
                            height: { min: 480 }
                        },
                    },
                    debug: {
                        drawBoundingBox: true,
                        showFrequency: true,
                        drawScanline: true,
                        showPattern: true
                    },
                    decoder: {
                        readers: [
                            "code_128_reader",
                            "ean_reader",
                            "ean_8_reader",
                            "code_39_reader",
                            "upc_reader"
                        ]
                    },
                    locate: true
                }, function(err) {
                    if (err) {
                        console.error('Quagga initialization failed:', err);
                        reject(err);
                        return;
                    }
                    console.log('Quagga initialized successfully');
                    resolve();
                });
            });

            console.log('Starting Quagga...');
            Quagga.start();
            isScanning = true;

            Quagga.onDetected(function(result) {
                if (result.codeResult && result.codeResult.code) {
                    const code = result.codeResult.code;
                    console.log('Barcode detected:', code);
                    
                    document.getElementById('kode_brg_input').value = code;
                    stopScanning();
                    document.querySelector('.btn-cari-item').click();
                }
            });

        } catch (err) {
            console.error('Scanner initialization error:', err);
            alert('Failed to start scanner: ' + err.message);
            stopScanning();
        }
    }

    function stopScanning() {
        if (!isScanning) return;
        
        console.log('Stopping scanner...');
        try {
            Quagga.stop();
            scannerContainer.style.display = 'none';
            isScanning = false;
            console.log('Scanner stopped');
        } catch (err) {
            console.error('Error stopping scanner:', err);
        }
    }

    stopButton.addEventListener('click', stopScanning);

    // Cleanup
    window.addEventListener('beforeunload', function() {
        if (isScanning) {
            Quagga.stop();
        }
    });
});
</script>
<?= $this->endSection() ?>