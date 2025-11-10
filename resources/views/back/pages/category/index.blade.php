@extends('back.layouts.master')

@section('title')
    Kateqoriyalar
@endsection

@section('css')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <select name="language" id="language" class="form-control d-inline-block w-auto me-2"
                        onchange="window.location.href='{!! route('category.index') !!}?locale='+this.value">
                    @foreach(config('app.languages') as $locale=>$lang)
                        <option value="{{ $locale }}" {{ request('locale') === $locale ? 'selected' : '' }}>
                            {{ $lang }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('category.create') }}?locale={{ request('locale') }}" class="btn btn-primary">
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
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('files/categories/'.$category->src) }}" alt="{{ $category->alt }}"
                                     width="50">
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->order_no }}</td>
                            <td>{{ $category->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Silmək istədiyinizdən əminsizin?')">
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
            window.location.href = '{{ route("category.index") }}?locale=' + $(this).val();
        });
    </script>
@endsection
