@extends('layout.cms')


@section('pageName')
    Kategori Listele
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
                            <h3 class="card-title">Kategori Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>Kategori</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category->sortByDesc('id') as $categories)
                                    @if($categories->status==true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('category.edit', $categories->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                    <a href=" {{route('category.show', $categories->id)}} "
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                        Göster
                                                    </a>
                                                    <a href="#"
                                                       onclick="showConfirmation({{ $categories->id }}, '/category/')"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $categories->name }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
