@extends('layouts.navbar')

@section('content')
<div class="container">
<form class="form-horizontal" method="POST" action="{{route('products.store')}}">
@csrf
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>

<!-- Text input-->
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="product_id">PRODUCT ID</label>  
  <div class="col-md-4">
  <input id="product_id" name="product_id" placeholder="PRODUCT ID" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">
    
  </div>
</div>



<!-- Select Basic -->
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="product_categorie">PRODUCT CATEGORY</label>
  <div class="col-md-4">
      <select id="product_category" name="product_category" class="form-control form-select">
          <option selected>Choose...</option>
          @foreach($categories as $category) 
          <option value="{{$category}}">{{$category}}</option>
          @endforeach 
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>  
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
    
  </div>
</div>


<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="product_price">Price</label>  
  <div class="col-md-4">
  <input id="product_price" name="product_price" placeholder="Product price" class="form-control input-md" required="" type="text">
    
  </div>
</div>


<!-- Textarea -->
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="product_description" name="product_description"></textarea>
  </div>
</div>


<!-- Text input-->
<div class="form-group mt-3">
  <label class="col-md-4 control-label input-group" for="enable_display">ENABLE DISPLAY</label>  
  <div class="col-md-4">
  <select id="enable_display" name="enable_display" class="form-control form-select">
          <option selected value="Yes">Yes</option>
          <option value="No">No</option>
    </select>
  </div>
</div>



 <!-- File Button --> 
<div class="form-group mt-3">
  <label class="col-md-4 control-label" for="filebutton">main_image</label>
  <div class="col-md-4">
  <input class="form-control input-md" required="" type="text"  id="product_img" name="product_img">
</div>
</div>



<!-- Button -->
<div class="form-group mt-3">
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">CREATE</button>
  </div>
  </div>

</fieldset>
</form>
</div>
@endsection