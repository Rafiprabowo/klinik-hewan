<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\MasterSpecializationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrescriptionItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Inertia\Auth\InertiaAuthController;
use App\Models\PrescriptionItem;

// Route::prefix('/inertia')->group(function () {
//     Route::prefix('/test')->group(function () {

//         //Specialization
//         Route::get('/admin/specialization/create', function () {
//             return Inertia::render('Dashboard/Admin/Specialization/Create', [
//                 'user' => 'rafi'
//             ]);
//         });

//         //User
//         Route::get('/admin/user/create', function () {
//             $user = Auth::user();
//             return Inertia::render('Dashboard/Admin/User/Create', [

//             ]);
//         });
//     });
// });

Route::get('/', function () {
    return Inertia::render('Home');
});

// Route::get('/', function () {
//     // return view('welcome');
//     return Inertia::render('Home');
// })->name('home');

// Route::get('/', [\App\Http\Controllers\TestController::class, 'render']);

// Route::get('/', function () {
//     return Inertia::render('Home');
// });

// Landing Page
Route::get('/faq', function () {
    return Inertia::render('Faq');
});

Route::get('/article', function () {
    return Inertia::render('Article');
});

Route::get('/about', function () {
    return Inertia::render('AboutUs');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.show.login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.show.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route::get('/article', [PostController::class, 'show']);

Route::prefix('/dashboard')->middleware('auth')->group(function () {

    // Profilet 
    Route::prefix('/profile')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('profile.show');
        Route::post('update/information', [ProfileController::class, 'updateProfileInformation'])->name('profile.update.information');
        Route::post('change/password', [ProfileController::class, 'changePassword'])->name('profile.change.password');
    });

    // Author Role
    Route::middleware('role:author')->group(function () {
        Route::prefix('/author/workspace')->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('dashboard.show.author');

            // Category
            Route::resource('category', CategoriesController::class);

            // Post
            Route::resource('post', PostController::class);

            // Post and Categories
            Route::prefix('/post_category')->group(function () {
                Route::get('/create_new_post/{post_id}/{category_id}', [PostCategoriesController::class, 'create_new_post'])->name('post.create-new-post');
            });
        });
    });

    // User Role
    Route::middleware('role:user')->group(function () {
        Route::prefix('/user/preview')->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('dashboard.show.user');
            // Route::get('', function () {
            //     return Inertia::render('Admin/Test');
            // })->name('dashboard.show.user');
        });
    });

    // Doctor Role
    Route::middleware('role:doctor')->group(function () {
        Route::prefix('/doctor/workspace')->group(function () {
            // Dashboard
            Route::get('', [DashboardController::class, 'index'])->name('dashboard.show.doctor');

            // Medical Record
            Route::prefix('/medical_record')->group(function () {
                Route::get('/list', [MedicalRecordController::class, 'list'])->name('medical_record.list');
                Route::post('/diagnosis', [MedicalRecordController::class, 'diagnosis'])->name('medical_record.diagnosis');
                Route::get('/status/{id}', [MedicalRecordController::class, 'status'])->name('medical_record.check');
                Route::get('/action/{id}', [MedicalRecordController::class, 'action'])->name('medical_record.action');
            });

            // Prescription
            Route::prefix('/prescription')->group(function () {
                Route::get('', [PrescriptionItemController::class, 'index'])->name('prescription.index');
                Route::get('/create/{id}', [PrescriptionItemController::class, 'create'])->name('prescription.create');
                Route::post('/store', [PrescriptionItemController::class, 'store'])->name('prescription.store');
                Route::get('/destroy/{id}/{med_id}', [PrescriptionItemController::class, 'destroy'])->name('prescription.destroy');
            });

            // Pet
            Route::prefix('/pet')->group(function () {
                Route::get('/check/{id}', [PetController::class, 'check'])->name('pet.check');
                Route::put('/update_pet', [PetController::class, 'updateByDoctor'])->name('pet.update.by.doctor');
            });
        });
    });

    // Admin Role
    Route::middleware('role:admin')->group(function () {

        Route::get('', [DashboardController::class, 'index'])->name('dashboard.show');

        // User
        Route::prefix('/user')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');

        });

        // Admin
        Route::resource('admin', AdminController::class);

        // Author
        Route::resource('author', AuthorController::class);

        // Doctor
        Route::resource('doctor', DoctorController::class);

        // Pet
        Route::resource('pet', PetController::class);

        // Medical Record
        Route::prefix('/medical_record')->group(function () {
            Route::get('', [MedicalRecordController::class, 'index'])->name('medical_record.index');
            Route::get('/create', [MedicalRecordController::class, 'create'])->name('medical_record.create');
            Route::post('/store', [MedicalRecordController::class, 'store'])->name('medical_record.store');
        });

        // Master
        Route::prefix('/master')->group(function () {
            Route::resource('pet_type', PetTypeController::class);
            Route::resource('inventory_category', InventoryCategoryController::class);
            Route::resource('inventory_item', InventoryItemController::class);
            Route::resource('specialization', MasterSpecializationController::class);
        });
    });
});

