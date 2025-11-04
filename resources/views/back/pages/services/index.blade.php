@extends('back.layouts.master')

@section('title')

@endsection

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('services.create') }}" class="btn btn-primary w-100"><i class="fa fa-plus"></i></a>
            </div>
            <div class="col-md-6">
                <select class="form-select mb-3" id="locale" name="locale"
                        onchange="window.location.href='{{ route('services.index') }}?locale='+this.value">
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
                <td>Icon</td>
                <td>Başlıq</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @if($services->count() > 0)
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{!! $service->icon !!}</td>
                        <td>{{ $service->title }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>

                                <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit"
                                            onclick="remover($(this), `Silmək istədiyinizdən əminsiniz?`, `Təsdiqlə`, `Ləğv et`);">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center">Xidmət yoxdur.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        function remover(myThis, title, confirmButtonText, cancelButtonText) {
            let form = myThis.closest("form");
            event.preventDefault();
            Swal.fire({
                title: title,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText
            })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        form.submit();
                    }
                });
        }
    </script>
@endsection
