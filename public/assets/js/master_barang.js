$(document).ready(function() {
    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        
        // Get CSRF token
        let csrfName = $('.csrf_token').attr('name');
        let csrfHash = $('.csrf_token').val();
        
        // Convert form data to object
        let formData = $(this).serializeArray();
        let data = {};
        
        $(formData).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        
        // Add CSRF token
        data[csrfName] = csrfHash;
        
        // Ensure numeric fields are properly typed
        data.min = parseInt(data.min || 0);
        
        console.log('Sending data:', data); // Debug logging
        
        $.ajax({
            url: `${base_url}/admin/master_barang/update`,
            type: 'POST',
            data: data,
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                console.log('Response:', response); // Debug logging
                if (response.status) {
                    $('#primary').modal('hide');
                    location.reload();
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            $('[name="' + key + '"]').addClass('is-invalid');
                            $('.error' + key.charAt(0).toUpperCase() + key.slice(1)).html(value);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error details:', {
                    status: xhr.status,
                    error: error,
                    response: xhr.responseText
                });
                alert('Terjadi kesalahan saat mengupdate data');
            }
        });
    });
});