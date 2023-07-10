@extends("layout.auth")


@section('pageName')
Şifremi Unuttum
@endsection


@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">
                <b>Stok</b>Takip
            </a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Şifremi Unuttum</p>
                <form id="form" action="recover-password.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Yeni Şifre Oluştur</button>
                        </div>

                    </div>
                </form>
                <div id="response"></div>
                <p class="mt-3 mb-1 text-center">
                    <a href="login">Kullanıcı Giriş Ekranına Dön</a>
                </p>
            </div>
        </div>
    </div>
@endsection
