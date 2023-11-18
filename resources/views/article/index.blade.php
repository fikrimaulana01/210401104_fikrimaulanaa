@extends('layouts.master')
@section('li-article', 'active')
@section('addCss')
    <link href="{{ asset('RuangAdmin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css"
        integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">

@endsection
@section('title', 'Article')
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Article</h6>
            <a href="{{ route('create-article') }}" class="btn btn-primary">Create Article</a>
        </div>
    </div>
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-md-4 mb-3 col-12">
                <div class="card h-100">
                    <div class="rounded produk-img"
                        style="
                        height: 240px;
                    width: 100%; /* Sesuaikan dengan lebar yang Anda inginkan */
                    background-image: url('{{ asset('article_images')."/". $article->thumbnail }}'); /* Ganti dengan path gambar yang sesuai */
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: 50%;">
                    </div>
                    <div class="card-body">
                        <h5 class="text-primary"><b>{{ $article->title }}</b></h5>
                        <div>
                            <span class="d-block text-body-secondary">Dibuat Oleh: {{ $article->author->name }}</span>
                            <span class="d-block text-body-secondary">Kategori {{ $article->category->name }}</span>
                            <span class="d-block text-body-secondary">{{ $article->created_at }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex ">
                            <div class="mr-2"><a href="{{ route('view-article', $article->url)}}" class="btn btn-primary">View</a></div>
                            <div class="mr-2"><a href="/article/edit/{{ $article->id }}" class="btn btn-warning">Edit</a></div>
                            <div>
                                <form action="{{ route('articles-destroy', $article->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger text-white">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
@section('addJs')
    <script src="{{ asset('RuangAdmin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('RuangAdmin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"
        integrity="sha256-IW9RTty6djbi3+dyypxajC14pE6ZrP53DLfY9w40Xn4=" crossorigin="anonymous"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });

        window.confirmDelete = function(formId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        };
    </script>
@endsection
