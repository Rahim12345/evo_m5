@extends('back.layouts.master')

@section('title')

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
                        <form action="{{ route('services.update',['service'=>$service->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="locale" class="form-label">Dil seçin</label>
                                    <select class="form-select mb-3" id="locale" name="locale">
                                        @foreach(config('app.languages') as $locale_code => $locale_name)
                                            <option
                                                value="{{$locale_code}}"
                                                @selected(old('locale', $service->locale) == $locale_code)
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
                                <div class="col-md-12 mb-3">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="text" class="form-control
                                    @error('icon')
                                       is-invalid
                                    @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon) }}">
                                    @error('icon')
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
                                    @enderror" id="title" name="title" value="{{ old('title', $service->title) }}">
                                    @error('title')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control
                                    @error('description')
                                       is-invalid
                                    @enderror" id="description" name="description" rows="3"
                                    >{{ old('description', $service->description) }}</textarea>
                                    @error('description')
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
                                    @enderror" id="order_no" name="order_no"
                                           value="{{ old('order_no', $service->order_no) }}"
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
