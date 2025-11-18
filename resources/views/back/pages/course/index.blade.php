@extends('back.layouts.master')

@section('title')
    Kurslar
@endsection

@section('css')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <select name="language" id="language" class="form-control d-inline-block w-auto me-2">
                    @foreach(config('app.languages') as $locale=>$lang)
                        <option value="{{ $locale }}" {{ request('locale') === $locale ? 'selected' : '' }}>
                            {{ $lang }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('course.create') }}?locale={{ request('locale') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Şəkil</th>
                        <th>Kateqoriya</th>
                        <th>Kurs ad</th>
                        <th>Müəllif</th>
                        <th>Tarix</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($courses as $course)
                        <tr class="courses" data-id="{{ $course->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('files/courses/'.$course->src) }}" alt="{{ $course->alt }}"
                                     width="50">
                            </td>
                            <td>{{ $course->getCategory->name }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->getTeacher->name }}</td>
                            <td>{{ $course->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('course.edit', $course->id) }}?locale={{ request('locale') }}"
                                   class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="remover($(this), 'Silmək istədiyinizdən əminsiniz?', 'Təsdiqlə', 'Ləğv edin');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Kateqoriya tapılmadı</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#language').on('change', function () {
            window.location.href = '{{ route("course.index") }}?locale=' + $(this).val();
        });

        function remover(myThis, title, confirmButtonText, cancelButtonText) {
            let form = myThis.closest("form");
            let action = form.attr('action');
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
                        $.ajax({
                            type: 'POST',
                            'method': 'DELETE',
                            url: action,
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function (response) {
                                console.log(response);

                                $('.courses[data-id="' + response.id + '"]').remove();

                                toastr.success('Kurs uğurla silindi', 'Əla');
                            },
                            error: function (myErrors) {
                                $.each(myErrors.responseJSON.errors, function (key, value) {
                                    toastr.error(value, 'Xəta');
                                });
                            }
                        });
                    }
                });
        }
    </script>
@endsection
