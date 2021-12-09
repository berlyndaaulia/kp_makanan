<?php

namespace App\Http\Controllers;

use App\Models\MakananKhas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class MakananKhasController extends Controller
{
    /**
     * Menampilkan Halaman Utama
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makanan_khas = MakananKhas::all();

        return view('makanan_khas', ['makanan_khas' => $makanan_khas]);
    }

    /**
     * Simpan data makanan khas kedalam database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambahMakananKhas(Request $request)
    {
        // validasi data yang dikirim oleh user
        $request->validate([
            "nama" => "required|string",
            "daerah" => "required|string",
            "deskripsi" => "required|string|max:300",
            "gambar" => "required|image|mimes:jpeg,png,jpg,gif,svg",
        ]);

        // menamai dan memindahkan data gambar ke folder uploads
        $nama_gambar = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('uploads'), $nama_gambar);

        MakananKhas::create([
            'nama' => $request->nama,
            'daerah' => $request->daerah,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'uploads/'.$nama_gambar,
        ]);

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Makanan Khas berhasil didaftarkan');
    }

    public function updateMakananKhas(Request $request, $makanan_khas_id)
    {
        // validasi data yang dikirim oleh user
        $request->validate([
            "nama" => "required|string",
            "daerah" => "required|string",
            "deskripsi" => "required|string|max:300",
            "gambar" => "image|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $makanan_khas_db = MakananKhas::find($makanan_khas_id);
        $makanan_khas_db->nama = $request->nama;
        $makanan_khas_db->daerah = $request->daerah;
        $makanan_khas_db->deskripsi = $request->deskripsi;

        // jika user mengubah gambar maka hapus gambar lama dan ganti yang baru
        if ($request->hasFile('gambar'))
        {
            // menamai dan memindahkan data gambar baru ke folder uploads
            $nama_gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $nama_gambar);
            // get path gambar lama dari database dan hapus file gambar lama
            File::delete(public_path().'/'.$makanan_khas_db->gambar);

            $makanan_khas_db->gambar = 'uploads/'.$nama_gambar;
        }

        // update data makanan khas
        $makanan_khas_db->save();

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Makanan Khas berhasil diupdate');

    }

    public function hapusMakananKhas($makanan_khas_id)
    {
        $makanan_khas_db = MakananKhas::find($makanan_khas_id);

        // hapus gambar
        File::delete(public_path().'/'.$makanan_khas_db->gambar);

        $makanan_khas_db->delete();

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Makanan Khas berhasil dihapus');
    }
}
