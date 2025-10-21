@extends('back.layouts.master')

@section('title')
    Abunələr
@endsection

@section('css')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--            search input + axtar butonu --}}
            <div class="col-md-6">
                <form action="{{ route('back.subscriber.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" name="search" placeholder="Axtarış..."
                               aria-label="Search" aria-describedby="searchButton" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="searchButton"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscribes as $key => $subscribe)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $subscribe->email }}</td>
                    <td>
                        <form action="{{ route('back.subscriber.destroy',['subscriber'=>$subscribe->id]) }}"
                              method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="remover($(this), 'Silmək istədiyinizdən əminsiniz?', 'Təsdiqlə', 'Ləğv et');">
                                <i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $subscribes->links('vendor.pagination.bootstrap-4')  }}
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
