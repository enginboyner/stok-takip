@extends('layout.cms')

@section('pageName')
    Ürün Ekle
@endsection

@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ürün Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ url('product/add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                @if($category->status==true)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Görsel:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Seç</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Yükle</span>
                            </div>
                        </div>
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

