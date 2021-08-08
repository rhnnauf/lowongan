@extends('perusahaan.index')
@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu</li>
        <li class="breadcrumb-item"><a href="{{ URL('/perusahaan/dashboard') }}">Dashboard</a></li>
    </ol>
    <div class="page-header-actions">
    </div>
</div>
<div class="page-content">
    @if ($message = Session::get('alert-login-perusahaan'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <!-- Panel Basic -->
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title"></h3>
        </header>
        <div class="panel-body">
            <?php $data_admin = \App\user::find(session('perusahaan_id')); ?>
            <h1>Halo {{ $data_admin->nama }}.</h1>
            <br />
            <div>
                <p>Jangan lupa logout setelah memakai sistem ini.</p>
            </div>
        </div>
    </div>
</div>
@endsection