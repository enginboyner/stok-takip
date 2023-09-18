@extends('layout.cms')


@section('pageName')
    Satış Listele
@endsection


@section('extraCss')

@endsection

@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kullanıcı Bilgisi:</h3>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">

                            <div style="text-align: center" class="widget-user-header bg-warning">
                                <h4 class="widget-user-username">İsim:<b>{{$user->name}}</b></h4>
                                <h4 class="widget-user-desc">Rol:<b>{{$user->role->name}}</b></h4>
                                <h4 class="widget-user-desc">Mail:<b>{{$user->mail}}</b></h4>
                            </div>
                            <div class="row">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>İşlemelr</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
