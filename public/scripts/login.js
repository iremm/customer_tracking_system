
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('main_container');

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

// Form submit olduğunda çağrılacak fonksiyon
function submitForm() {
    // Form verilerini al
    var userData = {
        name: $('#name').val(),
        surname: $('#surname').val(),
        email: $('#email').val(),
        password: $('#myInput').val(),
        _token: "{{ csrf_token() }}"
    };
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST", // Veriyi gönderme yöntemi (POST)
        url: "/register", // Backend tarafındaki işlemi yapacak URL
        data: userData, // Gönderilecek veriler
        headers: {
            'X-CSRF-TOKEN': csrfToken // CSRF token'ını başlık olarak ekleyin
        }
    })
    .done(function(response) {
        // Başarılı bir şekilde cevap alındığında ne yapılacağı
        if (response.status == true) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message
            }).then(function() {
                // Yönlendirme işlemi
                window.location.href = '/admin/homepage';
            });
        }
    })
    .fail(function(error) {
        // Hata durumunda ne yapılacağı
        var errorMessage = 'Something went wrong. Please try again later.';
        if (error.responseJSON && error.responseJSON.errors) {
            errorMessage = '';
            $.each(error.responseJSON.errors, function(key, value) {
                errorMessage += value[0] + '<br>';
            });
        }
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: errorMessage,
            footer: 'Please check the form and try again.'
        });
    });
}

/* // Sayfa yüklendiğinde CSRF token'ı al ve form submit olduğunda submitForm fonksiyonunu çağır
$(document).ready(function() {
    $('form').submit(function(event) {
        event.preventDefault();
        submitForm();
    });
});
 */

 $(document).ready(function() {
    $('#login-form').on('submit', function(event) {
        event.preventDefault(); // Formun varsayılan submit davranışını engelle

        var userData = {
            email: $('#email_login').val(),
            password: $('#password_login').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        // AJAX isteği gönder
        $.ajax({
            type: "POST", // Veriyi gönderme yöntemi (POST)
            url: "/login", // Backend tarafındaki işlemi yapacak URL
            data: userData, // Gönderilecek veriler
            success: function(response) {
                // Başarılı giriş yapıldığında Swal kullanarak bildirim göster
                Swal.fire({
                    title: 'Giriş Onaylandı',
                    text: response.message,
                    icon: 'success'
                }).then(function() {
                    // Bildirim kapatıldığında anasayfaya yönlendir
                    window.location.href = '/admin/homepage';
                });
            },
            error: function(error) {
                // Giriş hatası olduğunda Swal kullanarak hata bildirimini göster
                var errorMessage = error.responseJSON.message || 'Giriş Başarısız';
                Swal.fire({
                    title: 'Giriş Başarısız',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        });
    });
});




document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Formun varsayılan gönderim işlemini durdurur

    var userData = {
        name: $('#name').val(),
        surname: $('#surname').val(),
        email: $('#email').val(),
        password: $('#myInput').val(),
        _token: "{{ csrf_token() }}"
    };

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "/register",
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