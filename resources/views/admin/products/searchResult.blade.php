@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Search Result',
    ])
    @if ($products->empty())
        <h3 class="text-center col-12 p-10">
            Not found product
        </h3>
    @else
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>$ {{ $product->price }}</td>
                                <td>{{ ucfirst($product->status) }}</td>
                                <td>{{ ucfirst($product->condition) }}</td>
                                <td>{{ $product->company }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding-left: 15px">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
@endsection
