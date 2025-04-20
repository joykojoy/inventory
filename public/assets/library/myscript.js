// edit user
    $(".btn-edit-user").on("click", function() {
        let username = $(this).data("username");
        $.ajax({
            url: "/admin/manuser/edit",
            method: "post",
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
            dataType: "json",
            success: function(responds) {
                console.log(responds)
                // if (responds.status) {
                //     window.location.href = "/user/cuti";
                // } else {
                //     $.each(responds.errors, function(key, value) {
                //         $('[name="' + key + '"]').addClass('is-invalid')
                //         $('[name="' + key + '"]').next().text(value)
                //         if (value == "") {
                //             $('[name="' + key + '"]').removeClass('is-invalid')
                //             $('[name="' + key + '"]').addClass('is-valid')
                //         }
                //     })
                // }
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