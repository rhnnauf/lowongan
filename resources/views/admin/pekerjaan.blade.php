@extends('admin.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Pekerjaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/admin/pekerjaan') }}">Pekerjaan</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <!-- Panel Basic -->
    @if ($message = Session::get('pekerjaan_action'))
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
            <h3 class="panel-title">Data Pekerjaan</h3>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-15">
                        <button class="btn btn-primary" role="button" data-target="#exampleModalPrimary" data-toggle="modal">
                            <i class="icon md-plus" aria-hidden="true"></i> Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Perusahaan</th>
                        <th>Judul Pekerjaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $seq_number = 1; ?>
                    @foreach($all_data as $row)
                    <tr>
                        <td>{{ $seq_number }}</td>
                        <td>{{ $row->perusahaan->user->nama }}</td>
                        <td>{{ $row->judul_lowongan }}</td>
                        <td>
                            <button class="btn btn-success" role="button" onclick="data_detail(<?= $row->id; ?>)" data-target="#exampleModalSuccess" data-toggle="modal"><i class="fa fa-info" title="Detail Data"></i></button>
                            <button class="btn btn-info" role="button" onclick="data_edit(<?= $row->id; ?>)" data-target="#exampleModalInfo" data-toggle="modal"><i class="fa fa-pencil" title="Edit Data"></i></button>
                            <a class="btn btn-danger" href="{{ URL('admin/pekerjaan/delete/'.$row->id) }}"><i class="fa fa-trash"></i></a>
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
<div class="modal fade modal-primary" id="exampleModalPrimary" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form method="POST" action="{{ URL('admin/pekerjaan_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Perusahaan</label>
                            <select name="perusahaan" class="form-control <?= ($errors->first('perusahaan') != "") ? 'is-invalid' : ''; ?>">
                                <option value="">--- Pilih perusahaan ---</option>
                                @foreach($perusahaan as $row)
                                <option value="{{ $row->perusahaan->id }}" <?= ($row->id == old('perusahaan')) ? "selected='true'" : ""; ?>>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('perusahaan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Judul Lowongan</label>
                            <input type="text" class="form-control <?= ($errors->first('judul_lowongan') != "") ? 'is-invalid' : ''; ?>" name="judul_lowongan" value="{{ old('judul_lowongan') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('judul_lowongan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Deskripsi Lowongan</label>
                            <textarea class="ckeditor <?= ($errors->first('deskripsi_lowongan') != "") ? 'is-invalid' : ''; ?>" name="deskripsi_lowongan" style="z-index:99999">{{ old('deskripsi_lowongan') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('deskripsi_lowongan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Gambar Lowongan</label>
                            <div>
                                <input type="file" class="<?= ($errors->first('file') != "") ? 'is-invalid' : ''; ?>" name="file">
                                <br />
                                <span style="color: red;">Tipe File Harus .png|.jpg|.jpeg</span>
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('file') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Detail Modal -->
<div class="modal fade modal-success" id="exampleModalSuccess" aria-hidden="true" aria-labelledby="exampleModalSuccess" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Nama Perusahaan</b></label>
                        <div>
                            <span id="nama_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Judul Lowongan</b></label>
                        <div>
                            <span id="judul_lowongan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Deskripsi Lowongan</b></label>
                        <div>
                            <span id="deksripsi_lowongan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Gambar Lowongan</b></label>
                        <div>
                            <img class="img-fluid" id="gambar_lowongan_detail" src="" alt="..." style="width: auto;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Edit Modal -->
<div class="modal fade modal-info" id="exampleModalInfo" aria-hidden="true" aria-labelledby="exampleModalInfo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <form method="POST" action="{{ URL('admin/pekerjaan/update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edit" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Perusahaan</label>
                            <select name="perusahaan_edit" id="perusahaan_edit" class="form-control <?= ($errors->first('perusahaan') != "") ? 'is-invalid' : ''; ?>">
                                <option value="">--- Pilih perusahaan ---</option>
                                @foreach($perusahaan as $row)
                                <option value="{{ $row->perusahaan->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('perusahaan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Judul Lowongan</label>
                            <input type="text" class="form-control <?= ($errors->first('judul_lowongan') != "") ? 'is-invalid' : ''; ?>" name="judul_lowongan_edit" id="judul_lowongan_edit" />
                            <div class="invalid-feedback">
                                {{ $errors->first('judul_lowongan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Deskripsi Lowongan</label>
                            <textarea class="ckeditor <?= ($errors->first('deskripsi_lowongan') != "") ? 'is-invalid' : ''; ?>" name="deskripsi_lowongan_edit" id="deskripsi_lowongan_edit" style="z-index:99999"></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('deskripsi_lowongan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Gambar Lowongan</label>
                            <div>
                                <img class="img-fluid" id="gambar_lowongan_edit" src="" alt="..." style="width: auto;">
                            </div>
                            <br />
                            <div>
                                <input type="file" class="<?= ($errors->first('file_edit') != "") ? 'is-invalid' : ''; ?>" name="file_edit">
                                <br />
                                <span style="color: red;">Tipe File Harus .png|.jpg|.jpeg</span>
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('file_edit') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script type="text/javascript">
    function data_detail(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL('admin/pekerjaan/detail') }}" + "/" + id,
            cache: false,
            dataType: "json",
            success: function(msg) {
                $("#nama_perusahaan_detail").html(msg['nama_perusahaan_detail']).show();
                $("#judul_lowongan_detail").html(msg['judul_lowongan_detail']).show();
                $("#deksripsi_lowongan_detail").html(msg['deksripsi_lowongan_detail']).show();
                $("#gambar_lowongan_detail").attr('src', msg['gambar_lowongan_detail']);
            },
            error: function() {
                alert("Error.");
            }
        });
    }

    function data_edit(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL('admin/pekerjaan/edit') }}" + "/" + id,
            cache: false,
            dataType: "json",
            success: function(msg) {
                $("#id_edit").val(msg['id_edit']);
                $("#perusahaan_edit").val(msg['perusahaan_edit']);
                $("#judul_lowongan_edit").val(msg['judul_lowongan_edit']);
                //$("#deskripsi_lowongan_edit").val();
                CKEDITOR.instances.deskripsi_lowongan_edit.setData(msg['deskripsi_lowongan_edit']);
                $("#gambar_lowongan_edit").attr('src', msg['gambar_lowongan_edit']);
            },
            error: function() {
                alert("Error.");
            }
        });
    }
</script>
@endsection