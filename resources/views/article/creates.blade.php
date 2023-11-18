@extends('layouts.master')
@section('li-article', 'active')
@section('addCss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css"
        integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            height: 400px;
        }
    </style>
@endsection
@section('title', 'Create Article')
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('store-article') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                        placeholder="Enter Title" required autocomplete="off" name="title">
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

                <div class="form-group">
                    <label for="author_id">Id Author</label>
                    <input type="text" class="form-control" id="author_id" placeholder="Author Id" required
                        autocomplete="off" name="author_id" readonly value="{{ $currentAuthor->id }}">
                    @error('author_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" accept="image/*" name="thumbnail" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor">Content</label>
                    <textarea type="text" class="form-control" id="editor" required autocomplete="off" name="editor" readonly></textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        // Ganti <textarea> dengan CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var namaInput = document.getElementById("title");
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
