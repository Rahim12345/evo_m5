@extends('back.layouts.master')

@section('title')
    Kurs əlavə et
@endsection

@section('css')

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="courseForm" action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="locale" value="{{ request('locale', 'az') }}">

                <div class="col-md-12">
                    <label for="locale" class="form-label">Dil seçin</label>
                    <select class="form-select mb-3" id="locale" name="locale">
                        @foreach(config('app.languages') as $locale_code => $locale_name)
                            <option
                                value="{{$locale_code}}"
                                @selected(old('locale', request('locale')) == $locale_code)
                            >
                                {{ $locale_name }}
                            </option>
                        @endforeach
                    </select>
                    <div id="locale-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="src">
                        <img id="imagePreview" src="{{ asset('icons/add-image.png') }}" alt="add-image.png"
                             style="width: 100px;cursor:pointer;">
                    </label>
                    <input type="file" name="src" id="src"
                           class="form-control d-none">
                    <div id="src-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="alt">Alt Text</label>
                    <input type="text" name="alt" id="alt" class="form-control">
                    <div id="alt-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Ad</label>
                    <input type="text" name="name" id="name" class="form-control"
                           onkeyup="document.getElementById('slug').value = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')">
                    <div id="name-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control">
                    <div id="slug-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="order_no">Sıra nömrəsi</label>
                    <input type="number" name="order_no" id="order_no"
                           class="form-control" value="0">
                    <div id="order_no-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="category_id">Kateqoriyalar</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Birini seçin</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div id="category_id-error" class="text-danger"></div>
                </div>

                <button type="submit" id="saveCourse" class="btn btn-primary">Yadda saxla</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('back/js/image-preview.js') }}"></script>
    <script>
        $('#saveCourse').click(function (e) {
            $('.text-danger').html('');
            e.preventDefault();
            $(this).prop('disabled', true);
            var courseForm = document.getElementById("courseForm");
            var data = new FormData(courseForm);

            $.ajax({
                url: '{!! route('course.store') !!}',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        location.href = response.redirect_url
                    }, 1500);
                },
                error: function (myErrors) {
                    $.each(myErrors.responseJSON.errors, function (key, value) {
                        $('#' + key + '-error').html('').html(value);
                    });
                    $('#saveCourse').prop('disabled', false);
                }
            });
        });
    </script>

    <script>
        $('#locale').on('change', function () {
            var locale = $(this).val();
            var newUrl = "{!! route('category.create', ['locale' => '-locale']) !!}".replace('-locale', locale);

            window.history.pushState({}, '', newUrl);
        });
    </script>
@endsection
