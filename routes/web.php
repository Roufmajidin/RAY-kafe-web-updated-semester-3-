    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MenuController;
    use App\Http\Controllers\AdminController;
    use App\Models\User;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return view('auth.login');
    });
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('/', function () {
    //     return view('master.master');
    // });
    // Route::get('/master', function () {
    //     return view('master.master');
    // });
    Route::get('/about', [MenuController::class, 'about']);

    Route::group(['middleware' => 'pelanggan'], function() {
    Route::get('/pesan', [MenuController::class, 'index']);
    Route::get('/pesan_barang/{id}', [MenuController::class, 'detail_menu']);
    Route::post('/pesan/{id}', [MenuController::class, 'store']);
    Route::get('/cek-out', [MenuController::class, 'cekout']);
    Route::get('/struk', [MenuController::class, 'struk']);

    });

    //middleware (hak akses)

    Route::group(['middleware' => 'admin'], function() {

        Route::get('/data-produk', [AdminController::class, 'index']);
        Route::get('/data-user', [AdminController::class, 'user']);
        Route::get('/data-pesanan', [AdminController::class, 'data_pesanan']);
        Route::get('/pelanggan', [AdminController::class, 'pelanggan']);
        Route::get('/kirim_pesan/{id}', [AdminController::class, 'kirim_pesan']);
        Route::post('/kirim_pesanUser/{id}', [AdminController::class, 'kirim_pesan_user']);
        Route::get('/tambah-produk', function () {
            return view('admin.tambah-produk');
        });
        Route::get('/edit/{id}', [AdminController::class, 'edit']);
        Route::patch('/edit-proses/{id}', [AdminController::class, 'edit_proses']);
        Route::get('/req', [AdminController::class, 'req']);
        Route::get('/scan', [AdminController::class, 'scan'])->name('scan');
        Route::post('/postScan', [AdminController::class, 'postScan'])->name('postScan');
        Route::get('/ambilData/{id}', [AdminController::class, 'ambil'])->name('ambilData');


        Route::post('/tambah-produk', [AdminController::class, 'store_menu']);
        Route::get('/hapus/{id}', [AdminController::class, 'delete']);
        Route::get('/get', [AdminController::class, 'c']);

        // Route::get('/tambah-user', function () {
        //     $user = new User;
        //     $user->name = 'meja 3';
        //     $user->username = 'meja3@mail.com';
        //     $user->password = bcrypt('meja3meja3');
        //     $user->level = 'pelanggan';

        //     return 'ok';



        // });


    });
