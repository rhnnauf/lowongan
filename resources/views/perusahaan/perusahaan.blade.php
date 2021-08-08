@extends('perusahaan.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Perusahaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/perusahaan/data-perusahaan') }}">Perusahaan</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <!-- Panel Basic -->
    @if ($message = Session::get('perusahaan_user_action'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($errors->all())
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
            Error Memproses data.
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </strong>
    </div>
    @endif
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title">Data Perusahaan</h3>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-xl-12 form-group">
                    <label><b>Nama Perusahaan</b></label>
                    <div>
                        {{ $perusahaan->user->nama }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 form-group">
                    <label><b>Kategori Bidang Perusahaan</b></label>
                    <div>
                        {{ $perusahaan->categorie->deskripsi }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 form-group">
                    <label><b>Deskripsi Perusahaan</b></label>
                    <div>
                        <?php echo $perusahaan->deskripsi_perusahaan; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 form-group">
                    <label><b>Provinsi</b></label>
                    <div>
                        {{ $perusahaan->provinsi }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>Kota / Kabupaten</b></label>
                    <div>
                        {{ $perusahaan->kota_kabupaten }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>Kecamatan</b></label>
                    <div>
                        {{ $perusahaan->kecamatan }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>Kelurahan</b></label>
                    <div>
                        {{ $perusahaan->kelurahan }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>Dusun</b></label>
                    <div>
                        {{ $perusahaan->dusun }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>Kode Pos</b></label>
                    <div>
                        {{ $perusahaan->kode_pos }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 form-group">
                    <label><b>Alamat Lengkap</b></label>
                    <div>
                        {{ $perusahaan->alamat_lengkap }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 form-group">
                    <label><b>Email</b></label>
                    <div>
                        {{ $perusahaan->user->email }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>No. Telepon</b></label>
                    <div>
                        {{ $perusahaan->no_telepon }}
                    </div>
                </div>
                <div class="col-xl-4 form-group">
                    <label><b>No. Hanphone / Whatsapp</b></label>
                    <div>
                        {{ $perusahaan->no_hp }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 form-group">
                    <label><b>Logo Perusahaan</b></label>
                    <div>
                        <?php $path = URL('storage/logo_perusahaan/' . $perusahaan->logo_perusahaan); ?>
                        <img class="img-fluid" src="{{ $path }}" alt="..." style="width: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection