<?php

namespace App\Http\Controllers;

// Load Function and dependencies on Laravel 7
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

// Load All The Model
use App\Categorie;
use App\Job;
use App\Level;
use App\Pelamar;
use App\Perusahaan;
use App\User;
use GuzzleHttp\Promise\Create;

class AdminController extends Controller
{
    public function login_action(Request $request)
    {
        request()->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $data = User::where(["email" => $email, "password" => $password, "level_id" => "1"])->first();
        if ($data) {
            session(['admin_id' => $data->id]);
            return redirect('/admin/dashboard')->with('alert-login', "Anda berhasil login.");
        } else {
            return redirect('/admin/login')->with('alert-login', "Maaf. Gagal login, mohon periksa username dan password anda.");
        }
    }

    public function logout_action(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin/login')->with('alert-login', "Anda berhasil logout.");
    }

    // Dashboard
    public function dashboard()
    {
        $session_hal = array(
            'menu_admin' => 'dashboard'
        );
        session($session_hal);
        return view('admin.dashboard');
    }

    // Bidang Pekerjaan
    public function bidang_pekerjaan()
    {
        $session_hal = array(
            'menu_admin' => 'bidang_pekerjaan'
        );
        session($session_hal);
        $data['all_data'] = Categorie::all();
        return view('admin.bidang_pekerjaan', $data);
    }

    public function bidang_pekerjaan_store(Request $request)
    {
        request()->validate([
            'nama_bidang' => 'required|unique:categories,deskripsi',
        ]);
        $datanya = array(
            'deskripsi' => $request->nama_bidang
        );
        Categorie::create($datanya);
        return redirect('/admin/bidang-pekerjaan')->with('bidang_pekerjaan_action', 'Data telah tersimpan.');
    }

    public function bidang_pekekerjaan_edit($id)
    {
        $data['data'] = Categorie::find($id);
        return view('admin.bidang_pekerjaan_edit', $data);
    }

    public function bidang_pekerjaan_update(Request $request)
    {
        $id = $request->id;
        request()->validate([
            'nama_bidang' => 'required|unique:categories,deskripsi',
        ]);
        $datanya = array(
            'deskripsi' => $request->nama_bidang
        );
        Categorie::whereId($id)->update($datanya);
        return redirect('/admin/bidang-pekerjaan')->with('bidang_pekerjaan_action', 'Data telah berubah.');
    }

    public function bidang_pekerjaan_delete($id)
    {
        $data = Categorie::find($id);
        $data->delete();
        return redirect('/admin/bidang-pekerjaan')->with('bidang_pekerjaan_action', 'Data berhasil di hapus.');
    }

    // Perusahaan
    public function perusahaan()
    {
        $session_hal = array(
            'menu_admin' => 'perusahaan'
        );
        session($session_hal);
        $data['all_data'] = User::where('level_id', '=', 2)->get();
        $data['bidang_pekerjaan'] = Categorie::all();
        return view('admin.perusahaan', $data);
    }

