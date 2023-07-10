@extends('layout.cms')


@section('pageName')
Kullanıcı Ekle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kullanıcı Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ url('user/add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- form alanları -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="kullaniciAdi">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Mail:</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Şifre:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="product">Rol:</label>
                        <select class="form-control" id="role_id" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Durum:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">Pasif</option>
                            <option value="1">Aktif</option>
                        </select>
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
