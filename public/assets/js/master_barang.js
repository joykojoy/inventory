document.addEventListener('DOMContentLoaded', function() {
    // Save handler
    $(document).on('submit', '#form-add-barang', function(e) {
        e.preventDefault();
        
        // Get form data using serialize()
        let formData = $(this).serialize();

        // Reset validation states
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();

        $.ajax({
            url: '/admin/master_barang/simpan',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="spinner-border spinner-border-sm"></i> Processing...');
            },
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            $('[name="' + key + '"]').addClass('is-invalid');
                            $('#error-' + key).text(value);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Terjadi kesalahan'
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server'
                });
            },
            complete: function() {
                $('button[type="submit"]').prop('disabled', false)
                    .html('<i class="bi bi-save"></i> Simpan');
            }
        });
    });

    // Edit handler
    $(document).on('submit', '#form-edit-barang', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '/admin/master_barang/update',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diupdate',
                        timer: 1500
                    }).then(() => {
                        $('#modal-edit-barang').modal('hide');
                        location.reload();
                    });
                }
            }
        });
    });

    // Delete handler
    $(document).on('click', '.btn-delete-barang', function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/master_barang/delete',
                    type: 'POST',
                    data: { 
                        id: id,
                        [csrfName]: csrfHash // Add CSRF token if enabled
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        // Show loading state
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Sedang memproses',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                });
            }
        });
    });

    // New delete handler
    $(document).on('click', '.btn-delete-barang', function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '/admin/master_barang/fhapus',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            beforeSend: function() {
                $('.div-barang').html('<div class="text-center">Loading...</div>');
            },
            success: function(response) {
                if (response.status) {
                    $('.div-barang').html(response.content);
                    $('#modal-hapus-barang').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Terjadi kesalahan'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server'
                });
            }
        });
    });

    // Delete button click handler
    $(document).on('click', '.btn-hapus-barang', function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '/admin/master_barang/fhapus',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            beforeSend: function() {
                $('.div-barang').html('<div class="text-center"><i class="spinner-border spinner-border-sm"></i> Loading...</div>');
            },
            success: function(response) {
                if (response.status) {
                    $('.div-barang').html(response.content);
                    $('#modal-hapus-barang').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Terjadi kesalahan'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server'
                });
            }
        });
    });

    // Form submit handler
    $(document).on('submit', '#form-hapus-barang', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/admin/master_barang/delete',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="spinner-border spinner-border-sm"></i> Processing...');
            },
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#modal-hapus-barang').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Gagal menghapus data'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server'
                });
            },
            complete: function() {
                $('button[type="submit"]').prop('disabled', false)
                    .html('<i class="bi bi-trash"></i> Hapus');
            }
        });
    });
});