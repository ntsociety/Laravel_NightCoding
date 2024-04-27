<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $category = Category::all();
        // dd($category);
        return view('accueil', compact('category'));
    }
    public function create()
    {
    }
    public function store()
    {
    }
}
