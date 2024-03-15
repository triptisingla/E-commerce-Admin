@extends('layouts.navbar')
@section('css')
    <link rel="stylesheet" href="{{asset('css/showProducts.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection
@section('content')

<div class="row justify-content-center product-grid-style">
    <h1 class="row justify-content-center">Deleted Products</h1>
                    @foreach($products as $product)
                    <div class="col-11 col-sm-6 col-lg-4 col-xl-3">

                        <div class="product-details">

                            <div class="product-img">
                                <img src="{{$product->productimage}}" alt="{{$product->name}}">
                                <div class="product-cart">
                                
                                    <a href="#" onclick="confirmDelete(event,'{{route('forcedelete',$product->id)}}')">DELETE</a>

                                    
                                    <a href="{{route('restore',$product->id)}}">RESTORE</a>
                                </div>

                            </div>

                            <div class="product-info">
                                <a href="#!">{{$product->name}}</a>
                                <p class="price text-center m-0">
                                    <span class="red line-through me-2">$600</span>
                                    <span>{{$product->price}}</span>
                                </p>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalTitle">Product Deleted</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Product deleted successfully!</p>
                        </div>
                        </div>
                    </div>
                </div>
 
</div>

@endsection

@section('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function confirmDelete(event, deleteUrl) {
        event.preventDefault();
        if (confirm("Are you sure you want to delete this product?")) {
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Parse JSON response
                } else {
                    throw new Error('Failed to delete product.');
                }
            })
            .then(data => {
                // Check if the response contains a success message
                if (data.success) {
                    console.log("Product deleted successfully");
                    event.target.closest('.col-11').remove();
                    // Show the modal after successful deletion
                    $('#myModal').modal('show');
                } else {
                    throw new Error('Failed to delete product.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

    function closePopup() {
        // Hide the popup
        document.getElementById("popup").style.display = "none";
    }
</script>
@endsection