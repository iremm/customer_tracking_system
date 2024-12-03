<script>
$(document).ready(function() {
    $('#customersTable').DataTable(); 
    
});
$('#adminsTable').on('input', 'input', function() {
    $('#saveChangesBtn').show();
});
$(document).ready(function() {
    var table = $('#adminsTable').DataTable();
    var updatedData = []; 

    $('.editable').on('click', function() {
        var currentText = $(this).text();
        var field = $(this).data('field');

        $(this).html('<input type="text" class="form-control" value="' + currentText + '" data-field="'+ field +'">');
        $(this).find('input').focus();
    });

    $('#adminsTable').on('input', 'input', function() {
        $('#saveChangesBtn').show();
    });

    $('#saveChangesBtn').on('click', function() {
    var updatedData = [];  

    $('#adminsTable .editable').each(function() {
        var inputField = $(this).find('input');
        if (inputField.length > 0) {  
            var newValue = inputField.val();
            var originalValue = $(this).text(); 

            if (newValue !== originalValue) {
                updatedData.push({
                    id: $(this).closest('tr').data('id'),
                    field: $(this).data('field'),
                    value: newValue
                });
            }
        }
    });
    if (updatedData.length > 0) {
        $.ajax({
            url: '/save-changes', 
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                changes: updatedData
            },
            success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Customer changed',
                                response.message,
                                'success'
                            );
                            row.remove(); 
                        } else {
                            Swal.fire(
                                'Customer change error',
                                response.message,
                                'error'
                            );
                        }
                    },
        });
    }
    updatedData = [];
});

});
$(document).ready(function() {
    $('#adminsTable').on('click', '.delete-btn', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');

        Swal.fire({
            title: 'Silmek istediğinizden emin misiniz?',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Hayır, iptal et',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/delete-customer',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}", 
                        id: id 
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Silindi!',
                                response.message,
                                'success'
                            );
                            row.remove(); 
                        } else {
                            Swal.fire(
                                'Başarısız!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Hata!',
                            'Bir hata oluştu, kaydınız silinemedi.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});



</script>
