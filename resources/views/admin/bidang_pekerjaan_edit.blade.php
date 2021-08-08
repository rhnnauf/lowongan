@extends('admin.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Data Bidang Pekerjaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item">Bidang Pekerjaan</li>
        <li class="breadcrumb-item"><a href="{{ URL('/bidang-pekerjaan/edit/'.$data->id) }}">Edit Data</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title">Formulir Edit Data</h3>
        </header>
        <div class="panel-body">
            <form method="post" action="{{ URl('admin/bidang-pekerjaan/update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $data->id }}" name="id" />
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label" for="nama">Nama Bidang Pekerjaan</label>
                        <input type="text" class="form-control <?= ($errors->first('nama_bidang') != "") ? 'is-invalid' : ''; ?>" name="nama_bidang" value="{{ old('nama_bidang') ?? $data->deskripsi }}" />
                        <div class="invalid-feedback">
                            <?= $errors->first('nama_bidang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group form-material">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-warning" href="{{ URL('admin/bidang-pekerjaan') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endSection