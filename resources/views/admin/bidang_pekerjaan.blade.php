@extends('admin.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Bidang Pekerjaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/admin/bidang-pekerjaan') }}">Bidang Pekerjaan</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <!-- Panel Basic -->
    @if ($message = Session::get('bidang_pekerjaan_action'))
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
            <h3 class="panel-title">Data Bidang Pekerjaan</h3>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-15">
                        <button class="btn btn-primary" data-target="#exampleModalPrimary" data-toggle="modal">
                            <i class="icon md-plus" aria-hidden="true"></i> Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bidang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $seq_number = 1; ?>
                    @foreach($all_data as $row)
                    <tr>
                        <td>{{ $seq_number }}</td>
                        <td>{{ $row->deskripsi }}</td>
                        <td>
                            <a class="btn btn-info" role="button" href="{{ URL('admin/bidang-pekerjaan/edit/'.$row->id) }}"><i class="fa fa-pencil" title="Edit Data"></i></a>
                            <a class="btn btn-danger" href="{{ URL('admin/bidang-pekerjaan/delete/'.$row->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $seq_number++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade modal-primary" id="exampleModalPrimary" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form method="POST" action="{{ URL('admin/bidang_pekerjaan_store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Nama Bidang Pekerjaan</label>
                            <input type="text" class="form-control <?= ($errors->first('nama_bidang') != "") ? 'is-invalid' : ''; ?>" name="nama_bidang" value="{{ old('nama_bidang') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('nama_bidang') }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection