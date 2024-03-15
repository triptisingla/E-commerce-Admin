<?php


use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Cloudinary\Configuration\Configuration;
use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Configuration::instance([
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_NAME'),
        'api_key' => env('CLOUDINARY_KEY'),
        'api_secret' => env('CLOUDINARY_SECRET')
    ],
    'url' => [
        'secure' => true
    ]
]);

Route::get('/', function () {
    return view('register');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/login', function () {
    return view('login');
});




Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [RegisterController::class, 'login'])->name('login');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',function(){
        $user = Auth::user();

         $products=[];
         $products = Product::where('user_id',Auth::user()->id)->get();
         
         $collection=collect($products);

         $sortedProducts=$collection->sortBy('created_at');
         $sortedProducts=$sortedProducts->take(4);
         $sortedProducts->values()->all();

        return view('dashboard',compact('user','sortedProducts'));
    })->name('dashboard');
    Route::prefix('products')->group(function () {
        Route::get('/deleted',[ProductController::class,'deletedProducts'])->name('deleted');
        Route::delete('/deletepermanent/{id}',[ProductController::class,'deleteProductForever'])->name('forcedelete');
        Route::get('/restore/{id}', [ProductController::class,'restoreProduct'])->name('restore');
        Route::get('/myproducts', [ProductController::class,'getAllMyProducts'])->name('myproducts');
    });
    
    Route::resource('products', ProductController::class);
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
    Route::get('/updateprofile', [RegisterController::class, 'updateprofileform']);
    Route::post('/updateprofile', [RegisterController::class, 'updateprofile'])->name('profile.update');
    Route::get('/productcreate',function(){
        $categories=['Stationary', 'Clothing', 'Electronics', 'Accessories', 'Home appliances'];
        $display=["Yes", "No"];
        return view('productcreate',compact('categories','display'));
    });


});

Route::get('groupby', [RegisterController::class, 'groupby']);