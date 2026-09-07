<?php

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Course;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $books = Book::with('category')
        ->latest()
        ->take(6)
        ->get();

    $courses = Course::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    return view('home', compact('books', 'courses'));
})->name('home');


/*
|--------------------------------------------------------------------------
| BOOKS
|--------------------------------------------------------------------------
*/

Route::get('/books', function (Request $request) {

    $query = Book::with('category');

    // Search berdasarkan judul
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan kategori
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $books = $query
        ->latest()
        ->paginate(12)
        ->withQueryString();

    $categories = BookCategory::orderBy('name')->get();

    return view('books.index', compact(
        'books',
        'categories'
    ));

})->name('books.index');


Route::get('/books/{book}', function (Book $book) {

    $book->load('category');

    return view('books.show', compact('book'));

})->name('books.show');


/*
|--------------------------------------------------------------------------
| COURSES
|--------------------------------------------------------------------------
*/

Route::get('/courses', function () {

    $courses = Course::where('is_active', true)
        ->latest()
        ->paginate(9);

    return view('courses.index', compact('courses'));

})->name('courses.index');


Route::get('/courses/{course}', function (Course $course) {

    return view('courses.show', compact('course'));

})->name('courses.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

});

/*
|--------------------------------------------------------------------------
| COURSE REGISTRATION - STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post(
        '/courses/{course}/register',
        [CourseRegistrationController::class, 'store']
    )->name('courses.register');

    Route::get(
        '/student/courses',
        [CourseRegistrationController::class, 'index']
    )->name('student.courses');

    Route::patch(
        '/student/courses/{registration}/cancel',
        [CourseRegistrationController::class, 'cancel']
    )->name('student.courses.cancel');

});