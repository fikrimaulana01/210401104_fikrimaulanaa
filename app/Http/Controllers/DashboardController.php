<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Categories;
use App\Models\Author;
class DashboardController extends Controller
{
    public function index()
    {
        $totalarticles = Article::count();
        $totalcategories = Categories::count();
        $totalauthor = Author::count();
        return view('index2', compact('totalarticles', 'totalcategories', 'totalauthor'));
    }
}