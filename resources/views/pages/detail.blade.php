@extends('base')

@section('content')
    <div class="flex justify-center p-20">
        <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{$produit->gallery}}" alt="">
            <div class="flex flex-col">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produit->name}}</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produit->description}}</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produit->price}}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            </div>

            <div>
                <form action="/panier" method="POST">
                    @csrf
                    <input type="hidden" name="produit" value="{{$produit->id}}">
                    <button type="submit" class="bg-blue-700 p-1 rounded text-white hover:bg-blue-900">add to panier</button>
                </form>
            </div>
            </div>
        </a>

    </div>
@endsection
