@extends('back.layouts.master')

@section('title')
    Haqqımızda
@endsection

@section('css')
    <style>
        #imagePreview {
            max-width: 300px;
            max-height: 300px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="locale" class="form-label">Dil seçin</label>
                                    <select class="form-select mb-3" id="locale" name="locale">
                                        @foreach(config('app.languages') as $locale_code => $locale_name)
                                            <option
                                                value="{{$locale_code}}"
                                                @selected(old('locale', 'az') == $locale_code)
                                            >
                                                {{ $locale_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('locale')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="src" class="form-label">
                                        <img id="imagePreview" src="{{ asset('icons/add-image.png') }}"
                                             style="width: 150px;cursor:pointer;" title="Şəkil seçin" alt="Preview">
                                    </label>
                                    <input type="file" class="form-control d-none
                                    @error('src')
                                       is-invalid
                                    @enderror
                                    " id="src" name="src" accept="image/*">

                                    @error('src')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="alt" class="form-label">Image Alt Text</label>
                                    <input type="text" class="form-control
                                    @error('alt')
                                       is-invalid
                                    @enderror
                                    " id="alt" name="alt" value="{{ old('alt') }}"
                                    >
                                    @error('alt')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Başlıq</label>
                                    <input type="text" class="form-control
                                    @error('title')
                                       is-invalid
                                    @enderror" id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Mətn</label>
                                    <textarea class="form-control
                                    @error('description')
                                       is-invalid
                                    @enderror" id="description" name="description" rows="3"
                                    >{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('description', {
            contentsCss: [
                '{{ asset('assets/css/fonts.css') }}',
                'https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;600;700&display=swap'
            ],
            font_names:
                'Source Serif 4/Source Serif 4;' +
                'DM Sans/DM Sans;Inter/Inter;Nunito/Nunito;Outfit/Outfit;Urbanist/Urbanist;' +
                'Andale Mono/Andale Mono;Arial/Arial;Arial Black/Arial Black;Comic Sans MS/Comic Sans MS;' +
                'Courier New/Courier New;Georgia/Georgia;Impact/Impact;Times New Roman/Times New Roman;' +
                'Trebuchet MS/Trebuchet MS;Verdana/Verdana;',
            extraPlugins: 'liststyle,youtube,font,justify,confighelper,html5audio,pastefromword,filetools,colorbutton,image',

            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserUploadMethod: 'form',
        });
    </script>

    <script>
        document.getElementById('src').addEventListener('change', function (event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.src = '';
                preview.classList.add('d-none');
            }
        });
    </script>
@endsection
