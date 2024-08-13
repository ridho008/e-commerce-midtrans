@extends('app')

@section('content')
    <div class="container">
        <h2 class="text-center">All Products</h2>
        <div class="alert alert-info">Integration payment gateway midtrans with <a
                href="https://docs.midtrans.com/docs/snap">Built-in Interface (SNAP)</a> </div>
        <div class="row shadow-sm mt-4">
            @foreach ($products as $product)
                <div class="col ">
                    <div class="card mb-2" style="width: 18rem;">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->price }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <form action="{{ route('addproduct.to.cart', $product->id) }}" method="post">
                                @csrf
                                <input type="number" name="quantity" class="form-control" value="1" min="1"
                                    max="10">
                                <button type="submit" class="btn btn-primary">Add to cart</button>
                            </form>
                            {{-- <a href="{{ route('addproduct.to.cart', $product->id) }}" class="btn btn-outline-danger">Add to cart</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
