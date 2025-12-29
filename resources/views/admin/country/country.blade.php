@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Country',
    ])

    <div class="col-12">
        <div class="card">
            {{-- <div class="card-body">
                <h4 class="card-title">Table Header</h4>
                <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make
                    <code>&lt;thead&gt;</code>s appear light.
                </h6>
            </div> --}}
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
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td class="flex flex-col items-center">
                                <a href="">Edit</a>

                                <a href="">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
