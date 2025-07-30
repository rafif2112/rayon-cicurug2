<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SiswaModel;

class SiswaAuthController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/siswa';
        // $this->publicHtmlPath = public_path('assets/images/siswa');
    }

    public function dashboard()
    {
        $data = Auth::user()->siswa;
        return view('siswa.dashboard', compact('data'));
    }

    public function profile()
    {
        $data = Auth::user()->siswa;
        return view('siswa.profile', compact('data'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $siswa = Auth::user()->siswa;

        $request->validate([
            'nama' => 'sometimes|string|max:30',
            'email' => 'sometimes|email|unique:users,email,' . Auth::id(),
            'jurusan' => 'sometimes|string',
            'link' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], [
            'nama.max' => 'Nama tidak boleh lebih dari 30 karakter',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah digunakan',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2MB',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($siswa->gambar && file_exists($this->publicHtmlPath . '/' . $siswa->gambar)) {
                    unlink($this->publicHtmlPath . '/' . $siswa->gambar);
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($this->publicHtmlPath, $filename);
                $siswa->gambar = $filename;
            }

            // Update data siswa
            $siswa->nama = $request->nama ? $request->nama : $siswa->nama;
            $siswa->jurusan = $request->jurusan ? $request->jurusan : $siswa->jurusan;
            $siswa->link = $request->link ? $request->link : $siswa->link;

            if ($request->filled('latitude') && $request->filled('longitude')) {
                $siswa->latitude = $request->latitude;
                $siswa->longitude = $request->longitude;
            }

            $siswa->save();

            $user->email = $request->email ? $request->email : $user->email;
            $user->save();

            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak benar');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}