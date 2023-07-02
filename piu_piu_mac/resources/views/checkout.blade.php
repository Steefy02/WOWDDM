@extends('template-top-bar')
@section('title', 'WowDDM Checkout')

@section('styles')

<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('section-title', 'Checkout')

@section('top-bar-content')

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Date de Facturare</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nume</label>
                        <input class="form-control" type="text" name="billing_name" placeholder="nume complet" value="{{$user->name}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="billing_email" placeholder="exemplu@email.com" value="{{$user->email}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Numar de telefon</label>
                        <input class="form-control" type="text" name="billing_phone" placeholder="07xx xxx xxx" value="{{$user->phone}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Adresa</label>
                        <input class="form-control" type="text" name="billing_address" value="{{$user->address}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Oras</label>
                        <input class="form-control" type="text" name="billing_city" value="{{$user->city}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Judet</label>
                        <input class="form-control" type="text" name="billing_county" value="{{$user->state}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tara</label>
                        <input class="form-control" type="text" value="Romania" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Cod postal</label>
                        <input class="form-control" type="text" name="billing_zip" value="{{$user->zip}}" required>
                    </div>
                    {{-- <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <a class="btn" style='background-color: #110a29; color: white' data-toggle="collapse" data-target="#shipping-address">Livreaza catre alta adresa</a>
                        </div>
                    </div> --}}
                </div>
                <span id="error" style="color: red; display: none">Toate campurile sunt obligatorii</span>
            </div>
            {{-- <div class="collapse mb-4" id="shipping-address">
                <h4 class="font-weight-semi-bold mb-4">Date Livrare</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Adresa</label>
                        <input class="form-control" type="text" name="shipping-address">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Oras</label>
                        <input class="form-control" type="text" name="shipping-city">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Judet</label>
                        <input class="form-control" type="text" name="shipping-county">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tara</label>
                        <input class="form-control" type="text" placeholder="New York" value="Romania" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Cod postal</label>
                        <input class="form-control" type="text" name="shipping-zip">
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Totalul Comenzii</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Produse</h5>
                    @php $totals = 0; @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="d-flex justify-content-between">
                                <p>{{$details['name']}} x{{$details['quantity']}}</p>
                                <p>{{$details['price']}} RON</p>
                                @php $totals = $totals + $details['price'] * $details['quantity']; @endphp
                            </div>
                        @endforeach
                    @endif
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">{{$totals}} RON</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Livrare</h6>
                        <h6 class="font-weight-medium">0.00 RON</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">{{$totals}} RON</h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Plata</h4>
                </div>
                <div class="card-body">

                    <div class='accordion-wrapper'>
                    <button class="@if(Auth::user()->is_admin == 1) accordion-checkout @else accordion-launch @endif">Card bancar (in curand)</button>
                    <div class="panel">
                      
                        <form action="{{ route('stripe.store') }}" method="POST" id="card-form">
                            @csrf
                            <div class="mb-3">
                                <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Detalii card</label>
                                    <div id="card"></div>
                            </div>
                        </form>

                    </div>
                    </div>
                    
                    <div class="accordion-wrapper">
                    <button class="accordion-single">Cash ramburs</button>
                    {{-- <div class="panel">
                      <p>Lorem ipsum...</p>
                    </div> --}}
                    </div>

                </div>
                <div class="card-footer border-secondary bg-transparent">
                    @if(Session::has('cart'))
                    <button id="finish" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" style='letter-spacing:1px; background-color:#110a29; color:white;'>Plaseaza Comanda</button>
                    @else
                    <a class="btn btn-lg btn-block btn-pimary font-weight-bold my-3 py-3" href="{{route('home')}}" style='letter-spacing:1px; background-color:#110a29; color:white;'>Catre Magazin</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

var acc = document.getElementsByClassName("accordion-checkout");
var single = document.getElementsByClassName('accordion-single');
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active-checkout");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
    single[0].classList.remove('active-single');
  });
}

single[0].addEventListener('click', function() {
    this.classList.toggle('active-single');
    acc[0].classList.remove('active-checkout');
    var panel = acc[0].nextElementSibling;
    
    panel.style.maxHeight = null;
});
//stripe: 