    public function perusahaan_store(Request $request)
    {
        request()->validate([
            'nama_perusahaan' => 'required',
            'kategori_bidang' => 'required',
            'deskripsi_perusahaan' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'dusun' => 'required',
            'kode_pos' => 'required|numeric',
            'alamat_perusahaan' => 'required',
            'file' => 'required|file|image|mimes:jpeg,png,jpg',
            'no_telp' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        //inputkan dulu ke tabel users
        $users = new user;
        $users->nama     = $request->nama_perusahaan;
        $users->email    = $request->email;
        $users->password = $request->password;
        $users->level_id = "2";
        $users->save();
        $last_id = $users->id;

        //lalu masukkan ke data perusahaan berdasarkan id users perusahaan
        $path = Storage::putFile('public/logo_perusahaan', $request->file('file'));
        $explode = explode('/', $path);
        $data = array(
            'user_id'              => $last_id,
            'categorie_id'         => $request->kategori_bidang,
            'alamat_lengkap'       => $request->alamat_perusahaan,
            'provinsi'             => $request->provinsi,
            'kota_kabupaten'       => $request->kota,
            'kecamatan'            => $request->kecamatan,
            'kelurahan'            => $request->kelurahan,
            'dusun'                => $request->dusun,
            'kode_pos'             => $request->kode_pos,
            'no_telepon'           => $request->no_telp,
            'no_hp'                => $request->no_hp,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'logo_perusahaan'      => $explode[2]
        );
        Perusahaan::create($data);
        return redirect('admin/perusahaan')->with("perusahaan_action", "Data telah ditambahkan.");
    }

    public function perusahaan_detail($id)
    {
        $data = User::find($id);
        $perusahaan = Perusahaan::where('user_id', '=', $id)->first();
        $path = URL('storage/logo_perusahaan/' . $perusahaan->logo_perusahaan);
        $detail = array(
            'nama_perusahaan_detail'       => $data->nama,
            'kategori_perusahaan_detail'   => $perusahaan->categorie->deskripsi,
            'deskripsi_perusahaan_detail'  => $perusahaan->deskripsi_perusahaan,
            'provinsi_perusahaan_detail'   => $perusahaan->provinsi,
            'kota_perusahaan_detail'       => $perusahaan->kota_kabupaten,
            'kecamatan_perusahaan_detail'  => $perusahaan->kecamatan,
            'kelurahan_perusahaan_detail'  => $perusahaan->kelurahan,
            'dusun_perusahaan_detail'      => $perusahaan->dusun,
            'kode_pos_perusahaan_detail'   => $perusahaan->kode_pos,
            'alamat_perusahaan_detail'     => $perusahaan->alamat_lengkap,
            'email_perusahaan_detail'      => $data->email,
            'no_telp_perusahaan_detail'    => $perusahaan->no_telepon,
            'no_hp_perusahaan_detail'      => $perusahaan->no_hp,
            'logo_perusahaan_detail'       => $path
        );
        echo json_encode($detail);
    }

    public function perusahaan_edit($id)
    {
        $data = User::find($id);
        $perusahaan = Perusahaan::where('user_id', '=', $id)->first();
        $path = URL('storage/logo_perusahaan/' . $perusahaan->logo_perusahaan);
        $detail = array(
            'id'                         => $data->id,
            'nama_perusahaan_edit'       => $data->nama,
            'kategori_bidang_edit'       => $perusahaan->categorie_id,
            'deskripsi_perusahaan_edit'  => $perusahaan->deskripsi_perusahaan,
            'provinsi_edit'              => $perusahaan->provinsi,
            'kota_edit'                  => $perusahaan->kota_kabupaten,
            'kecamatan_edit'             => $perusahaan->kecamatan,
            'kelurahan_edit'             => $perusahaan->kelurahan,
            'dusun_edit'                 => $perusahaan->dusun,
            'kode_pos_edit'              => $perusahaan->kode_pos,
            'alamat_perusahaan_edit'     => $perusahaan->alamat_lengkap,
            'email_edit'                 => $data->email,
            'no_telp_edit'               => $perusahaan->no_telepon,
            'no_hp_edit'                 => $perusahaan->no_hp,
            'password_edit'              => $data->password,
            'logo_perusahaan_edit'       => $path
        );
        echo json_encode($detail);
    }

    public function perusahaan_update(Request $request)
    {
        $id = $request->id_edit;
        $perusahaan = Perusahaan::where('user_id', '=', $id)->first();
        if ($request->file_edit) {
            // Dengan Upload File
            request()->validate([
                'nama_perusahaan_edit' => 'required',
                'kategori_bidang_edit' => 'required',
                'deskripsi_perusahaan_edit' => 'required',
                'provinsi_edit' => 'required',
                'kota_edit' => 'required',
                'kecamatan_edit' => 'required',
                'kelurahan_edit' => 'required',
                'dusun_edit' => 'required',
                'kode_pos_edit' => 'required|numeric',
                'alamat_perusahaan_edit' => 'required',
                'no_telp_edit' => 'required|numeric',
                'no_hp_edit' => 'required|numeric',
                'password_edit' => 'required',
                'file_edit' => 'file|image|mimes:jpeg,png,jpg'
            ]);

            // Hapus dulu file yang ada
            $path_delete = 'public/logo_perusahaan/' . $perusahaan->logo_perusahaan;
            Storage::delete($path_delete);

            //inputkan file yang baru
            $path = Storage::putFile('public/logo_perusahaan', $request->file('file_edit'));
            $explode = explode('/', $path);

            //Di tabel user
            $data1 = array(
                'nama'     => $request->nama_perusahaan_edit,
                'password' => $request->password_edit
            );
            User::where('id', '=', $id)->update($data1);

            //Di tabel perusahaan
            $data2 = array(
                'categorie_id'         => $request->kategori_bidang_edit,
                'alamat_lengkap'       => $request->alamat_perusahaan_edit,
                'provinsi'             => $request->provinsi_edit,
                'kota_kabupaten'       => $request->kota_edit,
                'kecamatan'            => $request->kecamatan_edit,
                'kelurahan'            => $request->kelurahan_edit,
                'dusun'                => $request->dusun_edit,
                'kode_pos'             => $request->kode_pos_edit,
                'no_telepon'           => $request->no_telp_edit,
                'no_hp'                => $request->no_hp_edit,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan_edit,
                'logo_perusahaan'      => $explode[2]
            );
            Perusahaan::where('user_id', '=', $id)->update($data2);
        } else {
            // Tanpa Upload FIle
            request()->validate([
                'nama_perusahaan_edit' => 'required',
                'kategori_bidang_edit' => 'required',
                'deskripsi_perusahaan_edit' => 'required',
                'provinsi_edit' => 'required',
                'kota_edit' => 'required',
                'kecamatan_edit' => 'required',
                'kelurahan_edit' => 'required',
                'dusun_edit' => 'required',
                'kode_pos_edit' => 'required|numeric',
                'alamat_perusahaan_edit' => 'required',
                'no_telp_edit' => 'required|numeric',
                'no_hp_edit' => 'required|numeric',
                'password_edit' => 'required'
            ]);
            //Di tabel user
            $data1 = array(
                'nama'     => $request->nama_perusahaan_edit,
                'password' => $request->password_edit
            );
            User::where('id', '=', $id)->update($data1);

            //Di tabel perusahaan
            $data2 = array(
                'categorie_id'         => $request->kategori_bidang_edit,
                'alamat_lengkap'       => $request->alamat_perusahaan_edit,
                'provinsi'             => $request->provinsi_edit,
                'kota_kabupaten'       => $request->kota_edit,
                'kecamatan'            => $request->kecamatan_edit,
                'kelurahan'            => $request->kelurahan_edit,
                'dusun'                => $request->dusun_edit,
                'kode_pos'             => $request->kode_pos_edit,
                'no_telepon'           => $request->no_telp_edit,
                'no_hp'                => $request->no_hp_edit,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan_edit
            );
            Perusahaan::where('user_id', '=', $id)->update($data2);
        }
        return redirect('admin/perusahaan')->with("perusahaan_action", "Data telah dirubah.");
    }

    public function perusahaan_delete($id)
    {
        $perusahaan = Perusahaan::where('user_id', '=', $id)->first();
        $user = User::find($id);

        // Hapus dulu file yang ada
        $path_delete = 'public/logo_perusahaan/' . $perusahaan->logo_perusahaan;
        Storage::delete($path_delete);

        $perusahaan->delete();
        $user->delete();
        return redirect('admin/perusahaan')->with("perusahaan_action", "Data telah dihapus.");
    }

    //Pekerjaan
    public function pekerjaan()
    {
        $session_hal = array(
            'menu_admin' => 'pekerjaan'
        );
        session($session_hal);
        $data['all_data'] = Job::all();
        $data['perusahaan'] = User::where('level_id', '=', 2)->get();
        return view('admin.pekerjaan', $data);
    }

    public function pekerjaan_store(Request $request)
    {
        request()->validate([
            'perusahaan' => 'required',
            'judul_lowongan' => 'required',
            'deskripsi_lowongan' => 'required',
            'file' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $path = Storage::putFile('public/gambar_lowongan', $request->file('file'));
        $explode = explode('/', $path);

        $data = array(
            'perusahaan_id' => $request->perusahaan,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi_lowongan' => $request->deskripsi_lowongan,
            'gambar_lowongan' => $explode[2]
        );
        Job::create($data);
        return redirect('admin/pekerjaan')->with("pekerjaan_action", "Data telah ditambahkan.");
    }

    public function pekerjaan_detail($id)
    {
        $job = Job::find($id);
        $path = URL('storage/gambar_lowongan/' . $job->gambar_lowongan);
        $data = array(
            'nama_perusahaan_detail'    => $job->perusahaan->user->nama,
            'judul_lowongan_detail'     => $job->judul_lowongan,
            'deksripsi_lowongan_detail' => $job->deskripsi_lowongan,
            'gambar_lowongan_detail'    => $path
        );
        echo json_encode($data);
    }

    public function pekerjaan_edit($id)
    {
        $job = Job::find($id);
        $path = URL('storage/gambar_lowongan/' . $job->gambar_lowongan);
        $data = array(
            'id_edit'                 => $job->id,
            'perusahaan_edit'         => $job->perusahaan_id,
            'judul_lowongan_edit'     => $job->judul_lowongan,
            'deskripsi_lowongan_edit' => $job->deskripsi_lowongan,
            'gambar_lowongan_edit'    => $path
        );
        echo json_encode($data);
    }

    public function pekerjaan_update(Request $request)
    {
        $id = $request->id_edit;
        $job = Job::find($id);
        if ($request->file_edit) {
            // Dengan upload gambar
            request()->validate([
                'perusahaan_edit' => 'required',
                'judul_lowongan_edit' => 'required',
                'deskripsi_lowongan_edit' => 'required',
                'file_edit' => 'file|image|mimes:jpeg,png,jpg'
            ]);

            // Hapus data gambar yang telah ada
            $path_delete = 'public/gambar_lowongan/' . $job->gambar_lowongan;
            Storage::delete($path_delete);

            //inputkan file yang baru
            $path = Storage::putFile('public/gambar_lowongan', $request->file('file_edit'));
            $explode = explode('/', $path);

            // Update data
            $data = array(
                'perusahaan_id'      => $request->perusahaan_edit,
                'judul_lowongan'     => $request->judul_lowongan_edit,
                'deskripsi_lowongan' => $request->deskripsi_lowongan_edit,
                'gambar_lowongan'    => $explode[2]
            );
            Job::where('id', '=', $id)->update($data);
        } else {
            // Tanpa upload gambar
            request()->validate([
                'perusahaan_edit' => 'required',
                'judul_lowongan_edit' => 'required',
                'deskripsi_lowongan_edit' => 'required'
            ]);

            // Update data
            $data = array(
                'perusahaan_id'      => $request->perusahaan_edit,
                'judul_lowongan'     => $request->judul_lowongan_edit,
                'deskripsi_lowongan' => $request->deskripsi_lowongan_edit
            );
            Job::where('id', '=', $id)->update($data);
        }
        return redirect('admin/pekerjaan')->with("pekerjaan_action", "Data telah dirubah.");
    }

    public function pekerjaan_delete($id)
    {
        $job = Job::find($id);

        // Hapus dulu file yang ada
        $path_delete = 'public/gambar_lowongan/' . $job->gambar_lowongan;
        Storage::delete($path_delete);

        $job->delete();
        return redirect('admin/pekerjaan')->with("pekerjaan_action", "Data telah dihapus.");
    }

    // Pelamar Pekerjaan
    public function pelamar()
    {
        $session_hal = array(
            'menu_admin' => 'pelamar'
        );
        session($session_hal);
        $data['all_data'] = Pelamar::all();
        return view('admin.pelamar', $data);
    }

    public function pelamar_detail($id)
    {
        $pelamar = Pelamar::find($id);
        $path = URL('storage/file_cv/' . $pelamar->file_cv);
        $data = array(
            'nama_pelamar'     => $pelamar->nama_lengkap,
            'alamat_pelamar'   => $pelamar->alamat_lengkap,
            'domisili_pelamar' => $pelamar->domisili,
            'email_pelamar'    => $pelamar->email,
            'no_hp_pelamar'    => $pelamar->no_hp,
            'posisi_pelamar'   => $pelamar->posisi,
            'file_cv_pelamar'  => $path
        );
        echo json_encode($data);
    }

    public function pelamar_delete($id)
    {
        $pelamar = Pelamar::find($id);
        // Hapus dulu file yang ada
        $path_delete = 'public/file_cv/' . $pelamar->file_cv;
        Storage::delete($path_delete);

        $pelamar->delete();
        return redirect('admin/pelamar')->with("pelamar_admin_action", "Data telah dihapus.");
    }
}
