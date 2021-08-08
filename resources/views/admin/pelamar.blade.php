@extends('admin.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Pelamar</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/admin/pelamar') }}">Pelamar</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    <!-- Panel Basic -->
    @if ($message = Session::get('pelamar_admin_action'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title">Data Pelamar</h3>
        </header>
        <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelamar</th>
                        <th>Judul Lowongan</th>
                        <th>Perusahaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $seq_number = 1; ?>
                    @foreach($all_data as $row)
                    <tr>
                        <td><?= $seq_number; ?></td>
                        <td><?= $row->nama_lengkap; ?></td>
                        <td><?= $row->job->judul_lowongan; ?></td>
                        <td><?= $row->job->perusahaan->user->nama; ?></td>
                        <td>
                            <button class="btn btn-success" role="button" onclick="data_detail(<?= $row->id; ?>)" data-target="#exampleModalSuccess" data-toggle="modal"><i class="fa fa-info" title="Detail Data"></i></button>
                            <a class="btn btn-danger" href="{{ URL('admin/pelamar/delete/'.$row->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $seq_number++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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
                        <label><b>Nama Lengkap</b></label>
                        <div>
                            <span id="nama_pelamar">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Alamat Lengkap</b></label>
                        <div>
                            <span id="alamat_pelamar">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <label><b>Domisili Alamat</b></label>
                        <div>
                            <span id="domisili_pelamar">-</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 form-group">
                        <label><b>Email</b></label>
                        <div>
                            <span id="email_pelamar">-</span>
                        </div>
                    </div>
                    <div class="col-xl-6 form-group">
                        <label><b>No. Handphone</b></label>
                        <div>
                            <span id="no_hp_pelamar">-</span>
                        </div>
                    </div>
                    <div class="col-xl-6 form-group">
                        <label><b>Posisi Yang Diinginkan</b></label>
                        <div>
                            <span id="posisi_pelamar">-</span>
                        </div>
                    </div>
                    <div class="col-xl-6 form-group">
                        <label><b>File CV</b></label>
                        <div>
                            <a href="" class="btn btn-success" id="file_cv_pelamar" download>Download</a>
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

<script type="text/javascript">
    function data_detail(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL('admin/pelamar/detail') }}" + "/" + id,
            cache: false,
            dataType: "json",
            success: function(msg) {
                $("#nama_pelamar").html(msg['nama_pelamar']).show();
                $("#alamat_pelamar").html(msg['alamat_pelamar']).show();
                $("#domisili_pelamar").html(msg['domisili_pelamar']).show();
                $("#email_pelamar").html(msg['email_pelamar']).show();
                $("#no_hp_pelamar").html(msg['no_hp_pelamar']).show();
                $("#posisi_pelamar").html(msg['posisi_pelamar']).show();
                $("#file_cv_pelamar").attr('href', msg['file_cv_pelamar']);
            },
            error: function() {
                alert("Error.");
            }
        });
    }
</script>
@endsection