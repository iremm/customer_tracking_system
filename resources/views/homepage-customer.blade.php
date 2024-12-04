@extends('rell.master-main')

@section('content')

<!-- Başlık Ekleme -->
<div class="container">
    <h2 class="text-center mb-4">Müşteri Görüntüleme Sistemi</h2> <!-- Başlık buraya eklendi -->
</div>

<div class="container p-5">
    <div class="row"> 
        <div class="col-12"> 
            <table id="adminsTable" class="table table-striped">
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
    </div>
</div>

@endsection

