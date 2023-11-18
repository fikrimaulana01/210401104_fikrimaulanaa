@extends('layouts.master')
@section('li-categories', 'active')
@section('addCss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css"
        integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
@endsection
@section('title', 'Create Categories')
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('store-categories') }}">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp"
                        placeholder="Enter Category" required autocomplete="off" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Slug Url</label>
                    <input type="text" class="form-control" id="url" placeholder="Slug URL" required
                        autocomplete="off" name="url" readonly>
                    @error('url')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"
            integrity="sha256-IW9RTty6djbi3+dyypxajC14pE6ZrP53DLfY9w40Xn4=" crossorigin="anonymous"></script>
        <script>
            Swal.fire({
                title: "Failed",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
@endsection
@section('addJs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var namaInput = document.getElementById("nama");
            var urlInput = document.getElementById("url");

            namaInput.addEventListener("input", function() {
                var slug = slugify(namaInput.value);
                urlInput.value = slug;
            });

            function slugify(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text
            }
        });
    </script>

@endsection
