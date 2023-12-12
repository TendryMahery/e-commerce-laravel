<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    //
    public function index(){

        $produit = Produit::all();
        return view('pages.produit',['produit' => $produit]);
    }

    public function detail($id){
        $produit = Produit::find($id);

        return view('pages.detail',['produit' => $produit]);
    }

    public function recherche(Request $request){

        $data = Produit::where('name', 'like', '%'.$request->input('recherche').'%')->get();

        return view('pages.recherche', ['produit' => $data]);
    }


    public function panier(Request $request){
        if($request->session()->has('user')){
            $cart = new Cart;
            $cart->produit_id = $request->produit;
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->save();
            return redirect("/");
        }else{
            return redirect('login');
        }
    }


    static function cart (){
       $user = Session::get('user')['id'];

       return Cart::where('user_id', $user)->count();
    }

    public function list(){
        $user = Session::get('user')['id'];
        $produits =  DB::table('cart')
        ->join('produits','cart.produit_id','=','produits.id')
        ->where('cart.user_id',$user)
        ->select('produits.*','cart.id as cart_id')
        ->get();

        return view('pages.list',['list'=>$produits]);

    }

    public function delete($id){
        Cart::destroy($id);

        return redirect('');
    }

    public function order(){
        $user = Session::get('user')['id'];
       $total= $produits =  DB::table('cart')
        ->join('produits','cart.produit_id','=','produits.id')
        ->where('cart.user_id',$user)
        ->sum('produits.price');
        return view('pages.order',['total'=>$total]);
    }
}
