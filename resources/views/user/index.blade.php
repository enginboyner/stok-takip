@extends('layout.cms')


@section('pageName')
    Kullanıcı Listele
@endsection


@section('extraCss')

@endsection

@section("content")

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kullanıcı Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>İsim</th>
                                    <th>Rol</th>
                                    <th>Mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users->sortByDesc('id') as $user)
                                    @if($user->status==true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('user.edit', $user->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                    <a href=" {{route('user.show', $user->id)}} "
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                        Göster
                                                    </a>
                                                    <a href="#" onclick="showConfirmation({{ $user->id }}, '/user/')"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $roles[$user->role_id] }}</td>
                                            <td>{{ $user->mail}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
@endsection
