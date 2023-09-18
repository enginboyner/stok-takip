@extends('layout.cms')


@section('pageName')
    Kategori Ekle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kategori Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ url('category/add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name">
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


