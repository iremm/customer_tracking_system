@extends('rell.master') <!-- master.blade.php dosyasını kullanıyoruz -->

@section('title', 'DataTables.js Örneği') <!-- Sayfa başlığı -->

@section('content') <!-- Sayfa içeriği -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Pozisyon</th>
                <th>Ofis</th>
                <th>Yaş</th>
                <th>Başlangıç Tarihi</th>
                <th>Maaş</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
        </tbody>
    </table>
@endsection

@push('scripts') <!-- Sayfaya özgü JavaScript -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endpush
