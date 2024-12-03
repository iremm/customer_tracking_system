@extends('rell.master')

@section('content')
<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>İsim</th>
                        <th>Soyisim</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Şirket Adı</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                @endforeach
</tbody>
@endsection
