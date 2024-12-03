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
                $('#saveChangesBtn').hide(); 

               
            },
        });
    }
    updatedData = [];
});

});




</script>
