<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', function () {
   return view('dashboard');
});
Route::get('/', [TaskController::class, 'index']);



Route::get('/dashboard', [TaskContoroller::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
 
    
Route::middleware('auth')->group(function () {
    
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks', [TaskController::class, 'destroy'])->name('tasks.destroy'); 
    Route::get('/tasks' , [TaskController::class,'create'])->name('tasks.create');
});

require __DIR__.'/auth.php';
