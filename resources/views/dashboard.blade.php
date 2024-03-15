@extends('layouts.navbar')
    <!-- @section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">

    @endsection  -->
  @section('content') 
    <section class="gradient-custom-2">
    <div >
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:100%">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="{{$user->profilepic}}"
                  alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                  style="width: 150px; z-index: 1">
               
                  <a type="button" href="{{url('updateprofile')}}" class="btn btn-primary mb-3"
                  style="z-index: 2;">
                  Edit profile
                  </a>
                <!-- </button> -->
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h5>{{$user->name}}</h5>
                <p>{{$user->city}}</p>
              </div>
            </div>
            <!-- <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div>
                  <p class="mb-1 h5">253</p>
                  <p class="small text-muted mb-0">Photos</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5">1026</p>
                  <p class="small text-muted mb-0">Followers</p>
                </div>
                <div>
                  <p class="mb-1 h5">478</p>
                  <p class="small text-muted mb-0">Following</p>
                </div>
              </div>
            </div> -->
            <div class="card-body p-4 text-black">
              <!--<div class="mb-5">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1">Web Developer</p>
                  <p class="font-italic mb-1">Lives in New York</p>
                  <p class="font-italic mb-0">Photographer</p>
                </div>
              </div>-->
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Recent Products</p>
              </div>


                <div class="row g-2">
                  @foreach($sortedProducts as $product)
                  <div class="col-6" >
                    <a href="{{route('products.show',$product->id)}}">
                    <img src="{{$product->productimage}}"
                      alt="{{$product->name}}" class="w-100 rounded-3">
                    </a>
                    </div>
                  @endforeach
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection 