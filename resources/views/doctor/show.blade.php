@extends('layout.template')

@section('title', 'Detail Doctor : ' . $doctor->name)

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Doctor : {{ $doctor->name }}</h1>
    </div>

    <div class="table-responsive small">

        <div class="table table-striped">
            <table class="table table-bordered table-striped table-sm">
                <tr>
                    <td>Name</td>
                    <td>{{ $doctor->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $doctor->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $doctor->phone }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        @if ($doctor->gender == 'male')
                            <span class="badge bg-primary">Male</span>
                        @else
                            <span class="badge bg-secondary">Female</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ $doctor->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ $doctor->updated_at }}</td>
                </tr>
            </table>
            <div class="float-end">
                <a href="{{ url('doctor') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

    </div>
</main>
@endsection
