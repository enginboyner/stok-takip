@extends('layout.cms')

@section('pageName')
    Ürün Düzenle
@endsection

@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ürün Düzenleme Formu</h3>
            </div>
            <form id="form" action="{{ route('product.update', $productEdit->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">İsim:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$productEdit->name}}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $categoryEdit)
                                <option value="{{ $categoryEdit->id }}"
                                        @if($categoryEdit->id == $productEdit->category_id) selected @endif>{{ $categoryEdit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder=""
                               value="{{$productEdit->description}}">
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
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="col-5 text-center mx-auto">
                                <img src="{{url('storage/'.$productEdit->image)}}" alt="" title="" width="250"/>
                            </div>
                        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.querySelector('.custom-file-input');
            var label = input.nextElementSibling;
            input.addEventListener('change', function (event) {
                var fileName = event.target.files[0].name;
                label.innerText = fileName;
            });
            input.addEventListener('click', function () {
                this.value = null;
                label.innerText = 'Seç';
            });
            // Set default value
            label.innerText = "{{ $productEdit->image }}";
        });
    </script>
@endsection
