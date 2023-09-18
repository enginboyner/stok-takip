@extends('layout.cms')


@section('pageName')
    Müşteri Listele
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
                            <h3 class="card-title">Müşteri Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>İsim</th>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>Mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers->sortByDesc('id') as $customer)
                                    @if($customer->status==true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('customer.edit', $customer->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                    <a href=" {{route('customer.show', $customer->id)}} "
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                        Göster
                                                    </a>
                                                    <a href="#"
                                                       onclick="showConfirmation({{ $customer->id }}, '/customers/')"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->mail }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
@endsection
