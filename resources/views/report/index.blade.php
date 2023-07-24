@extends('layout.cms')


@section('pageName')
    Satış Listele
@endsection


@section('extraCss')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section("content")

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Rapor Görüntüle</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/report') }}" method="GET" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tarih Aralığı:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input name="begin" type="date" class="form-control datetimepicker-input"
                               data-target="#reservationdate" id="beginInput" value="{{$startDate}}">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        &nbsp;
                        <input name="end" type="date" class="form-control datetimepicker-input"
                               data-target="#reservationdate" id="endInput" value="{{$endDate}}">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">RAPORU AL</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        Alışlar
                    </div>
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Tarih</th>
                            <th>Tutar</th>
                            <th>Adet</th>
                            <th>Ücret</th>
                            <th>Toplam</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stockDatas as $data)
                            <tr>
                                <td>
                                    {{$data->created_at}}
                                </td>
                                <td>
                                    {{($data->product->name)}} ₺
                                </td>
                                <td>
                                    {{($data->quantity)}} ₺
                                </td>
                                <td>
                                    {{($data->price)}} ₺
                                </td>
                                <td>
                                    {{number_format($data->quantity*$data->price,2)}} ₺
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">Satışlar

                    </div>
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Tarih</th>
                            <th>Tutar</th>
                            <th>Müşteri</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($saleDatas as $data)
                            <tr>
                                <td>
                                    {{$data->date}}
                                </td>
                                <td>
                                    {{number_format($data->total->total,2)}} ₺
                                </td>
                                <td>{{$data->customer->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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
