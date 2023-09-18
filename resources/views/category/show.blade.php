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
                            <h3 class="card-title">Kategori Bilgisi:</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div style="text-align: center" class="widget-user-header bg-warning">
                                <h4 class="widget-user-username">Kategori:<b>{{$category->name}}</b></h4>
                            </div>
                            <div class="row">

                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Açıklama</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $productName)
                                        <tr>
                                            <td>
                                                {{$productName->name}}
                                            </td>
                                            <td>
                                                {{$productName->description}}
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
        </div>
@endsection
