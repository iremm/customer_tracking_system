@extends('rell.master-login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="container" id="container">
    <!---Cusomer Login Form--->
    <div class="form-container sign-up-container">
        <form id="login-form-customer">
            @csrf
            <h1>Customer</h1>
            <span>Welcome customer. Enter Your Information</span>
            <input type="email_customer" id="email_login_customer" placeholder="Email" required />
            <input type="password_customer" id="password_login_customer" placeholder="Password" required />
            <button type="submit_customer">Sign In</button>
        </form>
    </div>
    <!---Admin Login Form--->
    <div class="form-container sign-in-container">
        <form id="login-form-admin">
            <h1>Admin</h1>
            <span>Welcome admin. Enter Your Information</span>
            <input type="email_admin" id="email_login_admin" placeholder="Email" required />
            <input type="password_admin" id="password_login_admin" placeholder="Password" required />
            <button type="submit_Admin">Sign In</button>
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
