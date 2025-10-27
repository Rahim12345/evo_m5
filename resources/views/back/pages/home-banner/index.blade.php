@extends('back.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('home-banner.create') }}" class="btn btn-primary w-100"><i class="fa fa-plus"></i></a>
            </div>
            <div class="col-md-6">
                <select class="form-select mb-3" id="locale" name="locale"
                        onchange="window.location.href='{{ route('home-banner.index') }}?locale='+this.value">
                    @foreach(config('app.languages') as $locale_code => $locale_name)
                        <option
                            value="{{$locale_code}}"
                            {{ request('locale') == $locale_code? 'selected' : '' }}
                        >
                            {{ $locale_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
            <tr>
                <td>#</td>
                <td>Şəkil</td>
                <td>Başlıq</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @if($banners->count() > 0)
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td><img src="{{ asset('files/home_banners/'.$banner->src) }}" alt="{{ $banner->title }}"
                                 class="img-fluid"></td>
                        <td>{{ $banner->title }}</td>
                        <td>
                            <a href="{{ route('home-banner.edit', $banner->id) }}"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('home-banner.destroy', $banner->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center">Banner yoxdur.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('js')

@endsection
