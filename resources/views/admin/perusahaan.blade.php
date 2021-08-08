@extends('admin.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Perusahaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/admin/perusahaan') }}">Perusahaan</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <!-- Panel Basic -->
    @if ($message = Session::get('perusahaan_action'))
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
                        <th>Nama Perusahaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $seq_number = 1; ?>
                    @foreach($all_data as $row)
                    <tr>
                        <td>{{ $seq_number }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>
                            <button class="btn btn-success" role="button" onclick="data_detail(<?= $row->id; ?>)" data-target="#exampleModalSuccess" data-toggle="modal"><i class="fa fa-info" title="Detail Data"></i></button>
                            <button class="btn btn-info" role="button" onclick="data_edit(<?= $row->id; ?>)" data-target="#exampleModalInfo" data-toggle="modal"><i class="fa fa-pencil" title="Edit Data"></i></button>
                            <a class="btn btn-danger" href="{{ URL('admin/perusahaan/delete/'.$row->id) }}"><i class="fa fa-trash"></i></a>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form method="POST" action="{{ URL('admin/perusahaan_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" class="form-control <?= ($errors->first('nama_perusahaan') != "") ? 'is-invalid' : ''; ?>" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('nama_perusahaan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Kategori Bidang Pekerjaan</label>
                            <select name="kategori_bidang" class="form-control <?= ($errors->first('kategori_bidang') != "") ? 'is-invalid' : ''; ?>">
                                <option value="">--- Pilih Bidang Pekerjaan ---</option>
                                @foreach($bidang_pekerjaan as $row)
                                <option value="{{ $row->id }}" <?= ($row->id == old('kategori_bidang')) ? "selected='true'" : ""; ?>>{{ $row->deskripsi }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('kategori_bidang') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Deskripsi Perusahaan</label>
                            <textarea name="deskripsi_perusahaan" class="ckeditor <?= ($errors->first('deskripsi_perusahaan') != "") ? 'is-invalid' : ''; ?>" style="z-index:99999">{{ old('deskripsi_perusahaan') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('deskripsi_perusahaan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control <?= ($errors->first('provinsi') != "") ? 'is-invalid' : ''; ?>" name="provinsi" value="{{ old('provinsi') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('provinsi') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kota / Kabupaten</label>
                            <input type="text" class="form-control <?= ($errors->first('kota') != "") ? 'is-invalid' : ''; ?>" name="kota" value="{{ old('kota') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('kota') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control <?= ($errors->first('kecamatan') != "") ? 'is-invalid' : ''; ?>" name="kecamatan" value="{{ old('kecamatan') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('kecamatan') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control <?= ($errors->first('kelurahan') != "") ? 'is-invalid' : ''; ?>" name="kelurahan" value="{{ old('kelurahan') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('kelurahan') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Dusun</label>
                            <input type="text" class="form-control <?= ($errors->first('dusun') != "") ? 'is-invalid' : ''; ?>" name="dusun" value="{{ old('dusun') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('dusun') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control <?= ($errors->first('kode_pos') != "") ? 'is-invalid' : ''; ?>" name="kode_pos" value="{{ old('kode_pos') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('kode_pos') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat_perusahaan" class="form-control <?= ($errors->first('alamat_perusahaan') != "") ? 'is-invalid' : ''; ?>">{{ old('alamat_perusahaan') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('alamat_perusahaan') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 form-group">
                            <label>No. Telepon</label>
                            <input type="number" class="form-control <?= ($errors->first('no_telp') != "") ? 'is-invalid' : ''; ?>" name="no_telp" value="{{ old('no_telp') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('no_telp') }}
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>No. Hanphone / Whatsapp</label>
                            <input type="text" class="form-control <?= ($errors->first('no_hp') != "") ? 'is-invalid' : ''; ?>" name="no_hp" value="{{ old('no_hp') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('no_hp') }}
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>Email</label>
                            <input type="email" class="form-control <?= ($errors->first('email') != "") ? 'is-invalid' : ''; ?>" name="email" value="{{ old('email') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>Password</label>
                            <input type="password" class="form-control <?= ($errors->first('password') != "") ? 'is-invalid' : ''; ?>" name="password" value="{{ old('password') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Logo Perusahaan</label>
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
<div class="modal fade modal-success" id="exampleModalSuccess" aria-hidden="true" aria-labelledby="exampleModalSuccess" role="dialog" tabindex="-1">
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
                        <label><b>Kategori Bidang Pekerjaan</b></label>
                        <div>
                            <span id="kategori_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Deskripsi Perusahaan</b></label>
                        <div>
                            <span id="deskripsi_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label><b>Provinsi</b></label>
                        <div>
                            <span id="provinsi_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>Kota / Kabupaten</b></label>
                        <div>
                            <span id="kota_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>Kecamatan</b></label>
                        <div>
                            <span id="kecamatan_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>Kelurahan</b></label>
                        <div>
                            <span id="kelurahan_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>Dusun</b></label>
                        <div>
                            <span id="dusun_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>Kode Pos</b></label>
                        <div>
                            <span id="kode_pos_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Alamat Lengkap</b></label>
                        <div>
                            <span id="alamat_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label><b>Email</b></label>
                        <div>
                            <span id="email_perusahaan_detail">-</span>
                        </div>
                    </div>

                    <div class="col-xl-4 form-group">
                        <label><b>No. Telepon</b></label>
                        <div>
                            <span id="no_telp_perusahaan_detail">-</span>
                        </div>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label><b>No. Hanphone / Whatsapp</b></label>
                        <div>
                            <span id="no_hp_perusahaan_detail">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Logo Perusahaan</b></label>
                        <div>
                            <img class="img-fluid" id="logo_perusahaan_detail" src="" alt="..." style="width: auto;">
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
<div class="modal fade modal-info" id="exampleModalInfo" aria-hidden="true" aria-labelledby="exampleModalInfo" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <form method="POST" action="{{ URL('admin/perusahaan/update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edit" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" class="form-control <?= ($errors->first('nama_perusahaan_edit') != "") ? 'is-invalid' : ''; ?>" name="nama_perusahaan_edit" id="nama_perusahaan_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('nama_perusahaan_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Kategori Bidang Pekerjaan</label>
                            <select name="kategori_bidang_edit" id="kategori_bidang_edit" class="form-control <?= ($errors->first('kategori_bidang_edit') != "") ? 'is-invalid' : ''; ?>">
                                <option value="">--- Pilih Bidang Pekerjaan ---</option>
                                @foreach($bidang_pekerjaan as $row)
                                <option value="{{ $row->id }}">{{ $row->deskripsi }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('kategori_bidang_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Deskripsi Perusahaan</label>
                            <textarea name="deskripsi_perusahaan_edit" id="deskripsi_perusahaan_edit" class="ckeditor <?= ($errors->first('deskripsi_perusahaan_edit') != "") ? 'is-invalid' : ''; ?>" style="z-index:99999"></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('deskripsi_perusahaan_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control <?= ($errors->first('provinsi_edit') != "") ? 'is-invalid' : ''; ?>" name="provinsi_edit" id="provinsi_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('provinsi_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kota / Kabupaten</label>
                            <input type="text" class="form-control <?= ($errors->first('kota_edit') != "") ? 'is-invalid' : ''; ?>" name="kota_edit" id="kota_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('kota_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control <?= ($errors->first('kecamatan_edit') != "") ? 'is-invalid' : ''; ?>" name="kecamatan_edit" id="kecamatan_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('kecamatan_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control <?= ($errors->first('kelurahan_edit') != "") ? 'is-invalid' : ''; ?>" name="kelurahan_edit" id="kelurahan_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('kelurahan_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Dusun</label>
                            <input type="text" class="form-control <?= ($errors->first('dusun_edit') != "") ? 'is-invalid' : ''; ?>" name="dusun_edit" id="dusun_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('dusun_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-4 form-group">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control <?= ($errors->first('kode_pos_edit') != "") ? 'is-invalid' : ''; ?>" name="kode_pos_edit" id="kode_pos_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('kode_pos_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat_perusahaan_edit" id="alamat_perusahaan_edit" class="form-control <?= ($errors->first('alamat_perusahaan_edit') != "") ? 'is-invalid' : ''; ?>"></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('alamat_perusahaan_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 form-group">
                            <label>No. Telepon</label>
                            <input type="number" class="form-control <?= ($errors->first('no_telp_edit') != "") ? 'is-invalid' : ''; ?>" name="no_telp_edit" id="no_telp_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('no_telp_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>No. Hanphone / Whatsapp</label>
                            <input type="text" class="form-control <?= ($errors->first('no_hp_edit') != "") ? 'is-invalid' : ''; ?>" name="no_hp_edit" id="no_hp_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('no_hp_edit') }}
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>Email</label>
                            <div>
                                <span id="email_edit">-</span>
                            </div>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label>Password</label>
                            <input type="password" class="form-control <?= ($errors->first('password_edit') != "") ? 'is-invalid' : ''; ?>" name="password_edit" id="password_edit">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_edit') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label>Logo Perusahaan</label>
                            <div>
                                <img class="img-fluid" id="logo_perusahaan_edit" src="" alt="..." style="width: auto;">
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
            url: "{{ URL('admin/perusahaan/detail') }}" + "/" + id,
            cache: false,
            dataType: "json",
            success: function(msg) {
                $("#nama_perusahaan_detail").html(msg['nama_perusahaan_detail']).show();
                $("#kategori_perusahaan_detail").html(msg['kategori_perusahaan_detail']).show();
                $("#deskripsi_perusahaan_detail").html(msg['deskripsi_perusahaan_detail']).show();
                $("#provinsi_perusahaan_detail").html(msg['provinsi_perusahaan_detail']).show();
                $("#kota_perusahaan_detail").html(msg['kota_perusahaan_detail']).show();
                $("#kecamatan_perusahaan_detail").html(msg['kecamatan_perusahaan_detail']).show();
                $("#kelurahan_perusahaan_detail").html(msg['kelurahan_perusahaan_detail']).show();
                $("#dusun_perusahaan_detail").html(msg['dusun_perusahaan_detail']).show();
                $("#kode_pos_perusahaan_detail").html(msg['kode_pos_perusahaan_detail']).show();
                $("#alamat_perusahaan_detail").html(msg['alamat_perusahaan_detail']).show();
                $("#email_perusahaan_detail").html(msg['email_perusahaan_detail']).show();
                $("#no_telp_perusahaan_detail").html(msg['no_telp_perusahaan_detail']).show();
                $("#no_hp_perusahaan_detail").html(msg['no_hp_perusahaan_detail']).show();
                $("#logo_perusahaan_detail").attr('src', msg['logo_perusahaan_detail']);
            },
            error: function() {
                alert("Error.");
            }
        });
    }

    function data_edit(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL('admin/perusahaan/edit') }}" + "/" + id,
            cache: false,
            dataType: "json",
            success: function(msg) {
                $("#id_edit").val(msg['id']);
                $("#nama_perusahaan_edit").val(msg['nama_perusahaan_edit']);
                $("#kategori_bidang_edit").val(msg['kategori_bidang_edit']);
                //$("#deskripsi_perusahaan_edit").val(msg['deskripsi_perusahaan_edit']);
                CKEDITOR.instances.deskripsi_perusahaan_edit.setData(msg['deskripsi_perusahaan_edit']);
                $("#provinsi_edit").val(msg['provinsi_edit']);
                $("#kota_edit").val(msg['kota_edit']);
                $("#kecamatan_edit").val(msg['kecamatan_edit']);
                $("#kelurahan_edit").val(msg['kelurahan_edit']);
                $("#dusun_edit").val(msg['dusun_edit']);
                $("#kode_pos_edit").val(msg['kode_pos_edit']);
                $("#alamat_perusahaan_edit").val(msg['alamat_perusahaan_edit']);
                $("#email_edit").html(msg['email_edit']).show();
                $("#no_telp_edit").val(msg['no_telp_edit']);
                $("#no_hp_edit").val(msg['no_hp_edit']);
                $("#logo_perusahaan_edit").attr('src', msg['logo_perusahaan_edit']);
                $("#password_edit").val(msg['password_edit']);
            },
            error: function() {
                alert("Error.");
            }
        });
    }
</script>
@endsection