@extends("layout.auth")

@section('pageName')
Giriş
@endsection


@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Stok</b>Takip</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Kullanıcı Girişi</p>

                <form id="form" method="POST" action="{{ route('loginControl') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="mail" type="email" class="form-control" placeholder="Mail">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Şifre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">

                        </div>
                        <!-- /.col -->
                        <div style="margin-bottom: 10px" class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->
                <div class="row">
                    <div class="col-12 text-center"> <!-- Add text-center class to center align the content -->
                        <p class="mb-0">
                            <a href="forget" class="text-center">Şifremi Unuttum</a>
                        </p>
                        <div id="response"></div>
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection

