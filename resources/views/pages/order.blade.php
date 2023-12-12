@extends('base')

@section('content')
    <div class="flex justify-center p-20">
        <div class="">
            <div>
                <form method="POST" action="orderplace" >
                    @csrf
                    <div>
                        <h1>Entrer votre adresse</h1>
                        <textarea name="adresse" class="outline-none focus:border-blue-300 text-gray-400 border border-gray-300 p-1 rounded"></textarea>
                    </div>
                    <h1 class="text-2xl">mode de payment</h1> <br>
                    <div class="flex inline-block space-x-6 p-2">
                        <div class="border-r-4 border-red-500 px-4">
                            <label for="Online">payment en ligne</label>
                            <input type="radio" name="payment" value="payment en ligne" id="Online" >
                        </div>
                        <div class="border-r-4 border-red-500 px-4">
                            <label for="espece">payment en espece</label>
                            <input type="radio" name="payment" value="payment espece" id="espece">
                        </div>
                        <div class="border-r-4 border-red-500 px-4">
                            <label for="bancaire">payment bancaire</label>
                            <input type="radio" name="payment" value="Payment bancaire" id="bancaire">
                        </div>

                    </div>
                    <button type="submit" class="bg-green-600 text-white p-2 rounded text-center">envoyer le commande</button>
                </form>
            </div>

        </div>
    </div>
@endsection
