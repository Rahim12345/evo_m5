@extends('back.layouts.master')

@section('title')
    Rəylər
@endsection

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <select name="language" id="language" class="form-control d-inline-block w-auto me-2"
                        onchange="window.location.href='{!! route('testimonial.index') !!}?locale='+this.value">
                    @foreach(config('app.languages') as $locale=>$lang)
                        <option value="{{ $locale }}" {{ request('locale') === $locale ? 'selected' : '' }}>
                            {{ $lang }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('testimonial.create') }}?locale={{ request('locale') }}" class="btn btn-primary">
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
                        <th>Ad</th>
                        <th>Sıra no</th>
                        <th>Tarix</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr class="instructors" data-id="{{ $testimonial->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="image" style="width: 100px;height: 100px">
                                    <img src="{{ asset('files/testimonials/'.$testimonial->src) }}"
                                         style="object-fit: cover;height: -webkit-fill-available;"
                                         alt="{{ $testimonial->alt }}">
                                </div>
                            </td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->order_no }}</td>
                            <td>{{ $testimonial->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('testimonial.edit', $testimonial->id) }}?locale={{ request('locale') }}"
                                   class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST"
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
                            <td colspan="8" class="text-center">Təlimçi tapılmadı</td>
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
            window.location.href = '{{ route("testimonial.index") }}?locale=' + $(this).val();
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

                                $('.instructors[data-id="' + response.id + '"]').remove();

                                toastr.success('Təlim uğurla silindi', 'Əla');
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
