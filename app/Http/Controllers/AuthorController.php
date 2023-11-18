<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    //
    public function index()
    {
        // Logika untuk menampilkan daftar penulis
        $authors = Author::all();
        return view('author.list-author', compact('authors'));
    }
    public function register()
    {
        // Logika untuk menampilkan daftar penulis
        return view('author.register-author');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors',
            'tanggal_lahir' => 'required',
            'password' => 'required|min:8',
        ]);
        try {
            Author::create([
                'name' => $request->name,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'password' => $request->password,
            ]);

            return redirect('/author')->with('success', 'Author Berhasil di Tambahkan!');
        } catch (\Exception $e) {
            return redirect('/author')->withInput()->with('error', 'Gagal menambahkan Author, Coba Lagi');
        }
    }
    public function destroy($id)
    {
        // Temukan produk berdasarkan ID
        $author = Author::find($id);
        // Periksa apakah produk ada
        if (!$author) {
            return redirect()->route('list-author')->with('error', 'Author tidak ditemukan.');
        }

        // Hapus produk
        $author->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('list-author')->with('success', 'Author berhasil dihapus.');
    }

    public function showlogin()
    {
        // Jika belum login, tampilkan formulir login
        return view('author.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
    public function edit($id)
    {
        $author = Author::find($id);
        return view('author.edit-author', compact('author'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('authors')->ignore($id),
            ],
            'password' => 'nullable|min:8',
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Dapatkan produk berdasarkan ID
        $author = Author::find($id);

        // Perbarui data produk
        $author->update([
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'password' => $request->filled('password') ? $request->password : $author->password,
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect('/author')->with('success', 'Author Berhasil di Edit');
    }
}