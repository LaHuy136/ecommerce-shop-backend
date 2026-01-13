@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Order Histories',
    ])

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <th scope="row">{{ $history->id }}</th>
                            <td>{{ $history->email }}</td>
                            <td>{{ $history->name }}</td>
                            <td>$ {{ $history->price }}</td>
                            <td>{{ $history->created_at->format('l, F j, Y g:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $histories->links() }} --}}
@endsection
