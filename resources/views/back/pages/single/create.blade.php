@php use App\Helpers\Single; @endphp
@extends('back.layouts.master')

@section('title', 'Single data')

@section('css')
    <style>
        .section-title {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title i {
            font-size: 22px;
            margin-right: 8px;
            color: #4e73df;
        }

        .custom-card {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 20px;
            background: #ffffff;
            margin-bottom: 25px;
            transition: 0.2s ease;
        }

        .custom-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        #imagePreview {
            border-radius: 8px;
            border: 2px dashed #cbd5e1;
            padding: 6px;
            background: #f8fafc;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="categoryForm" action="{{ route('single.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ********** Bölmə 1: Dil Seçimi + Logo ********** --}}
                <div class="custom-card">
                    <div class="section-title">
                        <i class="fa fa-globe"></i> Ümumi məlumat
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dil seçin</label>
                            <select class="form-select" id="locale" name="locale">
                                @foreach(config('app.languages') as $code => $lang)
                                    <option value="{{ $code }}" @selected(request('locale')==$code)>
                                        {{ $lang }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="locale-error" class="text-danger"></div>
                        </div>

                        <div class="col-md-6 mb-3 text-center">
                            <label for="src">
                                <img id="imagePreview" src="{{ asset('icons/add-image.png') }}"
                                     style="width:120px;cursor:pointer;" title="Şəkil seçin">
                            </label>
                            <input type="file" name="src" id="src" class="d-none">
                            <div id="src-error" class="text-danger"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Alt Text</label>
                            <input type="text" name="alt" class="form-control" value="{{ Single::get('alt_'.request('locale')) }}">
                            <div id="alt-error" class="text-danger"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Layihənin adı</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ Single::get('name_'.request('locale')) }}">
                            <div id="name-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>

                {{-- ********** Bölmə 2: Sosial Media ********** --}}
                <div class="custom-card">
                    <div class="section-title">
                        <i class="fa fa-share-alt"></i> Sosial Media
                    </div>

                    <div class="row">
                        @foreach([
                            'facebook' => 'Facebook',
                            'instagram' => 'Instagram',
                            'youtube' => 'YouTube',
                            'x' => 'X (Twitter)'
                        ] as $key => $label)
                            <div class="col-md-6 mb-3">
                                <label>{{ $label }}</label>
                                <input type="url" name="{{ $key }}" class="form-control"
                                       value="{{ Single::get($key.'_'.request('locale')) }}">
                                <div id="{{ $key }}-error" class="text-danger"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ********** Bölmə 4: Əlaqə Məlumatları ********** --}}
                <div class="custom-card">
                    <div class="section-title">
                        <i class="fa fa-phone"></i> Əlaqə məlumatları
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Single::get('email_'.request('locale')) }}">
                            <div id="email-error" class="text-danger"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Telefon</label>
                            <input type="tel" name="phone" class="form-control" value="{{ Single::get('phone_'.request('locale')) }}">
                            <div id="phone-error" class="text-danger"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Ünvan</label>
                            <input type="text" name="address" class="form-control" value="{{ Single::get('address_'.request('locale')) }}">
                            <div id="address-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" id="saveSingleData" class="btn btn-primary px-4">Yadda saxla</button>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('back/js/image-preview.js') }}"></script>

    <script>
        $('#saveSingleData').click(function (e) {
            $('.text-danger').html('');
            e.preventDefault();
            $(this).prop('disabled', true);
            let form = document.getElementById("categoryForm");
            let data = new FormData(form);

            $.ajax({
                url: '{{ route('single.store') }}',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success(response.message);
                    $('#saveSingleData').prop('disabled', false);
                },
                error: function (err) {
                    $.each(err.responseJSON.errors, function (key, val) {
                        $('#' + key + '-error').html(val);
                    });
                    $('#saveSingleData').prop('disabled', false);
                }
            });
        });

        $('#locale').change(function () {
            let locale = $(this).val();
            let newUrl = "{{ route('single.create', ['locale' => '-locale']) }}".replace('-locale', locale);
            window.history.pushState({}, '', newUrl);
        });
    </script>
@endsection
