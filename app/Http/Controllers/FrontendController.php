<?php

namespace App\Http\Controllers;

// Load Function and dependencies on Laravel 7
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Load All The Model
use App\Categorie;
use App\Job;
use App\Level;
use App\Pelamar;
use App\Perusahaan;
use App\User;

class FrontendController extends Controller
{
    public function index()
    {
        $session_hal = array(
            'menu_frontend' => 'home'
        );
        session($session_hal);
        return view('home');
    }

    public function bidang_pekerjaan($id)
    {
        $session_hal = array(
            'menu_frontend' => 'kategori'
        );
        session($session_hal);
        $data['categorie'] = Categorie::find($id);
        $data['job'] = DB::table('jobs')
            ->join('perusahaans', 'jobs.perusahaan_id', '=', 'perusahaans.id')
            ->join('users', 'perusahaans.user_id', '=', 'users.id')
            ->join('categories', 'perusahaans.categorie_id', '=', 'categories.id')
            ->select('jobs.*', 'jobs.id as id_job', 'perusahaans.*', 'users.*', 'categories.*')->where('perusahaans.categorie_id', '=', $id)->get();
        //dd($data['job']);
        return view('bidang_pekerjaan', $data);
    }

    public function detail_pekerjaan($id)
    {
        $session_hal = array(
            'menu_frontend' => 'kategori'
        );
        session($session_hal);
        $data['job'] = DB::table('jobs')
            ->join('perusahaans', 'jobs.perusahaan_id', '=', 'perusahaans.id')
            ->join('users', 'perusahaans.user_id', '=', 'users.id')
            ->join('categories', 'perusahaans.categorie_id', '=', 'categories.id')
            ->select('jobs.*', 'jobs.id as id_job', 'jobs.created_at as tanggal_job', 'perusahaans.*', 'users.*', 'categories.*')->where('jobs.id', '=', $id)->first();
        //dd($data['job']);
        return view('detail_pekerjaan', $data);
    }

    public function kirim_lamaran_action(Request $request)
    {
        request()->validate([
            'id_job'         => 'required|numeric',
            'nama_lengkap'   => 'required',
            'alamat_lengkap' => 'required',
            'domisili'       => 'required',
            'email'          => 'required|email',
            'no_hp'          => 'required|numeric',
            'posisi'         => 'required',
            'file'           => 'required|file|mimes:pdf'
        ]);

        $id_job = $request->id_job;
        $path = Storage::putFile('public/file_cv', $request->file('file'));
        $explode = explode('/', $path);

        $data = array(
            'job_id'         => $id_job,
            'nama_lengkap'   => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'domisili'       => $request->domisili,
            'email'          => $request->email,
            'no_hp'          => $request->no_hp,
            'posisi'         => $request->posisi,
            'file_cv'        => $explode[2]
        );
        Pelamar::create($data);
        return redirect('data-pekerjaan-detail/' . $id_job)->with("kirim_lamaran_action", "Data telah disimpan.");
    }
}
