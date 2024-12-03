@extends('rell.master')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">İsim</th>
            <th scope="col">Soyisim</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->surname }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->company_name }}</td>
                </tr>
                @endforeach
            
        </tbody>
    </table>
</div>
@endsection
