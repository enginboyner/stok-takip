@extends('layout.cms')


@section('pageName')
Müşteri Listele
@endsection


@section('extraCss')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section("content")

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Müşteri Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>İsim</th>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>Mail</th>
                                    <th>Durum</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers->sortByDesc('id') as $customer)
                                    <tr>
                                        <td><a href="{{ route('customer.edit', ['id' => $customer->id]) }}"><i class="fa fa-edit"></i></a> {{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->mail }}</td>
                                        <td> @if($customer->status == 0)
                                                Pasif
                                            @elseif($customer->status == 1)
                                                Aktif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                    @endsection
                    @section("script")

                        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
                        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
                        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

                        <script>

    $(function () {
        fetch('assets/dataTablesCeviri.txt')
            .then(response => response.json())
            .then(ceviri => {
                $("#example1").DataTable({
                    language: ceviri,
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    ordering: false,
                    buttons: ["csv", "excel", "pdf", "colvis"],
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

        $('#example2').DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });


</script>


@endsection
