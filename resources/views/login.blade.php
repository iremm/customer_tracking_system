@extends('rell.master')

@section('content')
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form id="register-form">
            @csrf
            <h1>Customer</h1>
            <span>Welcome customer. Enter Your Information</span>
            <input type="email" id="email_login" placeholder="Email" required />
            <input type="password" id="password_login" placeholder="Password" required />
            <button type="submit">Sign In</button>
        </form>
    </div>

    <div class="form-container sign-in-container">
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
@endsection
