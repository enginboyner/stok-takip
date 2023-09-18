@extends('layout.cms')


@section('pageName')
    Satış Listele
@endsection


@section('extraCss')

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
                                            <button class="btn btn-info" onclick="items({{$sale->id}})">
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
