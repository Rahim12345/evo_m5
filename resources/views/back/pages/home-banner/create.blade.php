@extends('back.layouts.master')

@section('title')
    Create Home Banner
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
                        <form action="{{ route('home-banner.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="src" class="form-label">Banner Image</label>
                                    <input type="file" class="form-control
                                    @error('src')
                                       is-invalid
                                    @enderror
                                    " id="src" name="src" accept="image/*">
                                    <img id="imagePreview" class="d-none" alt="Preview">
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
                                <div class="col-md-6 mb-3">
                                    <label for="main_heading" class="form-label">Main Heading</label>
                                    <input type="text" class="form-control
                                    @error('main_heading')
                                       is-invalid
                                    @enderror" id="main_heading" name="main_heading" value="{{ old('main_heading') }}"
                                    >
                                    @error('main_heading')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
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
                                    <label for="intro_text" class="form-label">Intro Text</label>
                                    <textarea class="form-control
                                    @error('intro_text')
                                       is-invalid
                                    @enderror" id="intro_text" name="intro_text" rows="3"
                                    >{{ old('intro_text') }}</textarea>
                                    @error('intro_text')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="button_text_1" class="form-label">Button 1 Text</label>
                                    <input type="text" class="form-control
                                    @error('button_link_1')
                                       is-invalid
                                    @enderror" id="button_text_1" name="button_text_1"
                                           value="{{ old('button_text_1') }}"
                                    >
                                    @error('button_text_1')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="button_link_1" class="form-label">Button 1 Link</label>
                                    <input type="url" class="form-control
                                    @error('button_link_1')
                                       is-invalid
                                    @enderror" id="button_link_1" name="button_link_1"
                                           value="{{ old('button_link_1') }}"
                                    >
                                    @error('button_link_1')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="button_text_2" class="form-label">Button 2 Text</label>
                                    <input type="text" class="form-control
                                    @error('button_text_2')
                                       is-invalid
                                    @enderror" id="button_text_2" name="button_text_2"
                                           value="{{ old('button_text_2') }}"
                                    >
                                    @error('button_text_2')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="button_link_2" class="form-label">Button 2 Link</label>
                                    <input type="url" class="form-control
                                    @error('button_link_2')
                                       is-invalid
                                    @enderror" id="button_link_2" name="button_link_2"
                                           value="{{ old('button_link_2') }}"
                                    >
                                    @error('button_link_2')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="order_no" class="form-label">Order Number</label>
                                    <input type="number" class="form-control
                                    @error('order_no')
                                       is-invalid
                                    @enderror" id="order_no" name="order_no" value="{{ old('order_no',1) }}"
                                    >
                                    @error('order_no')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-end"><i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
