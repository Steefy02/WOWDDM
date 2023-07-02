@extends('Admin.dashboard')

@section('page-name', 'Adauga Podus')

@section('content')

<div class="row">
    <form class='col-lg-4 col-sm-10' method='post' action="{{route('admin-add-product-post')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
          <label for="staticID" class="col-sm-2 col-form-label">ID</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticID" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputName" class="col-sm-2 col-form-label">Nume</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name='name' id="inputName" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Brand</label>
          <div class="col-sm-10">
            <input type="text" name='brand' class="form-control" id="inputBrand" placeholder="Brand" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputDescription" class="col-sm-2 col-form-label">Descriere Sumara</label>
          <div class="col-sm-10">
            <textarea name='description' class="form-control" id="inputDescription" placeholder="Descriere" required></textarea>
          </div>
        </div>
        <div class="form-group row">
            <label for="inputDescription" class="col-sm-2 col-form-label">Descriere</label>
            <div class="col-sm-10">
              <textarea name='full_description' class="form-control" id="inputDescription" placeholder="Descriere" required></textarea>
            </div>
        </div>
        <div class="form-group row">
          <label for="inputUnits" class="col-sm-2 col-form-label">Stoc</label>
          <div class="col-sm-10">
            <input type="text" name='units' class="form-control" id="inputUnits" placeholder="Stoc" value="" required>
          </div>
        </div>
        <div class="form-group row">
            <label for="inputUnits" class="col-sm-2 col-form-label">Marime</label>
            <div class="col-sm-10">
                <input type="text" name="size" class="form-control" placeholder="marime" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputUnits" class="col-sm-2 col-form-label">Material</label>
            <div class="col-sm-10">
                <input type="text" name="material" class="form-control" placeholder="material" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputUnits" class="col-sm-2 col-form-label">Vizibilitate</label>
            <div class="col-sm-10">
                <select class="form-select form-select-md" aria-label="Selecteaza Vizibiliate" name='visible'>
                    <option value="yes" selected>Vizibil</option>
                    <option value="no">Invizibil</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
          <label for="inputPrice" class="col-sm-2 col-form-label">Pret (RON)</label>
          <div class="col-sm-10">
            <input type="text" name='price' class="form-control" id="inputPrice" placeholder="Pret" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputDiscount" class="col-sm-2 col-form-label">Discount %</label>
          <div class="col-sm-10">
            <input type="number" min="0" max="100" name='discount' class="form-control" id="inputDiscount" placeholder="Discount" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputType" class="col-sm-2 col-form-label">Categorie</label>
          @php
              use App\Http\Controllers\AdminController;
              $cat_all = AdminController::get_all_categories();
          @endphp
          <div class="col-sm-10">
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typeall' id="selAll">
                @foreach ($cat_all as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typefemei' id="selFemei" style="display: none">
                @foreach ($cat_all as $cat)
                @if($cat->gen == 1 || $cat->gen == 4)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typebarbati' id="selBarbati" style="display: none">
                @foreach ($cat_all as $cat)
                @if($cat->gen == 2 || $cat->gen == 4)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typecopii' id="selCopii" style='display: none'>
                @foreach ($cat_all as $cat)
                @if($cat->gen == 3 || $cat->gen == 4)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCategory" class="col-sm-2 col-form-label">Gen</label>
          <div class="col-sm-10">
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='category' id="gen">
                <option value="1">Femei</option>
                <option value="2">Barbati</option>
                <option value="3">Copii</option>
                <option selected value="4">Selecteaza Gen</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputImage" class="col-sm-2 col-form-label">Imagine</label>
          <div class="col-sm-10">
            <input type="file" name='upFile' class="form-control" id="inputImage" onchange="loadImg(event)" required>
          </div>
        </div>
        <button type='submit' class='btn' style='background-color: #4e73df;color:white;'>Salveaza</button>
        @if(Session::get('message'))
        <p style='color: green; margin-top: 15px;'>Produsul a fost adaugat!</p>
        @endif
        @if(Session::get('errMsg'))
        <p style='color: red; margin-top: 15px;'>{{Session::get('errMsg')}}</p>
        @endif
      </form>
      <div class="col-lg-8"style="display: none" id='imgdiv'>
        <h3 style="margin-bottom: 20px; text-align: center">Imaginea incarcata: </h3>
        <img id='preview' class="img-fluid rounded mx-auto" src="#">
      </div>
    </div>

@endsection

@section('scripts')
<script>

var loadImg = function(event) {
    var prev = document.getElementById('preview');
    prev.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgdiv').style.display = 'block';
}

document.getElementById('gen').onchange = function() {
    document.getElementById('selAll').style.display = "none";
    document.getElementById('selFemei').style.display = "none";
    document.getElementById('selBarbati').style.display = "none";
    document.getElementById('selCopii').style.display = "none";
    if(this.value == 1) {
        document.getElementById('selFemei').style.display = "block";
    }else if(this.value == 2) {
        document.getElementById('selBarbati').style.display = "block";
    }else if(this.value ==  3) {
        document.getElementById('selCopii').style.display = "block";
    }else {
        document.getElementById('selAll').style.display = "block";
    }
};


</script>
@endsection