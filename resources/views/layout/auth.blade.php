<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageName')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet"
          href="{{ asset('assets/css/adminlte.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
</head>
<body class="hold-transition login-page">
@yield("content")
<!-- /.login-box -->

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script>
    $('#form').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
            type: this.method,
            url: this.action,
            data: $('#form').serialize(),
            success: function (data) {
                console.log(data)
                $("#response").html(data.message)
                setTimeout(function () {
                    window.location.replace(data.redirect);
                }, 1000);
            },
            error: function (data) {
                console.log(data)
                $("#response").html(data.responseJSON.message)

            }
        });


    });

</script>
@yield("script")

</body>
</html>




