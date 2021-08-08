@extends('index')
@section('content')
<style>
    @media (max-width: 767.98px) {
        .offcanvas-collapse {
            position: fixed;
            top: 56px;
            /* Height of navbar */
            bottom: 0;
            width: 100%;
            padding-right: 1rem;
            padding-left: 1rem;
            overflow-y: auto;
            background-color: var(--gray-dark);
            transition: -webkit-transform .3s ease-in-out;
            transition: transform .3s ease-in-out;
            transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
            -webkit-transform: translateX(100%);
            transform: translateX(100%);
        }

        .offcanvas-collapse.open {
            -webkit-transform: translateX(-1rem);
            transform: translateX(-1rem);
            /* Account for horizontal padding on navbar */
        }
    }

    .text-white-50 {
        color: rgba(255, 255, 255, .5);
    }

    .bg-purple {
        background-color: var(--purple);
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }

    .lh-100 {
        line-height: 1;
    }

    .lh-125 {
        line-height: 1.25;
    }

    .lh-150 {
        line-height: 1.5;
    }
</style>
<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="{{ URL('assets/logo.png') }}" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Kategori Bidang Pekerjaan : {{ $categorie->deskripsi }}</h6>
        </div>
    </div>
    <?php $cek_data_lowongan = count($job); ?>
    <?php if ($cek_data_lowongan > 0) { ?>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Semua Daftar Lowongan</h6>
            @foreach($job as $row)
            <div class="media text-muted pt-3">
                <?php $path = URL('storage/logo_perusahaan/' . $row->logo_perusahaan); ?>
                <img src="<?= $path; ?>" alt="..." class="mr-2 rounded" style="width: 5%;">
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">{{ $row->nama }}</strong>
                    <?php echo substr($row->judul_lowongan, 0, 50); ?>
                </p>
                <a role="button" class="btn btn-info btn-sm" href="{{ URL('data-pekerjaan-detail/'.$row->id_job) }}">Lihat Lebih Detail</a>
            </div>
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="{{ URL('/') }}">Kembali ke Home</a>
            </small>
        </div>
    <?php } else { ?>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Tidak ada data lowongan.</h6>
            <small class="d-block text-right mt-3">
                <a href="{{ URL('/') }}">Kembali ke Home</a>
            </small>
        </div>
    <?php } ?>
</main>
@endsection