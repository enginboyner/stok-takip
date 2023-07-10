@extends('layout.cms')


@section('pageName')
Satış Ekle
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
                        <label for="product">Ürün:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="miktar">Miktar:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Fiyat:</label>
                        <input type="decimal" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="seller">Satıcı:</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customer">Müşteri:</label>
                        <select class="form-control" id="customer_id" name="customer_id">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tarih">Satış Tarihi:</label>
                        <input type="date" class="form-control" id="date" name="date">
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
