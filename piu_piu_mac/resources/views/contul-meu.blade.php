@extends('template-top-bar')
@section('title', 'Contul Meu')

@section('styles')

<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

@endsection

@section('section-title', 'Sectiune Clienti')

@section('top-bar-content')

<div class="container-xxl flex-grow-1 container-p-y" style='margin-top: 5rem; margin-bottom: 5rem'>
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-8">
        <ul class="nav nav-pills mb-3 row">
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link active" href="{{route('account')}}" style="background-color:#110a29"><i class="bx bx-user me-1"></i> Setari Cont</a>
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('cart')}}" style="color: #110a29"
                ><i class="bx bx-bell me-1"></i> Cos</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('favorites')}}" style="color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Favorite</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('orders-client')}}" style="color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Comenzi</a
              >
            </li>
          </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Detaliile Profilului</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body">
            <form id="formAccountSettings" method="POST" action='{{route('update-user', ['id' => Auth::user()->id])}}'>
              @csrf
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="firstName" class="form-label">Nume</label>
                  <input
                    class="form-control"
                    type="text"
                    id="name"
                    name="name"
                    value="{{$user->name}}"
                    autofocus
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="lastName" class="form-label">Judet</label>
                  <input class="form-control" type="text" name="state" id="state" placeholder='Introdu judet' value="{{$user->state}}"/>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                    class="form-control"
                    type="text"
                    id="email"
                    name="email"
                    placeholder="john.doe@example.com"
                    value="{{$user->email}}"
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="organization" class="form-label">Oras</label>
                  <input
                    type="text"
                    class="form-control"
                    id="city"
                    name="city"
                    value="{{$user->city}}"
                    placeholder="Introdu oras"
                    value="{{$user->city}}"
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="phoneNumber">Numar de telefon</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">RO (+40)</span>
                    <input
                      type="text"
                      id="phone"
                      name="phone"
                      class="form-control"
                      placeholder="Introdu telefon"
                      value="{{substr($user->phone, 1)}}"
                    />
                  </div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">Adresa</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Introdu adresa" value="{{$user->address}}" />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="state" class="form-label">Tara</label>
                  <input class="form-control" type="text" id="country" name="country" value="Romania" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="zipCode" class="form-label">Cod postal</label>
                  <input
                    type="text"
                    class="form-control"
                    id="zip"
                    name="zip"
                    placeholder="Introdu codul postal"
                    maxlength="5"
                    value="{{$user->zip}}"
                  />
                </div>
              </div>
              <div class="mt-2">
                <button type="submit" class="btn me-2" style='background-color:#110a29; color: white;'>Salveaza</button>
              </div>
            </form>
            @if(session('message'))
            <p style='color:green'>Datele au fost actualizate cu succes</p>
            @endif
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>

@endsection

{{-- @section('scripts')
<script>

var cont = document.getElementById('cont');
var cos = document.getElementById('cos');
var fav = document.getElementById('fav');
var ord = document.getElementById('ord');

function change_state(elem) {
    cont.children[0].classList.remove('active');
    cos.children[0].classList.remove('active');
    fav.children[0].classList.remove('active');
    ord.children[0].classList.remove('active');

    elem.children[0].classList.add('active');
}

</script>
@endsection --}}