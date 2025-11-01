    <?php

    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProductController;

    use App\Http\Controllers\PosController;


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);


    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [PosController::class, 'index'])->name('index');
        Route::get('/caller/{number}', [PosController::class, 'selectCaller'])->name('caller');
        Route::get('/order/{order}', [PosController::class, 'showProducts'])->name('products');
        Route::post('/order/{order}/add-product', [PosController::class, 'addProduct'])->name('addProduct');
        Route::post('/order/{order}/update-total', [PosController::class, 'updateTotal'])->name('updateTotal');
        Route::post('/order/{order}/checkout', [PosController::class, 'checkout'])->name('checkout');
        Route::post('/caller/{callNumber}/add-to-cart', [PosController::class, 'addToCart'])->name('addToCart');
    });
