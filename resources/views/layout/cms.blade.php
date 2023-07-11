<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("pageName")</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet"
          href="{{ asset('assets/css/adminlte.min.css') }}">


    @yield('extraCss')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('assets/img/stokTakip.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Stok Takip Sistemi</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/img/login.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="" class="d-block">{{ $userAuth->name }}</a>
                    <br>
                    <a>{{$roleAuth}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tag"></i>
                            <p>

                                Ürünler
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('product.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-money-bill-alt"></i>
                            <p>

                                Satışlar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sales.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sales') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-box"></i>
                            <p>

                                Stoklar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stock.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>

                                Kullanıcılar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>

                                Kategoriler
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-store"></i>
                            <p>

                                Müşteriler
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('customer.add') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-plus"></i>
                                    <p style="font-size: 13px;">Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer') }}" class="nav-link">
                                    <i style="font-size: 13px;" class="fas fa-bars"></i>
                                    <p style="font-size: 13px;">Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>
                                ÇIKIŞ YAP
                            </p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @yield("content")

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer" style="text-align: center;">
        <strong>Stok Takip Sistemi</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $('#form').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: this.method,
            url: this.action,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $("#response").html(data.message);
                setTimeout(function () {
                    window.location.replace(data.redirect);
                }, 150);
            },
            error: function (data) {
                console.log(data);
                $("#response").html(data.responseJSON.message);
            }
        });
    });

</script>
@yield("script")
</body>
</html>
