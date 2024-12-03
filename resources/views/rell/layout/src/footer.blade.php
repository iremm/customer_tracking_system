<footer class="footer">
    <div class="icons">
        
    </div>
    <p>&copy; 2024 Your Customer Tracking System.</p>
</footer>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
<script>

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () =>
container.classList.add('right-panel-active'));

signInButton.addEventListener('click', () =>
container.classList.remove('right-panel-active'));


function show() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

///Admin Login Form submit event
document.getElementById('login-form-admin').addEventListener('submit', function(event) {
    event.preventDefault();
        event.preventDefault();

        var userData = {
            email: $('#email_login_admin').val(),
            password: $('#password_login_admin').val(),
            role: 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            type: "POST",
            url: "/login-admin",
            data: userData,
            success: function(response) {
                Swal.fire({
                    title: 'Giriş Onaylandı',
                    text: response.message,
                    icon: 'success'
                }).then(function() {
                    window.location.href = '/admin/homepage';
                });
            },
            error: function(error) {
                var errorMessage = error.responseJSON.message || 'Giriş Başarısız';
                Swal.fire({
                    title: 'Giriş Başarısız',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        });
   
});



///Customer Login Form submit event
document.getElementById('login-form-customer').addEventListener('submit', function(event) {
    event.preventDefault();

    var userData = {
        email: $('#email_login_customer').val(),
        password: $('#password_login_customer').val(),
        role: 2,
        _token: "{{ csrf_token() }}"
    };

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "/login-customer",
        data: userData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .done(function(response) {
        if (response.status) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Yeni kullanıcı oluşturdu admin onayı bekleyiniz.'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Kullanıcı oluşturulamadı. Admin ile iletişime geçiniz.',
                footer: 'Please check the form and try again.'
            });
        }
    })
    .fail(function(error) {
        var errorMessage = 'Something went wrong. Please try again later.';
        if (error.responseJSON && error.responseJSON.errors) {
            errorMessage = '';
            $.each(error.responseJSON.errors, function(key, value) {
                errorMessage += value[0] + '<br>';
            });
        } else if (error.responseJSON && error.responseJSON.message) {
            errorMessage = error.responseJSON.message;
        }
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: errorMessage,
            footer: 'Please check the form and try again.'
        });
    });
});

</script>
