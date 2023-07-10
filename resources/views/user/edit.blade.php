@extends('layout.cms')


@section('pageName')
Kullanıcı Düzenle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kullanıcı Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ route('user.update', $userEdit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$userEdit->id}}">
                    </div>
                    <div class="form-group">
                        <label for="kullaniciAdi">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$userEdit->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Mail:</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="" value="{{$userEdit->mail}}">
                    </div>
                    <div class="form-group">
                        <label for="product">Rol:</label>
                        <select class="form-control" id="role_id" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if($role->id == $userEdit->role_id) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Durum:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0" @if($userEdit->status == 0) selected @endif>Pasif</option>
                            <option value="1" @if($userEdit->status == 1) selected @endif>Aktif</option>
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

@section("script")
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
