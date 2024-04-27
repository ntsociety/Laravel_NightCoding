<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProduitRequest;
use App\Models\Category;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produit = Produit::orderBy('created_at', 'desc')->get();
        // $produit = Produit::orderBy('created_at', 'desc')->where('id', 19)->get();
        $produit = Produit::orderBy('created_at', 'desc')->paginate(5);
        $totalProduit = DB::table('produits')->count('*');
        // dd($totalProduit);
        return view('produit.index', compact('produit', 'totalProduit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $category = Category::orderBy('created_at', 'desc')->get();
        $category = DB::table('categories')->orderBy('created_at', 'desc')->get();
        // dd($category);
        return view('produit.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProduitRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // image
        $file = $data['image'];
        $imageName = date('Y-m-d') . '_' . $file->getClientOriginalName();
        $file->move('assets/produit/images', $imageName);

        $produit = new Produit();
        $produit->name = $data['name'];
        $produit->prix = $data['prix'];
        $produit->description = $data['description'];
        $produit->category_id = $data['category_id'];
        $produit->image = $imageName;
        $produit->save();
        return redirect()->route('produit.index')->with('message', "Produit ajouté avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::find($id);
        // dd($produit);
        return view('produit.view', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Produit::findOrFail($id);
        $category = Category::orderBy('created_at', 'desc')->get();
        // dd($produit);
        return view('produit.edit', compact('produit', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProduitRequest $request, string $id)
    {
        $produit = Produit::findOrFail($id);

        $data = $request->validated();


        // dd($data);
        // image
        if ($request->hasFile('image')) {
            $oldImagePath = "assets/produit/images/" . $produit->image;
            // dd(file_exists($oldImagePath));
            // dd(is_dir($oldImagePath));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $data['image'];
            $imageName = date('Y-m-d') . '_' . $file->getClientOriginalName();
            $file->move('assets/produit/images', $imageName);
            $produit->image = $imageName;
        }



        $produit->name = $data['name'];
        $produit->prix = $data['prix'];
        $produit->description = $data['description'];
        $produit->category_id = $data['category_id'];

        $produit->update();
        return redirect()->route('produit.index')->with('message', "Produit modifié avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::findOrFail($id);
        $oldImagePath = "assets/produit/images/" . $produit->image;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $produit->delete();
        return redirect()->route('produit.index')->with('message', "Produit supprimé avec succès !");
    }
}
