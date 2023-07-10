@extends('layout.cms')


@section('pageName')
Satış Düzenle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Satış Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ url('sales/add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$salesEdit->id}}" readonly style="background-color: #e9e9e9;">
                    </div>
                    <div class="form-group">
                        <label for="product">Ürün:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach($products as $productEdit2)
                                <option value="{{ $productEdit2->id }}" @if($productEdit2->id == $salesEdit->product_id) selected @endif>{{ $productEdit2->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="miktar">Miktar:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{$salesEdit->quantity}}">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Fiyat:</label>
                        <input type="decimal" class="form-control" id="price" name="price" value="{{$salesEdit->price}}" >
                    </div>
                    <div class="form-group">
                        <label for="seller">Satıcı:</label>
                        <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $userEdit)
                                <option value="{{ $userEdit->id }}" @if($userEdit->id == $salesEdit->user_id) selected @endif>{{ $userEdit->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customer">Müşteri:</label>
                        <select class="form-control" id="customer_id" name="customer_id">
                            @foreach($customers as $customerEdit)
                                <option value="{{ $customerEdit->id }}" @if($customerEdit->id == $salesEdit->customer_id) selected @endif>{{ $customerEdit->name }}</option>                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tarih">Satış Tarihi:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{$salesEdit->date}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-sm"></i> KAYDET</button>
                </div>
            </form>
            <div id="response"></div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
