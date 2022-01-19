@extends('layouts.default')

@section('title')
Tambah Monitoring Detail
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('monitoring')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('monitoring.detail.store',$id->id)}}" method="post">
                    @csrf

                    <div class="row">



                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="mesin_id">Mesin <code>*)</code></label>

                            <select class="js-example-basic-single form-control-sm @error('mesin_id')
                                is-invalid
                            @enderror" name="mesin_id"  style="width: 75%" >
                                <option disabled selected value=""> Pilih Mesin</option>
                                @foreach ($mesin as $t)
                                    <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                                @endforeach
                              </select>

                          @error('kategori_id')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>

                      <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="keterangan">Keterangan <code>*)</code></label>

                            <select class="js-example-basic-single form-control-sm @error('keterangan')
                                is-invalid
                            @enderror" name="keterangan"  style="width: 75%" >
                                <option disabled selected value=""> Pilih Keterangan</option>
                                <option>Baik</option>
                                <option>Rusak</option>
                                <option>Hilang</option>
                              </select>

                          @error('keterangan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>



                    </div>

                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
