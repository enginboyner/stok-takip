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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ürün Bilgisi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-header bg-info">
                                <h5 class="card-title text-center" style="text-align: center;">{{$product->name}}</h5>
                            </div>
                            <div style="text-align: center" class="card-body">
                                <img src="{{url('storage/'.$product->image)}}" alt="" title="" width="100"/>
                            </div>
                            <div class="card-footer">
                                <div class="col">
                                    <div class="description-block">
                                        <h5 class="description-header">Kategori</h5>
                                        <span class="description-text">{{$product->category->name}}</span>
                                    </div>
                                </div>
                                <div class="description-block">
                                    <h5 class="description-header">Açıklama</h5>
                                    <span class="description-text">{{$product->description}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                Alışlar
                            </div>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                    <th>Toplam</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->stock as $stock )
                                    <tr>
                                        <td>
                                            {{$stock->quantity}}
                                        </td>
                                        <td>
                                            {{$stock->price}}
                                        </td>
                                        <td>
                                            {{$stock->quantity*$stock->price}}
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
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                    <th>Toplam</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->sales as $sale )
                                    <tr>
                                        <td>
                                            {{$sale->quantity}}
                                        </td>
                                        <td>
                                            {{$sale->price}}
                                        </td>
                                        <td>
                                            {{$sale->quantity*$sale->price}}
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    @if(isset($product->sale->totalSale))
                                        <h3>{{ $product->sale->totalSale }} ₺</h3>
                                    @else
                                        <h3>0</h3>
                                    @endif
                                    <p>Toplam Satış Tutarı</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    @if(isset($product->purchase->totalPurchase))
                                        <h3>{{$product->purchase->totalPurchase}} ₺</h3>
                                    @else
                                        <h3>0</h3>
                                    @endif
                                    <p>Toplam Alış Tutarı</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    @if(empty($product->squantity->stotal))
                                        <h3>0</h3>
                                    @else
                                        <h3>{{$product->squantity->stotal}}</h3>
                                    @endif
                                    <p>Toplam Satış Adeti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ empty($product->pquantity->ptotal) ? '0' : $product->pquantity->ptotal }}</h3>
                                    <p>Toplam Alış Adeti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{ isset($product->pquantity->ptotal) && isset($product->squantity->stotal) ? ($product->pquantity->ptotal) - ($product->squantity->stotal) : 0 }}</h3>
                                    <p>Kalan Stok</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
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
