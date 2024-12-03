@extends('rell.master-main')

@section('content')

<div class="container">
    <h2 class="text-center mb-4">Müşteri Görüntüleme Sistemi</h2>
</div>

<div class="container p-5">
    <div class="row">
        <div class="col-12">
            <button id="saveExcel" class="btn btn-success mt-3">Excel ekle</button>
            <button id="saveChangesBtn" class="btn btn-success mt-3" style="display:none;">Değişiklikleri Kaydet</button>
       
        </div>
    </div>
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
                    <tr data-id="{{ $customer->id }}">
                        <td class="editable" data-field="name">{{ $customer->name }}</td>
                        <td class="editable" data-field="surname">{{ $customer->surname }}</td>
                        <td class="editable" data-field="email">{{ $customer->email }}</td>
                        <td class="editable" data-field="phone">{{ $customer->phone }}</td>
                        <td class="editable" data-field="company_name">{{ $customer->company_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
