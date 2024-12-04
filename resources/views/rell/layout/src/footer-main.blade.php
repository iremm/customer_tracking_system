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


$(document).ready(function () {
    const table = $('#adminsTable').DataTable();

    $('#newUser').on('click', function () {
        Swal.fire({
            title: 'Yeni Kullanıcı Ekle',
            html: `
                <form id="newUserForm">
                    <div class="form-group">
                        <label for="name">İsim</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="İsim">
                    </div>
                    <div class="form-group">
                        <label for="surname">Soyisim</label>
                        <input type="text" id="surname" name="surname" class="form-control" placeholder="Soyisim">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefon">
                    </div>
                    <div class="form-group">
                        <label for="company_name">Şirket Adı</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Şirket Adı">
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Ekle',
            cancelButtonText: 'İptal',
            preConfirm: () => {
                return {
                    name: $('#name').val(),
                    surname: $('#surname').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    company_name: $('#company_name').val()
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/add-user',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}", 
                        ...result.value 
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire('Başarılı!', response.message, 'success');

                            table.row.add([
                                result.value.name,
                                result.value.surname,
                                result.value.email,
                                result.value.phone,
                                result.value.company_name,
                                new Date().toLocaleString()
                            ]).draw(false);
                        } else {
                            Swal.fire('Başarısız!', response.message, 'error');
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Hata!', 'Bir hata oluştu.', 'error');
                    }
                });
            }
        });
    });
});

//save excel script
$(document).ready(function () {
    $('#saveExcel').on('click', function () {
        Swal.fire({
            title: 'Excel Dosyası Yükle',
            html: `
                <form id="excelUploadForm">
                    <div class="form-group">
                        <label for="excelFile">Excel Dosyası:</label>
                        <input type="file" id="excelFile" name="excelFile" class="form-control" accept=".xls,.xlsx">
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Yükle',
            cancelButtonText: 'İptal',
            preConfirm: () => {
                const fileInput = document.getElementById('excelFile');
                const file = fileInput.files[0];
                
                if (!file) {
                    Swal.showValidationMessage('Lütfen bir dosya seçin.');
                    return false;
                }

                // Dosya formatı kontrolü
                const validExtensions = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
                const validExtensionsRegex = /\.(xls|xlsx)$/i;

                if (!validExtensions.includes(file.type) && !validExtensionsRegex.test(file.name)) {
                    Swal.showValidationMessage('Lütfen sadece Excel formatında bir dosya yükleyin (.xls, .xlsx).');
                    return false;
                }

                return file;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('excelFile', result.value);
                formData.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: '/upload-excel',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire('Başarılı!', response.message, 'success');
                        } else {
                            Swal.fire('Hata!', response.message, 'error');
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Hata!', 'Bir hata oluştu.', 'error');
                    }
                });
            }
        });
    });
});


</script>
