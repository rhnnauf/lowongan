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

class PerusahaanController extends Controller
{
    public function login_action(Request $request)
    {
        request()->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $data = User::where(["email" => $email, "password" => $password, "level_id" => "2"])->first();
        if ($data) {
            session(['perusahaan_id' => $data->id]);
            return redirect('/perusahaan/dashboard')->with('alert-login-perusahaan', "Anda berhasil login.");
        } else {
            return redirect('/perusahaan/login')->with('alert-login-perusahaan', "Maaf. Gagal login, mohon periksa username dan password anda.");
        }
    }

    public function logout_action(Request $request)
    {
        $request->session()->flush();
        return redirect('/perusahaan/login')->with('alert-login-perusahaan', "Anda berhasil logout.");
    }

    public function dashboard()
    {
        $session_hal = array(
            'menu_perusahaan' => 'dashboard'
        );
        session($session_hal);
        return view('perusahaan.dashboard');
    }

    // Perusahaan
    public function data_perusahaan()
    {
        $session_hal = array(
            'menu_perusahaan' => 'perusahaan'
        );
        session($session_hal);
        $perusahaan_id = session('perusahaan_id');
        $data['perusahaan'] = Perusahaan::where('user_id', '=', $perusahaan_id)->first();
        return view('perusahaan.perusahaan', $data);
    }

    // Pekerjaan
    public function pekerjaan()
    {
        $session_hal = array(
            'menu_perusahaan' => 'pekerjaan'
        );
        session($session_hal);
        $user = User::find(session('perusahaan_id'));
        $perusahaan_id = $user->perusahaan->id;
        $data['all_data'] = Job::where('perusahaan_id', '=', $perusahaan_id)->get();
        return view('perusahaan.pekerjaan', $data);
    }

    public function pekerjaan_store(Request $request)
    {
        request()->validate([
            'judul_lowongan' => 'required',
            'deskripsi_lowongan' => 'required',
            'file' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $path = Storage::putFile('public/gambar_lowongan', $request->file('file'));
        $explode = explode('/', $path);

        $user = User::find(session('perusahaan_id'));

        $data = array(
            'perusahaan_id' => $user->perusahaan->id,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi_lowongan' => $request->deskripsi_lowongan,
            'gambar_lowongan' => $explode[2]
        );
        Job::create($data);
        return redirect('perusahaan/pekerjaan')->with("pekerjaan_user_action", "Data telah ditambahkan.");
    }

    public function pekerjaan_detail($id)
    {
        $job = Job::find($id);
        $path = URL('storage/gambar_lowongan/' . $job->gambar_lowongan);
        $data = array(
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
            request()->validate([
                'judul_lowongan_edit' => 'required',
                'deskripsi_lowongan_edit' => 'required',
                'file_edit' => 'required|file|image|mimes:jpeg,png,jpg'
            ]);

            // Hapus data gambar yang telah ada
            $path_delete = 'public/gambar_lowongan/' . $job->gambar_lowongan;
            Storage::delete($path_delete);

            //inputkan file yang baru
            $path = Storage::putFile('public/gambar_lowongan', $request->file('file_edit'));
            $explode = explode('/', $path);

            // Update data
            $data = array(
                'judul_lowongan'     => $request->judul_lowongan_edit,
                'deskripsi_lowongan' => $request->deskripsi_lowongan_edit,
                'gambar_lowongan'    => $explode[2]
            );
            Job::where('id', '=', $id)->update($data);
        } else {
            request()->validate([
                'judul_lowongan_edit' => 'required',
                'deskripsi_lowongan_edit' => 'required'
            ]);

            // Update data
            $data = array(
                'judul_lowongan'     => $request->judul_lowongan_edit,
                'deskripsi_lowongan' => $request->deskripsi_lowongan_edit
            );
            Job::where('id', '=', $id)->update($data);
        }
        return redirect('perusahaan/pekerjaan')->with("pekerjaan_user_action", "Data telah dirubah.");
    }

    public function pekerjaan_delete($id)
    {
        $job = Job::find($id);

        // Hapus dulu file yang ada
        $path_delete = 'public/gambar_lowongan/' . $job->gambar_lowongan;
        Storage::delete($path_delete);

        $job->delete();
        return redirect('perusahaan/pekerjaan')->with("pekerjaan_user_action", "Data telah dihapus.");
    }

    // Data Pelamar Pekerjaan
    public function pelamar()
    {
        $session_hal = array(
            'menu_perusahaan' => 'pelamar'
        );
        session($session_hal);
        $perusahaan_id = session('perusahaan_id');
        $data['all_data'] = DB::table('pelamars')
            ->join('jobs', 'pelamars.job_id', '=', 'jobs.id')
            ->join('perusahaans', 'jobs.perusahaan_id', '=', 'perusahaans.id')
            ->join('users', 'perusahaans.user_id', '=', 'users.id')
            ->select('pelamars.id as pelamar_id', 'pelamars.nama_lengkap as nama_lengkap', 'jobs.judul_lowongan as judul_lowongan', 'users.nama as nama_perusahaan', 'perusahaans.id as perusahaan_id', 'users.id as user_id')->where('users.id', '=', $perusahaan_id)->get();
        return view('perusahaan.pelamar', $data);
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
        return redirect('perusahaan/pelamar')->with("pelamar_perusahaan_action", "Data telah dihapus.");
    }
}
