<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar penulis
        $categories = Categories::all();
        return view('categories.list-categories', compact('categories'));
    }
    public function create()
    {
        // Logika untuk menampilkan daftar penulis
        return view('categories.create-categories');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'url' => 'required|unique:categories|max:255',
        ]);
        try {
            Categories::create($request->all());

            return redirect('/categories')->withInput()->with('success', 'Category Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $category = Categories::find($id);
        return view('categories.edit-categories', compact('category'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($id),
            ],
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Dapatkan produk berdasarkan ID
        $category = Categories::find($id);

        // Perbarui data produk
        $category->update([
            'name' => $request->name,
            'url' => $request->url,
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect('/categories')->with('success', 'Categories Berhasil di Edit!');
    }
    public function destroy($id)
    {
        $categories = Categories::find($id);
        if ($categories) {
            $categories->delete();
            return redirect()->route('list-categories')->with('success', 'Category Berhasil Dihapus!');
        } else {
            return redirect()->route('list-categories')->with('error', 'Categori Tidak Ditemukan');
        }
    }
}