<?php $session = \Config\Services::session() ?>
<script type="text/javascript">
    // tambah user
    $(".btn-add-user").on("click", function() {
        $.ajax({
            url: "/admin/manuser/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-user").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // simpan tambah user
    $(document).on("submit", "#form-add-user", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/manuser";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit user
    $(".btn-edit-user").on("click", function() {
        let username = $(this).data("username");
        $.ajax({
            url: "/admin/manuser/edit",
            data: {
                username: username,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-user").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // update user
    $(document).on("submit", "#form-edit-user", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/manuser";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // aktifkan user
    $(".btn-aktifkan-user").on("click", function() {
        let username = $(this).data("username");
        $.ajax({
            url: "/admin/manuser/aktifkan",
            data: {
                username: username,
            },
            dataType: "json",
            success: function() {
                window.location.href = "/admin/manuser";
            }
        });
    })
    // nonaktifkan user
    $(".btn-nonaktifkan-user").on("click", function() {
        let username = $(this).data("username");
        $.ajax({
            url: "/admin/manuser/nonaktifkan",
            data: {
                username: username,
            },
            dataType: "json",
            success: function() {
                window.location.href = "/admin/manuser";
            }
        });
    })
    // form hapus user
    $(".btn-hapus-user").on("click", function() {
        let username = $(this).data("username");
        $.ajax({
            url: "/admin/manuser/fhapus",
            data: {
                username: username,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-user").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // submit hapus user
    $(document).on("submit", "#form-hapus-user", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                window.location.href = "/admin/manuser";
            }
        });
    })
    // form tambah supplier
    $(".btn-add-supplier").on("click", function() {
        $.ajax({
            url: "/admin/mansupplier/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-supplier").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // simpan supplier
    $(document).on("submit", "#form-add-supplier", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mansupplier";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit supplier
    $(".btn-edit-supplier").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mansupplier/edit",
            data: {
                id: id,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-supplier").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // update supplier
    $(document).on("submit", "#form-edit-supplier", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mansupplier";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form hapus supplier
    $(".btn-hapus-supplier").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mansupplier/fhapus",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-supplier").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit delete supplier
    $(document).on("submit", "#form-hapus-supplier", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mansupplier";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form tambah customer
    $(".btn-add-customer").on("click", function() {
        $.ajax({
            url: "/admin/mancustomer/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-customer").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // simpan customer
    $(document).on("submit", "#form-add-customer", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds)
                if (responds.status) {
                    window.location.href = "/admin/mancustomer";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit customer
    $(".btn-edit-customer").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mancustomer/edit",
            data: {
                id: id,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-customer").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit update customer
    $(document).on("submit", "#form-edit-customer", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mancustomer";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form hapus customer
    $(".btn-hapus-customer").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mancustomer/fhapus",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-customer").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit delete customer
    $(document).on("submit", "#form-hapus-customer", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mancustomer";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form tambah barang
    $(".btn-add-barang").on("click", function() {
        $.ajax({
            url: "/admin/master_barang/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-barang").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // simpan barang
    $(document).on("submit", "#form-add-barang", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds)
                if (responds.status) {
                    window.location.href = "/admin/master_barang";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit barang
    $(".btn-edit-barang").on("click", function() {
        let kode_barang = $(this).data('kode_barang')
        $.ajax({
            url: "/admin/master_barang/edit",
            data: {
                kode_barang: kode_barang,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-barang").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit update barang
    $(document).on("submit", "#form-edit-barang", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_barang";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // aktifkan barang
    $(".btn-aktifkan-barang").on("click", function() {
        let barang = $(this).data("barang");
        $.ajax({
            url: "/admin/master_barang/aktifkan",
            data: {
                barang: barang,
            },
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_barang";
                }
            }
        });
    })
    // nonaktifkan barang
    $(".btn-nonaktifkan-barang").on("click", function() {
        let barang = $(this).data("barang");
        $.ajax({
            url: "/admin/master_barang/nonaktifkan",
            data: {
                barang: barang,
            },
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_barang";
                }
            }
        });
    })
    // form hapus barang
    $(".btn-hapus-barang").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/master_barang/fhapus",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-barang").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit delete barang
    $(document).on("submit", "#form-hapus-barang", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_barang";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form tambah satuan
    $(".btn-add-satuan").on("click", function() {
        $.ajax({
            url: "/admin/master_satuan/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-satuan").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // simpan satuan
    $(document).on("submit", "#form-add-satuan", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds)
                if (responds.status) {
                    window.location.href = "/admin/master_satuan";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit satuan
    $(".btn-edit-satuan").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/master_satuan/edit",
            data: {
                id: id,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-satuan").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit update satuan
    $(document).on("submit", "#form-edit-satuan", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_satuan";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // aktifkan satuan
    $(".btn-aktifkan-satuan").on("click", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "/admin/master_satuan/aktifkan",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                window.location.href = "/admin/master_satuan";
            }
        });
    })
    // nonaktifkan satuan
    $(".btn-nonaktifkan-satuan").on("click", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "/admin/master_satuan/nonaktifkan",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                window.location.href = "/admin/master_satuan";
            }
        });
    })
    // form hapus satuan
    $(".btn-hapus-satuan").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/master_satuan/fhapus",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-satuan").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit delete satuan
    $(document).on("submit", "#form-hapus-satuan", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/master_satuan";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form tambah group
    $(".btn-add-group").on("click", function() {
        $.ajax({
            url: "/admin/mangroup/tambah",
            dataType: "json",
            success: function(responds) {
                $(".div-group").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // simpan group
    $(document).on("submit", "#form-add-group", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mangroup";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form edit group
    $(".btn-edit-group").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mangroup/edit",
            data: {
                id: id,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-group").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit update group
    $(document).on("submit", "#form-edit-group", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mangroup";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })
    // form hapus group
    $(".btn-hapus-group").on("click", function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/mangroup/fhapus",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(responds) {
                $(".div-group").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // submit delete group
    $(document).on("submit", "#form-hapus-group", function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/mangroup";
                } else {
                    $.each(responds.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                        $('[name="' + key + '"]').next().text(value)
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid')
                            $('[name="' + key + '"]').addClass('is-valid')
                        }
                    })
                }
            }
        });
    })

    /*                                                       
     *************** script penerimaan brg masuk ************
     */

    // function dataTemp, menampilkan data temp
    function data_temp() {
        let noFaktur = $("#no_input-faktur").val()
        $.ajax({
            url: "/admin/barangmasuk/datatemp",
            data: {
                noFaktur: noFaktur,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".divbarangmasuk").html(responds)
            }
        });
    }
    // function kosongkan input brg masuk
    function kosongkan() {
        $("#kode_brg_input").val('')
        $("#nama_brg_input").val('')
        $("#jumlah_brg_input").val('')
        $("#hpp").val('')
    }
    // function load nama item barang
    function load_item_brg(kodeBarang) {
        $.ajax({
            url: "/admin/barangmasuk/detilbarang",
            data: {
                kodeBarang: kodeBarang,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds.data.nama)
                $("#nama_brg_input").val(responds.data.nama)
                $("#jumlah_brg_input").focus()
            }
        });
    }
    // jalankan form penerimaan barang atau brg masuk
    data_temp()
    // reload input temp
    $("#reload-itemTemp").click(function() {
        let noFaktur = $("#no_input-faktur").val()
        if (noFaktur.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomer Faktur belum diisi',
            })
        } else {
            data_temp()
        }
    })
    // baca kode dan nama barang
    $("#kode_brg_input").keyup(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault()
            let kodeBarang = $("#kode_brg_input").val()
            load_item_brg(kodeBarang)
        }
    })
    // simpan input temp
    $("#add-itemTemp").click(function() {
        let noFaktur = $("#no_input-faktur").val();
        let supplier = $("#supplier").val();
        let kodeBarangInput = $("#kode_brg_input").val();
        let jumlahBarangInput = $("#jumlah_brg_input").val();
        let hpp = $("#hpp").val();

        // Validation checks...
        if (!noFaktur || !supplier || !kodeBarangInput || !jumlahBarangInput || !hpp) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua field harus diisi'
            });
            return;
        }

        $.ajax({
            url: "/admin/barangmasuk/simpan_detilbarang",
            data: {
                noFaktur: noFaktur,
                supplier: supplier,
                kodeBarangInput: kodeBarangInput,
                jumlahBarangInput: jumlahBarangInput,
                hpp: hpp
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    data_temp();
                    kosongkan();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: responds.psn
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: responds.psn
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
    })
    // cari item brg
    $(".btn-cari-item").click(function() {
        $.ajax({
            url: "/admin/barangmasuk/cari_item",
            dataType: "json",
            success: function(responds) {
                $(".div-cari-item-brg").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // simpan entri brg masuk
    $(".btn-simpan-brgmasuk").click(function() {
        let noFaktur = $("#no_input-faktur").val();
        
        if (noFaktur.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'No Faktur belum diisi',
            });
            return;
        }

        Swal.fire({
            text: "Benar akan menyimpan data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/barangmasuk/simpan",
                    type: "POST", // Changed from method to type
                    dataType: "json",
                    data: {
                        noFaktur: noFaktur
                    },
                    success: function(responds) {
                        if (responds.status) {
                            Swal.fire({
                                title: 'Akan menambah faktur lagi?',
                                showDenyButton: true,
                                confirmButtonText: 'Ya',
                                denyButtonText: `Tidak`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    data_temp();
                                } else if (result.isDenied) {
                                    window.location.href = "/admin/barangmasuk";
                                }
                            });
                        }
                    },
                    error: function(xhr, status, err) {
                        console.error("Server-side error:", xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error di server',
                            text: xhr.responseText
                        });
                    }
                });
            }
        });
    })
    // form tambah brg masuk
    $(".btn-fentri-brgmasuk").click(function() {
        window.location.href = "/admin/barangmasuk/tambah"
    })
    // form back to list brg masuk
    $(".btn-backto-brgmasuk").click(function() {
        window.location.href = "/admin/barangmasuk"
    })
    // lihat perincian faktur brg masuk
    $(".detil-faktur").click(function() {
        let nofaktur = $(this).data('nofaktur')
        $.ajax({
            url: "/admin/barangmasuk/detil_faktur",
            method: "post",
            data: {
                nofaktur: nofaktur
            },
            dataType: "json",
            success: function(responds) {
                $(".div-terimabrg").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })

    /*                                                       
     *************** script edit faktur brg masuk ************
     */

    // function edit faktur brg masuk 
    function detil_brgmasuk() {
        let noFaktur = $("#nofaktur-fedit").val()
        $.ajax({
            url: "/admin/barangmasuk/databrgmasuk",
            data: {
                noFaktur: noFaktur,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-fedit-faktur").html(responds)
            }
        });
    }
    // load nama item barang
    function load_item_fedit(kodeBarang) {
        $.ajax({
            url: "/admin/barangmasuk/detilbarang",
            data: {
                kodeBarang: kodeBarang,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds.data.nama)
                $("#nama_brg-fedit").val(responds.data.nama)
                $("#jumlah_brg-fedit").focus()
            }
        });
    }
    // function kosongkan fedit
    function kosongkan_fedit() {
        $("#kode_brg-fedit").val('')
        $("#nama_brg-fedit").val('')
        $("#jumlah_brg-fedit").val('')
        $("#hpp-fedit").val('')
    }
    // jalankan edit faktur 
    detil_brgmasuk()
    // edit faktur brg masuk
    $(".btn-edit-fbrgmasuk").click(function() {
        let nofaktur = $(this).data('nofaktur')
        Swal.fire({
            text: "Benar akan mengedit faktur no : " + nofaktur + " ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/admin/barangmasuk/fedit_faktur/" + nofaktur
            }
        })
    })
    // baca kode barang fedit
    $("#kode_brg-fedit").keyup(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault()
            let kodeBarang = $("#kode_brg-fedit").val()
            load_item_fedit(kodeBarang)
        }
    })
    // cari item fedit
    $(".btn-cari-fedit").click(function() {
        $.ajax({
            url: "/admin/barangmasuk/cari_item_fedit",
            dataType: "json",
            success: function(responds) {
                $(".div-cari-item-fedit").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // simpan fedit
    $("#add-fedit").click(function() {
        let noFaktur = $("#nofaktur-fedit").val()
        let supplier = $("#supplier-fedit").val()
        let tglreceived = $("#tgl-fedit").val()
        let kodeBarangInput = $("#kode_brg-fedit").val()
        let namaBarangInput = $("#nama_brg-fedit").val()
        let jumlahBarangInput = $("#jumlah_brg-fedit").val()
        let hpp = $("#hpp-fedit").val()
        if (noFaktur.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomer Faktur belum diisi',
            })
        } else if (supplier.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Supplier belum diisi',
            })
        } else if (namaBarangInput.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama barang belum diisi',
            })
        } else if (jumlahBarangInput.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Jumlah barang belum diisi',
            })
        } else if (hpp.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'HPP belum diisi',
            })
        } else {
            $.ajax({
                url: "/admin/barangmasuk/simpan_fedit",
                data: {
                    noFaktur: noFaktur,
                    supplier: supplier,
                    tglreceived: tglreceived,
                    kodeBarangInput: kodeBarangInput,
                    jumlahBarangInput: jumlahBarangInput,
                    hpp: hpp
                },
                method: "post",
                dataType: "json",
                success: function(responds) {
                    if (responds.status) {
                        detil_brgmasuk()
                        kosongkan_fedit()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: responds.psn,
                        })
                    }
                }
            });
            $("#kode_brg-fedit").focus()
        }
    })
    /****************** end script edit faktur ****************/

    /*                                                           
     ************* awal script history brg all *************
     */
    $("#cari-his-brg").click(function() {
    let tglAwal = $("#tglawal-his").val()
    let tglAkhir = $("#tglakhir-his").val()
    let opsi = 'all'

    if (!tglAwal || !tglAkhir) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Tanggal awal dan akhir harus diisi!'
        });
        return;
    }

    $.ajax({
        url: "/admin/historystock/his_brg",
        type: "POST", // Be explicit about the type
        data: {
            tglAwal: tglAwal,
            tglAkhir: tglAkhir,
            opsi: opsi
        },
        dataType: "json",
        beforeSend: function() {
            $("#div-history-stock1").html('<div class="text-center">Loading...</div>');
        },
        success: function(response) {
            console.log("Response received:", response); // Log full response
            if (response.status) {
                $("#div-history-stock1").html(response.data);
            } else {
                $("#div-history-stock1").html('<div class="text-center text-danger">Failed to load data</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.log('Status:', status);
            console.log('Response:', xhr.responseText);
            $("#div-history-stock1").html('<div class="text-center text-danger">Error loading data</div>');
        }
    });
})
    /* ******** end script history brg all ******** */

    /*                                                           
     ************* awal script history brg masuk *************
     */
    $("#cari-his-brgmasuk").click(function() {
        let tglAwal = $("#tglawal-his-in").val()
        let tglAkhir = $("#tglakhir-his-in").val()
        
        if (!tglAwal || !tglAkhir) {
            Swal.fire({
                icon: 'warning', 
                title: 'Peringatan',
                text: 'Tanggal awal dan akhir harus diisi!'
            });
            return;
        }

        $.ajax({
            url: "/admin/historystock/his_brg",  // Changed from his_brgmasuk to his_brg
            type: "POST",
            data: {
                tglAwal: tglAwal,
                tglAkhir: tglAkhir,
                opsi: 'brg_in'  // Added opsi parameter
            },
            dataType: "json",
            beforeSend: function() {
                $("#div-history-stock-in").html('<div class="text-center">Loading...</div>');
            },
            success: function(response) {
                if (response.status) {
                    $("#div-history-stock-in").html(response.data);
                } else {
                    $("#div-history-stock-in").html('<div class="alert alert-danger">Gagal memuat data</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $("#div-history-stock-in").html('<div class="alert alert-danger">Error: ' + error + '</div>');
            }
        });
    })
    /* ******** end script history brg masuk ******** */

    /*                                                           
     ************* awal script history brg keluar *************
     */
    $("#cari-his-brgkeluar").click(function() {
        let tglAwal = $("#tglawal-his-out").val()
        let tglAkhir = $("#tglakhir-his-out").val()
        let opsi = 'brg_out'
        $.ajax({
            url: "/admin/historystock/his_brg",
            data: {
                tglAwal: tglAwal,
                tglAkhir: tglAkhir,
                opsi: opsi
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    $("#div-history-stock-out").html(responds.data)
                }
            }
        });
    })
    /* ******** end script history brg keluar ******** */

    /*                                                      
     *************** start form entri brg keluar *************
     */

    // function dataTemp
    function data_temp_keluar() {
        let noDO = $("#no_input-do").val()
        $.ajax({
            url: "/admin/barangkeluar/datatemp",
            data: {
                noDO: noDO,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $("#customer").val(responds.customer)
                $(".div-barangkeluar").html(responds.hasil)
            }
        });
    }
    // function kosongkan
    function kosongkan_keluar() {
        $("#kode_brg_keluar").val('')
        $("#nama_brg_keluar").val('')
        $("#jumlah_brg_keluar").val('')
        $("#hrg").val('')
    }
    // load nama item barang
    function load_item_brg_keluar(kodeBarang) {
        $.ajax({
            url: "/admin/barangkeluar/detilbarang",
            data: {
                kodeBarang: kodeBarang,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds.data.nama)
                $("#nama_brg_keluar").val(responds.data.nama)
                $("#jumlah_brg_keluar").focus()
            }
        });
    }
    // jalankan pengeluaran barang 
    data_temp_keluar()
    // reload temp brg keluar
    $("#reload-itemTempKeluar").click(function() {
        let noDO = $("#no_input-do").val()
        if (noDO.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomer DO belum diisi',
            })
        } else {
            data_temp_keluar()
        }
    })
    // baca kode dan nama barang keluar
    $("#kode_brg_keluar").keyup(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault()
            let kodeBarang = $("#kode_brg_keluar").val()
            load_item_brg_keluar(kodeBarang)
        }
    })
    // cari item brg kelur
    $(".btn-cari-item-keluar").click(function() {
        $.ajax({
            url: "/admin/barangkeluar/cari_item",
            dataType: "json",
            success: function(responds) {
                $(".div-cari-item-brg-keluar").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // simpan input ke tabel temp brg keluar
    $("#add-itemTempKeluar").click(function() {
        let noDO = $("#no_input-do").val()
        let customer = $("#customer").val()
        let tglkeluar = $("#tglkeluar").val()
        let kodeBarangKeluar = $("#kode_brg_keluar").val()
        let namaBarangKeluar = $("#nama_brg_keluar").val()
        let jumlahBarangKeluar = $("#jumlah_brg_keluar").val()
        let hrg = $("#hrg").val()
        if (noDO.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomer DO belum diisi',
            })
        } else if (customer.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Customer belum diisi',
            })
        } else if (namaBarangKeluar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama barang belum diisi',
            })
        } else if (jumlahBarangKeluar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Jumlah barang belum diisi',
            })
        } 
        else {
            $.ajax({
                url: "/admin/barangkeluar/simpan_detilbarang",
                data: {
                    noDO: noDO,
                    customer: customer,
                    kodeBarangKeluar: kodeBarangKeluar,
                    jumlahBarangKeluar: jumlahBarangKeluar,
                    hrg: hrg
                },
                method: "post",
                dataType: "json",
                success: function(responds) {
                    if (responds.status) {
                        data_temp_keluar()
                        kosongkan_keluar()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: responds.psn,
                        })
                    }
                }
            });
            $("#kode_brg_keluar").focus()
        }
    })
    // simpan entri brg keluar ke tabel brg keluar
    $(".btn-simpan-brgkeluar").click(function() {
        let noDO = $("#no_input-do").val()
        Swal.fire({
            text: "Benar akan menyimpan data ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/barangkeluar/simpan",
                    data: {
                        noDO: noDO,
                    },
                    method: "post",
                    dataType: "json",
                    success: function(responds) {
                        if (responds.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: responds.psn,
                            })
                            window.location.href = '/admin/barangkeluar'
                        }
                    }
                });
            }
        })
    })
    // lihat perincian DO brg keluar
    $(".detil-do").click(function() {
        let noDO = $(this).data('no_do')
        $.ajax({
            url: "/admin/barangkeluar/detil_do",
            method: "post",
            data: {
                noDO: noDO
            },
            dataType: "json",
            success: function(responds) {
                $(".div-keluarbrg").html(responds)
                $(".modal").modal("toggle")
            }
        })
    })
    // form backto list brg keluar
    $(".btn-backto-brgkeluar").click(function() {
        window.location.href = "/admin/barangkeluar"
    })
    // form tambah brg keluar
    $(".btn-fentri-brgkeluar").click(function() {
        window.location.href = "/admin/barangkeluar/tambah"
    })
    /*************** end form entri brg masuk **************/

    /*                                                    
     ********** awal script edit DO barang keluar *************
     */
    // function data temp edit 
    function dtemp_dofedit() {
        let noDO = $("#no-do-fedit").val()
        $.ajax({
            url: "/admin/barangkeluar/dtemp_dofedit",
            data: {
                noDO: noDO,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                $(".div-do-fedit").html(responds.hasil)
            }
        });
    }
    // load nama item barang
    function load_item_fedit_do(kodeBarang) {
        $.ajax({
            url: "/admin/barangkeluar/detilbarang",
            data: {
                kodeBarang: kodeBarang,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                console.log(responds.data.nama)
                $("#nama-brg-do-fedit").val(responds.data.nama)
                $("#jumlah-brg-do-fedit").focus()
            }
        });
    }
    // function kosongkan fedit DO brg keluar
    function kosongkan_fedit_do() {
        $("#kode-brg-do-fedit").val('')
        $("#nama-brg-do-fedit").val('')
        $("#jumlah-brg-do-fedit").val('')
        $("#hrg-do-fedit").val('')
    }
    // jalankan edit DO brg keluar 
    dtemp_dofedit()
    // form edit DO brg keluar
    $(".btn-edit-brgkeluar").click(function() {
        let noDO = $(this).data('no_do')
        Swal.fire({
            text: "Benar akan mengedit data " + noDO + " ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/admin/barangkeluar/fedit_do/" + noDO
            }
        })
    })
    // baca kode barang fedit DO brg keluar 
    $("#kode-brg-fedit-do").keyup(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault()
            let kodeBarang = $("#kode-brg-do-fedit").val()
            load_item_fedit_do(kodeBarang)
        }
    })
    // cari item fedit DO brg keluar
    $(".btn-cari-fedit-do").click(function() {
        $.ajax({
            url: "/admin/barangkeluar/cari_item_fedit",
            dataType: "json",
            success: function(responds) {
                $(".div-cari-item-fedit-do").html(responds)
                $(".modal").modal("toggle")
            }
        });
    })
    // simpan input ke tabel temp brg keluar
    $("#add-do-fedit").click(function() {
        let noDO = $("#no-do-fedit").val()
        let customer = $("#customer-do-fedit").val()
        let tglkeluar = $("#tgl-do-fedit").val()
        let kodeBarangKeluar = $("#kode-brg-do-fedit").val()
        let namaBarangKeluar = $("#nama-brg-do-fedit").val()
        let jumlahBarangKeluar = $("#jumlah-brg-do-fedit").val()
        let hrg = $("#hrg-do-fedit").val()
        if (noDO.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomer DO belum diisi',
            })
        } else if (namaBarangKeluar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama barang belum diisi',
            })
        } else if (jumlahBarangKeluar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Jumlah barang belum diisi',
            })
        } else if (hrg.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Harga belum diisi',
            })
        } else {
            $.ajax({
                url: "/admin/barangkeluar/simpan_detilbarang",
                data: {
                    noDO: noDO,
                    customer: customer,
                    kodeBarangKeluar: kodeBarangKeluar,
                    jumlahBarangKeluar: jumlahBarangKeluar,
                    hrg: hrg
                },
                method: "post",
                dataType: "json",
                success: function(responds) {
                    if (responds.status) {
                        dtemp_dofedit()
                        kosongkan_fedit_do()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: responds.psn,
                        })
                    }
                }
            });
            $("#kode-brg-do-fedit").focus()
        }
    })
    // simpan fedit DO ke tabel brg keluar
    $(".btn-update-do").click(function() {
        let noDO = $("#no-do-fedit").val()
        let customer = $("#customer-do-fedit").val()
        let tglDO = $("#tgl-do-fedit").val()
        $.ajax({
            url: "/admin/barangkeluar/simpan_fedit",
            data: {
                noDO: noDO,
                customer: customer,
                tglDO: tglDO,
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    window.location.href = "/admin/barangkeluar"
                }
            }
        });
        $("#kode_brg-fedit-do").focus()
    })
    /****************** end script edit DO brg keluar ****************/

    /*
      awal script retur brg masuk dan keluar 
    */

    // retur faktur brg masuk
    $(".btn-retur-faktur").click(function() {
        let noFaktur = $(this).data('nofaktur')
        Swal.fire({
            text: "Benar akan meretur data faktur ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Retur'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/barangmasuk/return",
                    data: {
                        noFaktur: noFaktur,
                    },
                    method: "post",
                    dataType: "json",
                    success: function(responds) {
                        if (responds.status) {
                            window.location.href = "/admin/barangmasuk"
                        }
                    }
                });
            }
        })
    })
    // retur DO brg keluar
    $(".btn-retur-do").click(function() {
        let noDO = $(this).data('no_do')
        Swal.fire({
            text: "Benar akan meretur data DO ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Retur'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/barangkeluar/return",
                    data: {
                        noDO: noDO,
                    },
                    method: "post",
                    dataType: "json",
                    success: function(responds) {
                        console.log(responds)
                        if (responds.status) {
                            window.location.href = "/admin/barangkeluar"
                        }
                    }
                });
            }
        })
    })
    /****************** end script retur brg masuk & keluar ****************/

    // Add to existing JavaScript section in barang_masuk.php

    // Add price check when selecting product
    $('#kode_brg_input').on('change', function() {
        let kodeBarang = $(this).val();
        $.ajax({
            url: '<?= base_url('admin/barangmasuk/detilbarang') ?>',
            type: 'POST',
            data: {
                kodeBarang: kodeBarang
            },
            dataType: 'json',
            success: function(response) {
                if (response.data) {
                    window.currentHarga = response.data.harga;
                    $('#hpp').val(response.data.harga);
                }
            }
        });
    });

    // Add price check before adding item
    $('#add-itemTemp').on('click', function() {
        let kodeBarang = $('#kode_brg_input').val();
        let hargaBaru = parseFloat($('#hpp').val());
        let hargaLama = parseFloat(window.currentHarga);

        if (hargaBaru !== hargaLama) {
            if (confirm('Harga yang dimasukkan berbeda dengan harga di database. Update harga barang?')) {
                $.ajax({
                    url: '<?= base_url('admin/barangmasuk/updateHarga') ?>',
                    type: 'POST',
                    data: {
                        kode_brg: kodeBarang,
                        harga: hargaBaru
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.currentHarga = hargaBaru;
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        }
        // Continue with existing add item code
        // ...existing code...
    });

    $.ajax({
        url: '/admin/master_barang/simpan',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                // Success handling
                alert(response.message);
                // Refresh the page or table
                location.reload();
            } else {
                // Error handling
                if (response.errors) {
                    // Show validation errors
                    $.each(response.errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#error-' + key).text(value);
                    });
                } else {
                    alert(response.message);
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan pada server');
        }
    });

    $(document).ready(function() {
        // Form submission handler for barang masuk
        $(document).on('submit', '#form-tambah-barang', function(e) {
            e.preventDefault();
            
            // Get form data properly
            let formData = $(this).serialize();
    
            $.ajax({
                url: '/admin/barangmasuk/simpan_detilbarang',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('.btn-simpan').prop('disabled', true)
                        .html('<i class="spinner-border spinner-border-sm"></i> Processing...');
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.psn,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Clear form
                            $('#form-tambah-barang')[0].reset();
                            // Refresh temp table
                            data_temp();
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {
                                $('[name="' + key + '"]').addClass('is-invalid');
                                $('[name="' + key + '"]').siblings('.invalid-feedback').text(value);
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
                    $('.btn-simpan').prop('disabled', false)
                        .html('<i class="bi bi-save"></i> Simpan');
                }
            });
        });
    
        // Add item handler
        $('#add-itemTemp').on('click', function() {
            let formData = {
                noFaktur: $('#no_input-faktur').val(),
                supplier: $('#supplier').val(),
                kodeBarangInput: $('#kode_brg_input').val(),
                jumlahBarangInput: $('#jumlah_brg_input').val(),
                hpp: $('#hpp').val()
            };
    
            // Validate required fields
            if (!formData.noFaktur) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nomor Faktur harus diisi'
                });
                return;
            }
    
            $.ajax({
                url: '/admin/barangmasuk/simpan_detilbarang',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // Clear inputs and refresh table
                        kosongkan();
                        data_temp();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.psn,
                            timer: 1500,
                            showConfirmButton: false
                        });
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
    
        // Helper functions
        function kosongkan() {
            $('#kode_brg_input').val('');
            $('#nama_brg_input').val('');
            $('#jumlah_brg_input').val('');
            $('#hpp').val('');
        }
    
        function data_temp() {
            let noFaktur = $('#no_input-faktur').val();
            $.ajax({
                url: '/admin/barangmasuk/datatemp',
                type: 'POST',
                data: { noFaktur: noFaktur },
                dataType: 'json',
                success: function(response) {
                    $('.divbarangmasuk').html(response);
                }
            });
        }
    });

    // Add this after existing barangmasuk scripts
    $('#hpp').on('change', function() {
        let currentPrice = $(this).data('original-price');
        let newPrice = $(this).val();
        
        if (currentPrice && currentPrice != newPrice) {
            console.log('Price changed from ' + currentPrice + ' to ' + newPrice);
        }
    });

    // Modify the existing add-itemTemp click handler
    $("#add-itemTemp").click(function() {
        let noFaktur = $("#no_input-faktur").val();
        let supplier = $("#supplier").val();
        let kodeBarangInput = $("#kode_brg_input").val();
        let jumlahBarangInput = $("#jumlah_brg_input").val();
        let hpp = $("#hpp").val();

        // Validation checks...
        if (!noFaktur || !supplier || !kodeBarangInput || !jumlahBarangInput || !hpp) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua field harus diisi'
            });
            return;
        }

        $.ajax({
            url: "/admin/barangmasuk/simpan_detilbarang",
            data: {
                noFaktur: noFaktur,
                supplier: supplier,
                kodeBarangInput: kodeBarangInput,
                jumlahBarangInput: jumlahBarangInput,
                hpp: hpp
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    data_temp();
                    kosongkan();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: responds.psn
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: responds.psn
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

    // Add this after existing barangkeluar scripts
    $("#kode_brg_keluar").on('change', function() {
        let kodeBarang = $(this).val();
        
        $.ajax({
            url: '/admin/barangkeluar/detilbarang',
            type: 'POST',
            data: { kodeBarang: kodeBarang },
            dataType: 'json',
            success: function(response) {
                if (response.data) {
                    // Set name and price automatically
                    $('#nama_brg_keluar').val(response.data.nama);
                    $('#hrg').val(response.data.harga);
                    $('#stock_tersedia').val(response.data.stock);
                    
                    console.log('Data loaded:', {
                        name: response.data.nama,
                        price: response.data.harga,
                        stock: response.data.stock
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Clear fields on error
                $('#nama_brg_keluar').val('');
                $('#hrg').val('');
                $('#stock_tersedia').val('');
            }
        });
    });

    // Also update the search button handler
    $(".btn-cari-item-keluar").on('click', function() {
        let kodeBarang = $("#kode_brg_keluar").val();
        if (kodeBarang) {
            $("#kode_brg_keluar").trigger('change');
        }
    });
</script>