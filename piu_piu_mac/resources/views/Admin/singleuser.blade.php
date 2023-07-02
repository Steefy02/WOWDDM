@extends('Admin.dashboard')
@section('page-name', 'Editeaza Utilizator')

@section('content')

<form class='col-lg-4 col-sm-10' method='post' action="{{route('admin-update-user', ['id' => $user->id])}}">
  @csrf
  <div class="form-group row">
    <label for="staticID" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticID" value="{{$user->id}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticName" class="col-sm-2 col-form-label">Nume</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticName" value="{{$user->name}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name='email' class="form-control" id="inputEmail" placeholder="Email" value="{{$user->email}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputAdmin" class="col-sm-2 col-form-label">Admin</label>
    <div class="col-sm-10">
      @if($user->is_admin)
      <input class="form-check-input" type="checkbox" name='admin' id="inputAdmin" style='margin-left: 0px; margin-top:0.5rem;' checked>
      @else
      <input class="form-check-input" type="checkbox" name='admin' style='margin-left: 0px; margin-top:0.5rem;' id="inputAdmin">
      @endif
    </div>
  </div>
  <button type='submit' class='btn' style='background-color: #4e73df;color:white;'>Salveaza</button>
  @if(Session::get('message'))
  <p style='color: green; margin-top: 15px;'>Userul {{$user->name}} a fost actualizat</p>
  @endif
</form>

@endsection