@extends('layout.cms')


@section('pageName')
Ürün Listele
@endsection


@section('extraCss')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section("content")

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ürün Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>İşlemler</th>
                                    <th>İsim</th>
                                    <th>Kategori</th>
                                    <th>Açıklama</th>
                                    <th>Durum</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products->sortByDesc('id') as $product)
                                    @if($product->status==true)
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <a href="{{ route('product.edit', $product->id) }}" style="flex: 1;">
                                                        <button class="btn btn-info btn-sm" title="Düzenle">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#">
                                                        <button type="button" onclick="showConfirmation({{ $product->id }})" class="btn btn-danger btn-sm" title="Sil">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $category[$product->category_id] }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                @if($product->status == 0)
                                                    Pasif
                                                @elseif($product->status == 1)
                                                    Aktif
                                                @endif
                                            </td>
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
                    @section("script")


                        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
                        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
                        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
                        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
                        <script
                            src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>


                        <script>

                            function showConfirmation(DeleteID) {

                                Swal.fire({
                                    title: 'Silmek istediğinize emin misiniz?',
                                    text: "",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sil',
                                    cancelButtonText: 'İptal Et',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: '/product/' + DeleteID,
                                            type: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function(result) {
                                                Swal.fire(
                                                    'Silindi!',
                                                    '',
                                                    'success'
                                                );
                                                location.reload();
                                                },
                                            error: function(xhr, status, error) {
                                                Swal.fire(
                                                    'Hata',
                                                    '',
                                                    'error'
                                                );
                                            }
                                        });
                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                       Swal.fire(
                                            'İptal Edildi',
                                            '',
                                            'error'
                                        );
                                    }
                                });
                            }
                        </script>


                        <script>

                            $(function () {
                                fetch('assets/dataTablesCeviri.txt')
                                    .then(response => response.json())
                                    .then(ceviri => {
                                        $("#example1").DataTable({
                                            language: ceviri,
                                            responsive: true,
                                            lengthChange: false,
                                            autoWidth: false,
                                            ordering: false,
                                            buttons: ["csv", "excel", "pdf", "colvis"],
                                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                    });

                                $('#example2').DataTable({
                                    paging: true,
                                    lengthChange: false,
                                    searching: true,
                                    ordering: false,
                                    info: true,
                                    autoWidth: false,
                                    responsive: true,
                                });
                            });


                        </script>

@endsection
