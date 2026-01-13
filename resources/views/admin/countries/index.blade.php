@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Country',
    ])

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <th scope="row">{{ $country->id }}</th>
                            <td>{{ $country->name }}</td>
                            <td class="flex flex-col items-center">
                                <a href="/admin/country/{{ $country->id }}/edit" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding-left: 15px">
            {{ $countries->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <div class="row">
        <div class="col-5 align-self-center" style="margin-left:20px">
            <a href="/admin/country/create" class="btn btn-success">Create Country</a>
        </div>
    </div>
@endsection
