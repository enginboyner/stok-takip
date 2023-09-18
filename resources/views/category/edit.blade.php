@extends('layout.cms')

@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kategori Düzenleme Formu</h3>
            </div>
            <form id="form" action="{{ route('category.update', $categoryEdit->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$categoryEdit->name}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="far fa-sync sm"></i> DÜZENLE</button>
                </div>
            </form>
            <div id="response"></div>
        </div>
    </div>
@endsection


