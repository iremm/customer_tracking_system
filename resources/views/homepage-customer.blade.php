@extends('rell.master-main')

@section('content')

<div class="container p-5">
    <table id="customersTable" class="table table-striped">
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

@push('scripts')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // DataTable başlatma
            $('#customersTable').DataTable();
        });
    </script>
@endpush
