@extends('layouts.defaultlanding')

@section('title')
Beranda
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush

@section('content')

<section class="py-8">
    <div class="bg-holder bg-size" style="background-image:url({{asset('/')}}assets/img/bg/hero-bg.png);background-position:top center;background-size:cover;">
    </div>
    <div class="container">
      <div class="row d-flex flex-md-row-reverse">
        <div class="bg-holder bg-size" style="background-image:url({{asset('/')}}assets/img/bg/dot-bg.png);background-position:bottom right;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="col-lg-5 z-index-2">
          <form class="row g-3" action="{{ route('login') }}" method="POST" >
            @csrf
            <div class="col-md-12">
              <label  for="inputName">Username :</label>
              <input class="form-control form-livedoc-contro @error('identity')
              is-invalid
              @enderror" id="inputName"  placeholder="Username" autocomplete="nope" name="identity" />
                @error('identity')
                <div class="invalid-feedback text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12">
              <label  for="inputPhone">Password :</label>
              <input class="form-control form-livedoc-control @error('password')
              is-invalid
              @enderror" type="password" placeholder="Password" autocomplete="nope" name="password" />
              @error('password')
              <div class="invalid-feedback text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-primary rounded-pill" type="submit">Login</button>
            </div>
          </form>
        </div>
        <div class="col-lg-7 z-index-2 mb-5"><img class="w-100" src="{{url('/')}}/assets/img/undraw/undraw_maintenance_re_59vn.svg" alt="..." /></div>

        <div class="col-lg-5 z-index-2">
            <div class="row">
                <h3>Demo : </h3>

            <div class="col-md-4">
                <h5>Sebagai : Admin</h5>
                <label  for="inputPhone">Username : admin</label>
                <br>
                <label  for="inputPhone">Password : admin</label>
            </div>

            <div class="col-md-4">
                <h5>Sebagai : Operator</h5>
                <label  for="inputPhone">Username : operator</label>
                <br>
                <label  for="inputPhone">Password : operator</label>
            </div>

            <div class="col-md-4">
                <h5>Sebagai : Kepala Gedung</h5>
                <label  for="inputPhone">Username : kepalagedung</label>
                <br>
                <label  for="inputPhone">Password : kepalagedung</label>
            </div>

        </div>

    </div>
      </div>
    </div>
  </section>




@endsection

