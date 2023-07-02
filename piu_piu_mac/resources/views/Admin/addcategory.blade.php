@extends('Admin.dashboard')

@section('page-name', "Adauga categorie")

@section('styles')

<link href="{{asset('/css/style2.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="row">
    <form class='col-lg-4 col-sm-10' method='post' action="{{route('admin-add-category-post')}}">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nume</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="gen" class="col-sm-2 col-form-label">gen</label>
            <div class="col-sm-10">
              <select class="form-select form-select-md" name="gen">
                <option value='1'>Femei</option>
                <option value='2'>Barbati</option>
                <option value='3'>Copii</option>
                <option value='4' selected>Toate genurile</option>
              </select>
            </div>
        </div>

        <button type='submit' class='btn' style='background-color: #4e73df;color:white;' id="editcat">Adauga</button>

    </form>
</div>


@endsection