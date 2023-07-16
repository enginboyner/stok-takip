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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Müşteri Bilgisi::</h3>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">

                            <div style="text-align: center" class="widget-user-header bg-warning">
                                <h4 class="widget-user-username">Müşteri:<b>{{$customer->name}}</b></h4>
                                <h4 class="widget-user-desc">Telefon:<b>{{$customer->phone}}</b></h4>
                                <h4 class="widget-user-desc">Adres:<b>{{$customer->address}}</b></h4>
                                <h4 class="widget-user-desc">Mail:<b>{{$customer->mail}}</b></h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Satış Tarihi</th>
                                    <th>Satış Tutarı</th>
                                    <th>Detay</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->sales as $sale)
                                    <tr>
                                        <td>
                                            {{$sale->date}}
                                        </td>
                                        <td>
                                            {{$sale->total->total}}
                                        </td>
                                        <td>
                                            <button class="btn btn-info"  onclick="items({{$sale->id}})">
                                                Göster
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1"
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Satış
                                                Bilgisi:</h3>
                                        </div>
                                        <!-- /.card-header -->


                                        <div class="card-body">
                                            <table id="example1"
                                                   class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Ürün</th>
                                                    <th>Adet</th>
                                                    <th>Fiyat</th>
                                                </tr>
                                                </thead>
                                                <tbody id="modalBody">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
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

                function items(saleId){
                    $.ajax({
                        url: '/sales/get-sale-items/'+saleId,
                        type: 'GET',
                        data: {
                            sale_id: saleId
                        },
                        success: function(response) {

                            var html="";
                            for (let i = 0; i < response.length; i++) {
                                html +="<tr>"
                                html +="<td>"
                                html +=response[i].product.name
                                html +="</td>"
                                html +="<td>"
                                html +=response[i].quantity
                                html +="</td>"
                                html +="<td>"
                                html +=response[i].price
                                html +="</td>"
                                html +="</tr>"
                            }
                            $("#modalBody").html(html)
                            $("#exampleModal").modal("show")

                        },
                        error: function(xhr) {
                            console.log('Hata kodu: ' + xhr.status);
                        }
                    });
                }

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
