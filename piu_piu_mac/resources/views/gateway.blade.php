@extends('template-top-bar')

@section('section-title', 'Gateway')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('top-bar-content')

<div class="panel panel-default">
    <div class="panel-body">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <form action="{{ route('stripe.store') }}" method="POST" id="card-form">
            @csrf
            <div class="mb-3">
                <label for="card-name" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Your name</label>
                <input type="text" name="name" id="card-name" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full">
            </div>
            <div class="mb-3">
                <label for="email" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Email</label>
                <input type="email" name="email" id="email" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full">
            </div>
            <div class="mb-3">
                <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card details</label>
                    <div id="card"></div>
            </div>
            <button type="submit" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-white px-6 h-12">Pay 👉</button>
        </form>
    </div>
</div>


@endsection

@section('scripts')
<script>
    let stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
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
    cardElement.mount('#card');

    
    cardForm.addEventListener('submit', async (e) => {
        e.preventDefault()
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: cardName.value
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
</script>
@endsection