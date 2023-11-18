<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan baris ini
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function create()
    {
        $categories = Categories::all();
        return view('article.creates', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|unique:articles',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        // Gunakan transaksi database
        DB::beginTransaction();
        try {
            // Ambil gambar dari formulir
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('article_images'), $imageName);
            Article::create([
                'title' => $request->title,
                'url' => $request->url,
                'content' => $request->editor,
                'thumbnail' => $imageName,
                'author_id' => $request->author_id,
                'category_id' => $request->category_id,
            ]);
            DB::commit();
            return redirect('/article')->withInput()->with('success', 'Article added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function index()
    {
        $articles = Article::with('category', 'author')->orderBy('created_at', 'desc')->get();
        return view('article.index', compact('articles'));
    }
    public function view($url)
    {
        $article = Article::with('category', 'author')->where('url', $url)->first();
        return view('article.view', compact('article'));
    }
    
    public function edit($id)
    {
        $categories = Categories::all();
        $article = Article::find($id);
        $selectedCategoryId = $article->id;
        return view('article.edit', compact('article', 'categories', 'selectedCategoryId'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi formulir
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
        ]);

        // Temukan artikel berdasarkan ID
        $article = Article::find($id);

        // Periksa apakah artikel ada
        if (!$article) {
            return redirect()->route('article')->with('error', 'Article tidak ditemukan.');
        }

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('article_images'), $imageName);

            // Hapus gambar lama jika ada
            if ($article->thumbnail) {
                $path = public_path('article_images/' . $article->thumbnail);

                // Hapus file menggunakan unlink
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        } else {
            // Jika tidak ada gambar yang diunggah, gunakan gambar lama
            $imageName = $article->thumbnail ?? null;
        }

        // Update informasi artikel
        $article->update([
            'title' => $request->title,
            'url' => $request->url,
            'thumbnail' => $imageName,
            'category_id' => $request->category_id,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('article')->with('success', 'Article berhasil diperbarui.');
    }


    public function destroy($id)
    {
        // Temukan produk berdasarkan ID
        $article = Article::find($id);
        // Periksa apakah produk ada
        if (!$article) {
            return redirect()->route('article')->with('error', 'Article tidak ditemukan.');
        }
        // Dapatkan path gambar thumbnail
        $thumbnailPath = $article->getThumbnailPath();
        // Hapus produk
        // Hapus artikel dari database
        if ($article->delete()) {
            // Hapus gambar thumbnail jika ada setelah artikel berhasil dihapus
            if ($article->thumbnail && file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
            // Redirect dengan pesan sukses
            return redirect()->route('article')->with('success', 'Article berhasil dihapus.');
        } else {
            // Jika penghapusan artikel gagal, redirect dengan pesan error
            return redirect()->route('article')->with('error', 'Gagal menghapus Article.');
        }
    }
}