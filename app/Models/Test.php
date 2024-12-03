
<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('static/images/favicon-white-96.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('static/images/favicon-white-192.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<style>

@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
    box-sizing: border-box;
}

body {
    font-family: 'Montserrat', sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h1 {
    font-weight: bold;
    margin: 0;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: .5px;
    margin: 20px 0 30px;
}

span {
    font-size: 12px;
}

a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}

.container {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.form-container form {
    background: #fff;
    display: flex;
    flex-direction: column;
    padding:  0 50px;
    height: 100%;
    justify-content: center;
    align-items: center;
    text-align: center;
}



.form-container input {
    background: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
}

button {
    border-radius: 20px;
    border: 1px solid #ff4b2b;
    background: #323840;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
}

button:active {
    transform: scale(.95);
}

button:focus {
    outline: none;
}

button.ghost {
    background: transparent;
    border-color: #fff;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all .6s ease-in-out;
}

.sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
}

.sign-up-container {
    left: 0;
    width: 50%;
    z-index: 1;
    opacity: 0;
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform .6s ease-in-out;
    z-index: 100;
}

.overlay {
    background: #ff416c;
    background: linear-gradient(to right, #2bffe8, #878787) no-repeat 0 0 / cover;
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateY(0);
    transition: transform .6s ease-in-out;
}

.overlay-panel {
    position: absolute;
    top: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 40px;
    height: 100%;
    width: 50%;
    text-align: center;
    transform: translateY(0);
    transition: transform .6s ease-in-out;
}

.overlay-right {
    right: 0;
    transform: translateY(0);
}

.overlay-left {
    transform: translateY(-20%);
}

/* Move signin to right */
.container.right-panel-active .sign-in-container {
    transform: translateY(100%);
}

/* Move overlay to left */
.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

/* Bring signup over signin */
.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
}

/* Move overlay back to right */
.container.right-panel-active .overlay {
    transform: translateX(50%);
}

/* Bring back the text to center */
.container.right-panel-active .overlay-left {
    transform: translateY(0);
}

/* Same effect for right */
.container.right-panel-active .overlay-right {
    transform: translateY(20%);
}

.footer {
	margin-top: 25px;
	text-align: center;
}


.icons {
	display: flex;
	width: 30px;
	height: 30px;
	letter-spacing: 15px;
	align-items: center;
}

/* ---- reset ---- */ body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #323840; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
</style>
<body>
<div id="particles-js"></div> <!-- stats - count particles -->
 <div class="count-particles"> <span class="js-count-particles"></span>  </div> <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib --> <script src="https://threejs.org/examples/js/libs/stats.min.js"></script>

 <div class="container" id="container">
        <div class="form-container sign-up-container">
        <form id="register-form">
            @csrf
                <h1>Customer</h1>
                <span>Welcome customer. Enter Your Information</span></h1>
            
                <input type="email" id="email_login" placeholder="Email" required />
                <input type="password" id="password_login" placeholder="Password" required />
                <button type="submit">Sign In</button>
        </form>
        </div>
        <div class="form-container sign-in-container">
          <div class="row">
            <div class="col-12">
              sfr
            </div>
          </div>
            <form id="login-form">
                <h1>Admin</h1>
                <span>Welcome admin. Enter Your Information</span>
                <input type="email" id="email_login" placeholder="Email" required />
                <input type="password" id="password_login" placeholder="Password" required />
                <button type="submit">Sign In</button>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Return to admin screen</p>
                    <button class="ghost" id="signIn">Admin Login Screen</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Customer</h1>
                    <p>Continue for customer login</p>
                    <button class="ghost" id="signUp">Customer Login Screen</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
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


</script>