@if(Auth::user()->is_admin == 1)
let stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        hidePostalCode: true,
        style: {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
    });

    const cardForm = document.getElementById('card-form');
    const cardName = document.getElementById('card-name');
    var sub = document.getElementById('finish');
    cardElement.mount('#card');

    
    sub.addEventListener('click', async (e) => {
        //e.preventDefault()
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: "Darius"
            }
        })
        if (error) {
            console.log(error)
        } else {
            let input = document.createElement('input')
            input.setAttribute('type', 'hidden')
            input.setAttribute('name', 'payment_method')
            input.setAttribute('value', paymentMethod.id)
            cardForm.appendChild(input)
            cardForm.submit()
        }
    })
    @else
    single[0].classList.add('active-single');
    
    function validate_data() {
        var name = document.getElementsByName('billing_name')[0].value;
        var email = document.getElementsByName('billing_email')[0].value;
        var phone = document.getElementsByName('billing_phone')[0].value;
        var address = document.getElementsByName('billing_address')[0].value;
        var city = document.getElementsByName('billing_city')[0].value;
        var county = document.getElementsByName('billing_county')[0].value;
        var zip = document.getElementsByName('billing_zip')[0].value;
        var regExp = "/[a-zA-Z]/g";

        if(name == "" || email == "" || phone == "" || address == "" || city == "" || county == "" || zip == "") {
            return 'no';
        }else if(!email.includes('@')) {
            return 'email';
        }else if(/[a-z]/i.test(phone)) {
            return "phone";
        }else if(/[a-z]/i.test(zip)) {
            return "zip"
        }
        return 'ok';
    }

    $("#finish").on('click', function() {

        var validation = validate_data();
        if(validation == "email") {
            document.getElementsByName('billing_email')[0].style.border="solid 1px red";
            document.getElementsByName('billing_phone')[0].style.border="";
            document.getElementsByName('billing_zip')[0].style.border="";
            document.getElementById('error').style.display = "none";
        }else if(validation == "phone") {
            document.getElementsByName('billing_email')[0].style.border="";
            document.getElementsByName('billing_phone')[0].style.border="solid 1px red";
            document.getElementsByName('billing_zip')[0].style.border="";
            document.getElementById('error').style.display = "none";
        }else if(validation == "zip") {
            document.getElementsByName('billing_email')[0].style.border="";
            document.getElementsByName('billing_phone')[0].style.border="";
            document.getElementsByName('billing_zip')[0].style.border="solid 1px red";
            document.getElementById('error').style.display = "none";
        }else if(validation == 'no') {
            document.getElementsByName('billing_email')[0].style.border="";
            document.getElementsByName('billing_phone')[0].style.border="";
            document.getElementsByName('billing_zip')[0].style.border="";
            document.getElementById('error').style.display = "block";
        }else {

            var name = document.getElementsByName('billing_name')[0].value;
            var email = document.getElementsByName('billing_email')[0].value;
            var phone = document.getElementsByName('billing_phone')[0].value;
            var address = document.getElementsByName('billing_address')[0].value;
            var city = document.getElementsByName('billing_city')[0].value;
            var county = document.getElementsByName('billing_county')[0].value;
            var zip = document.getElementsByName('billing_zip')[0].value;

            $.ajax({
                url: "{{route('process-order')}}",
                type: "POST",
                data: {"_token": "{{csrf_token()}}", "billing_address": address, 'billing_city': city, "billing_county": county, "billing_zip": zip, "price": "{{$totals}}"},
                success: function(data, xhr, status) {
                    document.getElementsByName('billing_email')[0].style.border="";
                    document.getElementsByName('billing_phone')[0].style.border="";
                    document.getElementsByName('billing_zip')[0].style.border="";
                    document.getElementById('error').style.display = "none";

                    window.location.href = "{{route('orders-client')}}";
                }
            });

            //window.location.href = "{{route('process-order-get')}}";
        }

    });

    @endif
</script>
@endsection