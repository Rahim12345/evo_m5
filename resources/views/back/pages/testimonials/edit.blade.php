@extends('back.layouts.master')

@section('title')
    Rəyi redaktə edin
@endsection

@section('css')

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="categoryForm" action="{{ route('testimonial.update',$testimonial->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                        <img id="imagePreview" src="{{ asset('files/testimonials/'.$testimonial->src) }}"
                             alt="{{ $testimonial->alt }}"
                             style="width: 100px;cursor:pointer;">
                    </label>
                    <input type="file" name="src" id="src"
                           class="form-control d-none">
                    <div id="src-error" class="text-danger"></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="alt">Alt Text</label>
                            <input type="text" name="alt" id="alt" class="form-control"
                                   value="{{ old('alt',$testimonial->alt) }}">
                            <div id="alt-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Ad</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('alt',$testimonial->name) }}">
                            <div id="name-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="profession">İxtisas</label>
                    <input type="text" name="profession" id="profession" class="form-control"
                           value="{{ old('alt',$testimonial->profession) }}">
                    <div id="profession-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="review">Rəy</label>
                    <textarea name="review" id="review" class="form-control"
                              rows="4">{{ old('review',$testimonial->review) }}</textarea>
                    <div id="review-error" class="text-danger"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="order_no">Sıra nömrəsi</label>
                    <input type="number" name="order_no" id="order_no"
                           class="form-control" value="{{ $testimonial->order_no }}">
                    <div id="order_no-error" class="text-danger"></div>
                </div>

                <button type="submit" id="saveCategory" class="btn btn-primary">Yadda saxla</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('back/js/image-preview.js') }}"></script>
    <script>
        $('#saveCategory').click(function (e) {
            $('.text-danger').html('');
            e.preventDefault();
            $(this).prop('disabled', true);
            var categoryForm = document.getElementById("categoryForm");
            var data = new FormData(categoryForm);

            $.ajax({
                url: '{!! route('testimonial.update',$testimonial->id) !!}',
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
                    $('#saveCategory').prop('disabled', false);
                }
            });
        });
    </script>

    <script>
        $('#locale').on('change', function () {
            var locale = $(this).val();
            var newUrl = "{!! route('testimonial.create', ['locale' => '-locale']) !!}".replace('-locale', locale);

            window.history.pushState({}, '', newUrl);
        });
    </script>
@endsection
