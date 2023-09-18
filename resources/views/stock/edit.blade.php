@extends('layout.cms')


@section('pageName')
    Stok Düzenle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Stok Düzenleme Formu</h3>
            </div>
            <form id="form" action="{{ route('stock.update', $stockEdit->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">

                    <div class="form-group">
                        <label for="product">Ürün:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach($products as $productEdit2)
                                <option value="{{ $productEdit2->id }}"
                                        @if($productEdit2->id == $stockEdit->product_id) selected @endif>{{ $productEdit2->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="miktar">Miktar:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder=""
                               value="{{$stockEdit->quantity}}">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Fiyat:</label>
                        <input type="decimal" class="form-control" id="price" name="price" placeholder=""
                               value="{{$stockEdit->price}}">
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
