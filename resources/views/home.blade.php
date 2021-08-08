@extends('index')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <div>
        <img class="img-fluid" src="{{ URl('assets/logo.png') }}" alt="..." style="width: 25%;">
    </div>
    <h1 class="display-4">Selamat Datang</h1>
    <p class="lead">Silahkan melihat data lowongan pekerjaan yang tersedia.</p>
</div>
<center>
    <?php $categorie = \App\Categorie::all(); ?>
    @if($categorie!=NULL)
    <div class="container">
        <p>Bidang Pekerjaan</p>
        <div class="card-deck mb-3 text-center">
            @foreach ($categorie as $cat)
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal"></h4>
                        </div>
                        <div class="card-body">
                            <div>
                            </div>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    {{ $cat->deskripsi }}
                                </li>
                            </ul>
                            <a type="button" class="btn btn-md btn-block btn-outline-primary" href="{{ URl('bidang-pekerjaan/'.$cat->id) }}">Lihat Lowongan </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <p>
    <h1 class="display-4">Maaf kategori produk tidak tersedia.</h1>
    </p>
    @endif
</center>
@endsection