@extends('template-top-bar')
@section('title', 'Detalii ANPC')

@section('styles')

<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

@endsection

@section('section-title', 'Detalii legale ANPC')

@section('top-bar-content')
<div style="margin-top: 40px; margin-bottom: 40px">
<h6>Linie telefonica cu tarif normal: </h6>
<h5 style="text-align: center; margin-bottom: 50px">021-9551</h5>
<h5 style="text-align: center">Se pot obţine informaţiiprivind modalitatea de a adresa o sesizare sau reclamaţie în atenţia Comisariatelor Judeţene pentru Protecţia Consumatorilor <a href="http://www.anpc.gov.ro/index.php?option=com_content&view=article&id=68&catid=27&Itemid=59">aici!</a></h5>
</div>
@endsection