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
                            <h3 class="card-title">Satış Bilgisi:</h3>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">

                            <div style="text-align: center" class="widget-user-header bg-warning">
                                <h4 class="widget-user-username">Müşteri:<b>{{$sale->customer->name}}</b></h4>
                                <h4 class="widget-user-desc">Satış Tarihi:<b>{{$sale->date}}</b></h4>
                            </div>
                            <div class="row">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Görsel</th>
                                        <th>Ürün</th>
                                        <th>Satış Adeti</th>
                                        <th>Satış Fiyatı</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sale->items as $item)
                                        <tr>
                                            <td><img src="{{url('storage/'.$item->product->image)}}" alt="" title=""
                                                     width="100"/></td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
