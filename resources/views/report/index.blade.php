@extends('layout.cms')


@section('pageName')
    Satış Listele
@endsection


@section('extraCss')

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