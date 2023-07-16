@extends('layout.cms')


@section('pageName')
Satış Düzenle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Satış Düzenleme Formu</h3>
            </div>
            <form id="form" action="{{ route('sales.update', $salesEdit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="product">Ürün:</label>
                        <select class="form-control" id="product_id[]" name="product_id[]">
                            @foreach($products as $productEdit2)
                                <option value="{{ $productEdit2->id }}" @if($productEdit2->id == $salesEdit->product_id) selected @endif>{{ $productEdit2->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="miktar">Miktar:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity[]" value="{{$salesItem->quantity}}">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Fiyat:</label>
                        <input type="decimal" class="form-control" id="price" name="price[]" value="{{$salesItem->price}}" >
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
                    <button type="submit" class="btn btn-primary"><i class="far fa-sync fa-sm"></i> GÜNCELLE</button>
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
