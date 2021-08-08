@extends('index')
@section('content')
<style>
    .border-top {
        border-top: 1px solid #e5e5e5;
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .border-top-gray {
        border-top-color: #adb5bd;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }

    .lh-condensed {
        line-height: 1.25;
    }
</style>
<main role="main" class="container">
    @if ($message = Session::get('kirim_lamaran_action'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($errors->all())
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
            Error Mengirim Lamaran.
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </strong>
    </div>
    @endif
    <center>
        <h1 class="mt-5">{{ $job->judul_lowongan }}</h1>
        <div>
            <?php $path = URL('storage/gambar_lowongan/' . $job->gambar_lowongan); ?>
            <img class="img-fluid" src="{{ $path }}" alt="..." style="width: auto;">
        </div>
        <br />
    </center>
    <p>Di buat pada : {{ $job->tanggal_job }}</p>
    <p class="lead">
        <?php echo $job->deskripsi_lowongan; ?>
    </p>
    <br />
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Lowongan dibuat oleh : </h6>
        <div class="media text-muted pt-3">
            <?php $path = URL('storage/logo_perusahaan/' . $job->logo_perusahaan); ?>
            <img src="<?= $path; ?>" alt="..." class="mr-2 rounded" style="width: 5%;">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">{{ $job->nama }}</strong>
                Alamat :
                <br />
                <?= $job->alamat_lengkap . ", " . $job->dusun . ", " . $job->kelurahan . ", " . $job->kecamatan; ?>
                <br />
                <?= $job->kota_kabupaten . ", " . $job->provinsi; ?>
                <br />
                <?= $job->kode_pos; ?>
                <br />
                Kontak :
                <br />
                <?= "E-mail : " . $job->email; ?>
                <br />
                <?= "No. Telepon : " . $job->no_telepon; ?>
                <br />
                <?= "No. Hanhphone / WA : " . $job->no_hp; ?>
            </p>
            <div>
                <?php echo  $job->deskripsi_perusahaan; ?>
            </div>
        </div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <small class="d-block text-right mt-3">
            Jika anda ingin mengirim lamaran pekerjaan, silahkan isi formulir dibawah ini.
        </small>
    </div>
    <br />
    <hr class="mb-4">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">Kirim Lamaran</h4>
            <form class="needs-validation" method="post" action="{{ URl('kirim-lamaran') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_job" value="<?= $job->id_job; ?>">
                <div class="mb-3">
                    <label for="email">Nama Lengkap</label>
                    <input type="text" class="form-control <?= ($errors->first('nama_lengkap')) ? 'is-invalid' : ''; ?> " name="nama_lengkap">
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_lengkap') }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Alamat Lengkap</label>
                    <textarea class="form-control <?= ($errors->first('alamat_lengkap')) ? 'is-invalid' : ''; ?> " name="alamat_lengkap"></textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat_lengkap') }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Domisili Alamat</label>
                    <input type="text" class="form-control <?= ($errors->first('domisili')) ? 'is-invalid' : ''; ?> " name="domisili">
                    <div class="invalid-feedback">
                        {{ $errors->first('domisili') }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control <?= ($errors->first('email')) ? 'is-invalid' : ''; ?> " name="email">
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. Hp</label>
                        <input type="number" class="form-control <?= ($errors->first('no_hp')) ? 'is-invalid' : ''; ?> " name="no_hp">
                        <div class="invalid-feedback">
                            {{ $errors->first('no_hp') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Posisi yang diinginkan</label>
                        <input type="text" class="form-control <?= ($errors->first('posisi')) ? 'is-invalid' : ''; ?> " name="posisi">
                        <div class="invalid-feedback">
                            {{ $errors->first('posisi') }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>File CV</label>
                        <input type="file" class="form-control <?= ($errors->first('file')) ? 'is-invalid' : ''; ?> " name="file">
                        <span style="color: red;">*Tipe file harus .pdf</span>
                        <div class="invalid-feedback">
                            {{ $errors->first('file') }}
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-sm btn-block" type="submit">Kirim Lowongan</button>
                <a class="btn btn-warning btn-sm btn-block" role="button" style="color: white;" href="{{ URl('bidang-pekerjaan/'.$job->categorie_id) }}">Kembali ke halaman daftar lowongan</a>
            </form>
        </div>
    </div>
</main>
@endsection