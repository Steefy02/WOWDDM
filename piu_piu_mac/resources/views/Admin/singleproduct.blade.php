@extends('Admin.dashboard')

@section('page-name', 'Editeaza Podus')

@section('styles')

<link href="{{asset('/css/style2.css')}}" rel="stylesheet">

@endsection

@section('content')
<div class="row">
<form class='col-lg-4 col-sm-10' method='post' action="{{route('admin-update-product', ['id' => $product->id])}}">
    @csrf
    <div class="form-group row">
      <label for="staticID" class="col-sm-2 col-form-label">ID</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticID" value="{{$product->id}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 col-form-label">Nume</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='name' id="inputName" value="{{$product->name}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">Brand</label>
      <div class="col-sm-10">
        <input type="text" name='brand' class="form-control" id="inputBrand" placeholder="Email" value="{{$product->brand}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputDescription" class="col-sm-2 col-form-label">Descriere Sumara</label>
      <div class="col-sm-10">
        <textarea name='description' class="form-control" id="inputDescription" placeholder="descripion">{{$product->description}}</textarea>
      </div>
    </div>
    <div class="form-group row">
        <label for="inputDescription" class="col-sm-2 col-form-label">Descriere</label>
        <div class="col-sm-10">
          <textarea name='full_description' class="form-control" id="inputDescription" placeholder="descripion">{{$product->full_description}}</textarea>
        </div>
      </div>
    <div class="form-group row">
      <label for="inputUnits" class="col-sm-2 col-form-label">Stoc</label>
      <div class="col-sm-10">
        <input type="text" name='units' class="form-control" id="inputUnits" placeholder="Stoc" value="{{$product->units}}">
      </div>
    </div>
    <div class="form-group row">
        <label for="inputUnits" class="col-sm-2 col-form-label">Marime</label>
        <div class="col-sm-10">
            <input type="text" name="size" class="form-control" value="{{$product->size}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputUnits" class="col-sm-2 col-form-label">Material</label>
        <div class="col-sm-10">
            <input type="text" name="material" class="form-control" value="{{$product->material}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputUnits" class="col-sm-2 col-form-label">Vizibilitate</label>
        <div class="col-sm-10">
            <select class="form-select form-select-md" aria-label="Selecteaza Vizibiliate" name='visible'>
                @if($product->visible == '1')
                <option value="yes" selected>Vizibil</option>
                <option value="no">Invizibil</option>
                @else
                <option value="yes">Vizibil</option>
                <option value="no" selected>Invizibil</option>
                @endif
            </select>
        </div>
      </div>
    <div class="form-group row">
      <label for="inputPrice" class="col-sm-2 col-form-label">Pret (RON)</label>
      <div class="col-sm-10">
        <input type="text" name='price' class="form-control" id="inputPrice" placeholder="Pret" value="{{$product->price}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputDiscount" class="col-sm-2 col-form-label">Discount %</label>
      <div class="col-sm-10">
        <input type="number" min="0" max="100" name='discount' class="form-control" id="inputDiscount" placeholder="Discount" value="{{$product->discount}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputType" class="col-sm-2 col-form-label">Categorie</label>
      @php
              use App\Http\Controllers\AdminController;
              $cat_all = AdminController::get_all_categories();
        @endphp
          <div class="col-sm-10">
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typefemei' id="selFemei" style="display: none">
                @foreach ($cat_all as $cat)
                @if($cat->gen == 1 || $cat->gen == 4)
                    <option value="{{$cat->id}}" @if($product->category == '1' && $product->type == $cat->id) selected @endif>{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typebarbati' id="selBarbati" style="display: none">
                @foreach ($cat_all as $cat)
                @if($cat->gen == 2 || $cat->gen == 4)
                    <option value="{{$cat->id}}" @if($product->category == '2' && $product->type == $cat->id) selected @endif>{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
            <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='typecopii' id="selCopii" style='display: none'>
                @foreach ($cat_all as $cat)
                @if($cat->gen == 3 || $cat->gen == 4)
                    <option value="{{$cat->id}}" @if($product->category == '2' && $product->type == $cat->id) selected @endif>{{$cat->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
      <label for="inputCategory" class="col-sm-2 col-form-label">Gen</label>
      <div class="col-sm-10">
        <select class="form-select form-select-md" aria-label="Selecteaza Genul" name='category' id="gen">
            @if($product->category == 1)
            <option value="1" selected>Femei</option>
            @else
            <option value="1">Femei</option>
            @endif
            @if($product->category == 2)
            <option value="2" selected>Barbati</option>
            @else
            <option value="2">Barbati</option>
            @endif
            @if($product->category == 3)
            <option value="3" selected>Copii</option>
            @else
            <option value="3">Copii</option>
            @endif
            @if($product->category == 0)
            <option selected>Selecteaza Gen</option>
            @endif
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputImage" class="col-sm-2 col-form-label">Imagine</label>
      <div class="col-sm-10">
        <input type="file" name='upFile' class="form-control" id="inputImage">
      </div>
    </div>
    <input type="hidden" value="ok" name='checkVal' id="checkVal">
    <button type='submit' class='btn' style='background-color: #4e73df;color:white;' id="editprod">Salveaza</button> 
    <button type='submit' class='btn' style='background-color: #4e73df;color:white;' id="gopage">Catre pagina produsului</button>
    <button class='btn' style='background-color: red;color:white;' id="delprod">Sterge</button>
    @if(Session::has('message'))
    <p style='color: green; margin-top: 15px;'>Produsul {{$product->name}} a fost actualizat</p>
    @endif
  </form>
  @php
    function apply_discount($price, $discount) {
        return $price - ($price * ($discount / 100));
    }
  @endphp
  <div class="col-md-8 col-sm-12">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-5 col-md-12 col-sm-12 pb-1" style="margin:0 auto">
        <div class="card product-item border-0 mb-4" style="margin: 0 auto; margin-top: 2rem">
            <a href="https://wowddm.ro/produs/{{$product->id}}"><div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" style='height: 38rem;' src="{{asset('/uploads/' . $product->image)}}" alt="">
            </div></a>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <a href="https://wowddm.ro/produs/{{$product->id}}"><h6 class="text-truncate mb-3">{{$product->name}}</h6></a>
                <div class="d-flex justify-content-center">
                    @if($product->discount > 0)
                    <h6>{{apply_discount($product->price, $product->discount)}} RON</h6>
                    <h6 class="text-muted ml-2"><del>{{$product->price}} RON</del></h6>
                    @else
                    <h6>{{$product->price}} RON</h6>
                    @endif
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="https://wowddm.ro/produs/{{$product->id}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Mai multe detalii</a>
                <a href="https://wowddm.ro/add-item/{{$product->id}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Adauga in cos</a>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $("#delprod").on('click', function() {
        document.getElementById('checkVal').value = "no";
    });

    $("#editprod").on('click', function() {
        document.getElementById('checkVal').value = "ok";
    });

    $("#gopage").on('click', function() {
        document.getElementById('checkVal').value = "go";
    });

    var sel = document.getElementById('gen');

    //alert(sel);

    document.getElementById('selFemei').style.display = "none";
    document.getElementById('selBarbati').style.display = "none";
    document.getElementById('selCopii').style.display = "none";
    if(sel.value == 1) {
        document.getElementById('selFemei').style.display = "block";
    }else if(sel.value == 2) {
        document.getElementById('selBarbati').style.display = "block";
    }else if(sel.value ==  3) {
        document.getElementById('selCopii').style.display = "block";
    }

    sel.onchange = function() {
        document.getElementById('selFemei').style.display = "none";
        document.getElementById('selBarbati').style.display = "none";
        document.getElementById('selCopii').style.display = "none";
        if(this.value == 1) {
            document.getElementById('selFemei').style.display = "block";
        }else if(this.value == 2) {
            document.getElementById('selBarbati').style.display = "block";
        }else if(this.value ==  3) {
            document.getElementById('selCopii').style.display = "block";
        }
    };
</script>
@endsection