@extends('Admin.dashboard')

@section('page-name', "Editeaza categoria")

@section('styles')

<link href="{{asset('/css/style2.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="row">
    <form class='col-lg-4 col-sm-10' method='post' action="{{route('admin-update-category', ['id' => $category->id])}}">
        @csrf
        <div class="form-group row">
            <label for="staticID" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticID" value="{{$category->id}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nume</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="gen" class="col-sm-2 col-form-label">gen</label>
            <div class="col-sm-10">
              <select class="form-select form-select-md" name="gen">
                <option value='1' @if($category->gen == '1') selected @endif>Femei</option>
                <option value='2' @if($category->gen == '2') selected @endif>Barbati</option>
                <option value='3' @if($category->gen == '3') selected @endif>Copii</option>
                <option value='4' @if($category->gen == '4') selected @endif>Toate genurile</option>
              </select>
            </div>
        </div>

        <input type="hidden" value="ok" name='checkVal' id="checkVal">
        <button type='submit' class='btn' style='background-color: #4e73df;color:white;' id="editcat">Salveaza</button> 
        <button class='btn' style='background-color: red;color:white;' id="delcat">Sterge</button>
        @if(Session::has('message'))
        <p style='color: green; margin-top: 15px;'>Categoria {{$category->name}} a fost actualizata</p>
        @endif

    </form>
</div>

@endsection

@section('scripts')
<script>
    $("#delcat").on('click', function() {
        document.getElementById('checkVal').value = "no";
    });

    $("#editcat").on('click', function() {
        document.getElementById('checkVal').value = "ok";
    });

</script>
@endsection