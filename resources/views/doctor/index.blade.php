@extends('layout.template')

@section('title', 'Doctor')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Doctor</h1>
    </div>

    <a href="{{ url('doctor/create') }}" class="btn btn-success mb-3">Create</a>

    <div class="d-flex float-end">
        <form action="{{ url('doctor') }}" method="get" class="d-flex">
            <input type="text" class="form-control form-control-sm me-2 mb-3" name="search" value="{{ request('search') }}"
                placeholder="Search..." style="width: 300px" autocomplete="off" value="{{ request('search') }}">
            <button class="btn btn-primary mb-3" type="submit">Search</button>
        </form>
    </div>

    @session('success')
    <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
            onclick="this.parentElement.style.display='none'"></button>
    </div>
    @endsession

    <div class="table-responsive small">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>
                        <a href="{{ url('doctor/'.$doctor->uuid) }}" class="btn btn-primary">Detail</a>

                        <a href="{{ url('doctor/'.$doctor->uuid.'/edit') }}" class="btn btn-warning">Edit</a>

                        <form action="{{ url('doctor/'.$doctor->uuid) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            {{-- sebagai keamanan bahwa penggantian method itu developer yg buat, bukan dari luar --}}
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $doctors->appends(['search' => request('search')])->links() }}
    </div>
</main>
@endsection
