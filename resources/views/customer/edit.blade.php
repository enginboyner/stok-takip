@extends('layout.cms')


@section('pageName')
Müşteri Düzenle
@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Müşteri Düzenleme Formu</h3>
            </div>
            <form id="form" action="{{ route('customer.update', $customerEdit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="urunAdi">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$customerEdit->name}}">
                    </div>
                    <div class="form-group">
                        <label for="miktar">Telefon:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$customerEdit->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="fiyat">Adres:</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$customerEdit->address}}">
                    </div>
                    <div class="form-group">
                        <label for="satici">Mail:</label>
                        <input type="email" class="form-control" id="mail" name="mail" value="{{$customerEdit->mail}}">
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
