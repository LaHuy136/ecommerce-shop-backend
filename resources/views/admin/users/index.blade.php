@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Users',
    ])

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            @if ($user->level == 0)
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    <a href="/admin/user/{{ $user->id }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                @if (empty($user->country->name))
                                    <td></td>
                                @else
                                    <td>{{ $user->country->name }}</td>
                                @endif
                                <td>Member</td>
                                <td class="flex flex-col items-center">
                                    <button class="btn btn-primary"><a style="color: white"
                                            href="/admin/user/{{ $user->id }}/edit">Edit</a></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-5 align-self-center" style="margin-left:20px">
            <a href="/admin/user/create" class="btn btn-success">Create User</a>
        </div>
    </div>
@endsection
