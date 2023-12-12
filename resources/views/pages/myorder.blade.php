@extends('base')

@section('content')
<div class="flex justify-center bg-gray-100 h-screen">
    <div>
        <h1 class="text-4xl text-blue-500 mt-6">mon commande</h1>
        @foreach ($produit as $item )
        <div class="text-3xl font-bold border-2 shadow-2xl mb-4">
           <div class="p-6">
            <h1><span class="text-red-400">nom de produit</span> : {{$item->name}}</h1>
            <h1><span class="text-blue-400">adress</span> : {{$item->adresse}}</h1>
            <h1><span class="text-blue-400">status</span> {{$item->status}}</h1>
            <h1><span class="text-blue-400">methode de payment</span> {{$item->payment_methode}}</h1>
            <h1><span class="text-blue-400">status</span> {{$item->payment_status}}</h1>
           </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
