<?php

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Course;
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

    $categories = Category::orderBy('name')->get();

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