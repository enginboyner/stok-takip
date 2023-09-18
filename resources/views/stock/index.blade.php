@extends('layout.cms')


@section('pageName')
    Stok Listele
@endsection


@section('extraCss')

@endsection

@section("content")

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stok Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>Ürün</th>
                                    <th>Miktar</th>
                                    <th>Fiyat</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stocks->sortByDesc('id') as $stock)
                                    @if($stock->status==true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('stock.edit', $stock->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                    <a href="#" onclick="showConfirmation({{ $stock->id }}, '/stock/')"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $product[$stock->product_id] }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->price }} ₺</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
@endsection
