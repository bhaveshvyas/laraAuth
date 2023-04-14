@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h4>Product List</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('prod.create') }}"> Create New Product</a>
            </div>
            <br>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>SKU</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @if($products->count() > 0)
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>
                <form action="{{ route('products.edit',$product->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>

                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sir ?')" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5"> There no record was found </td>
        </tr>
        @endif
    </table>

    {!! $products->links() !!}

@endsection