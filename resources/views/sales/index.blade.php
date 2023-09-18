@extends('layout.cms')


@section('pageName')
    Satış Listele
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
                            <h3 class="card-title">Satış Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>Müşteri</th>
                                    <th>Tarih</th>
                                    <th>Tutar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    @if($sale->status == true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('sales.edit', $sale->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                    <a href="{{ route('sales.show', $sale->id) }}"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                        Göster
                                                    </a>
                                                    <a href="#" onclick="showConfirmation({{ $sale->id }}, '/sales/')"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $sale->customer->name }}</td>
                                            <td>{{ $sale->date }}</td>
                                            <td>{{ $sale->total->total }} ₺</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection