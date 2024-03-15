@extends('layouts.navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Product') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')


                        <!-- Product Image -->
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Product Image') }}</label>

                            <div class="col-md-6">
                                @if($product->productimage)
                                <img src="{{ $product->productimage }}" alt="Product Image" style="max-width: 200px; max-height: 200px;">
                                @else
                                <p>No image available</p>
                                @endif

                                <input id="image" type="text" class="form-control mt-2 @error('image') is-invalid @enderror" name="product_img" placeholder="Enter image address">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Product Name -->
                        <div class="form-group row mt-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="product_name" value="{{ $product->name }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Product Detail -->
                        <div class="form-group row mt-2">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('PRODUCT DESCRIPTION') }}</label>

                            <div class="col-md-6">
                                <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="product_description" required>{{ $product->detail }}</textarea>

                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group row mt-2">
                            <label class="col-md-4 col-form-label text-md-right" for="product_categorie">PRODUCT CATEGORY</label>
                            <div class="col-md-6">
                                <select id="product_category" name="product_category" class="form-control form-select">
                                    <option selected>Choose...</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category}}" {{ $product->category === $category ? 'selected' : '' }}>{{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Product Price -->
                        <div class="form-group row mt-2">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="product_price" value="{{ $product->price }}" required>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Available Quantity -->
                        <div class="form-group row mt-2">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Available Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="available_quantity" value="{{ $product->quantity }}" required>

                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Enable Display -->
                        <div class="form-group row mt-2">
                            <label for="display" class="col-md-4 col-form-label text-md-right">{{ __('Enable Display') }}</label>

                            <div class="col-md-6">
                                <select id="display" class="form-control @error('display') is-invalid @enderror" name="enable_display" required>
                                    <option value="Yes" {{ $product->display === 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $product->display === 'No' ? 'selected' : '' }}>No</option>
                                </select>

                                @error('display')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0  mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection