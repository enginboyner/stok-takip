@extends('layout.cms')


@section('pageName')
    Stok Ekle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Stok Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ url('stock/add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="product">Ürün:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach($products as $product)
                                @if($product->status==true)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="miktar">Miktar:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Fiyat:</label>
                        <input type="decimal" class="form-control" id="price" name="price" placeholder="">
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
