<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $book = Book::with('user', 'category')->get();
            return view('book', compact('user', 'book'));
        }
        $book = Book::where('user_id', $user->id)->with('user', 'category')->get();
        return view('book', compact('user', 'book'));
    }
}
