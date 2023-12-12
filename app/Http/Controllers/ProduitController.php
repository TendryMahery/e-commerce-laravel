<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use App\Models\orders;
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
        $total = DB::table('cart')
        ->join('produits','cart.produit_id','=','produits.id')
        ->where('cart.user_id',$user)
        ->select('produits.*','cart.id as cart_id')
        ->sum('produits.price');

        return view('pages.list',['list'=>$produits,'total' => $total]);

    }

    public function delete($id){
        Cart::destroy($id);

        return redirect('list');
    }

    public function order(){
        $user = Session::get('user')['id'];
       $total= $produits =  DB::table('cart')
        ->join('produits','cart.produit_id','=','produits.id')
        ->where('cart.user_id',$user)
        ->sum('produits.price');
        return view('pages.order',['total'=>$total]);
    }

    public function orderPlace(Request $request){
        $user = Session::get('user')['id'];

        $carts = Cart::where('user_id',$user)->get();

        foreach($carts as $cart){
            $order = new orders;
            $order->produit_id = $cart['produit_id'];
            $order->user_id = $cart['user_id'];
            $order->status = "sending";
            $order->payment_status = "sending";
            $order->payment_methode = $request->payment;
            $order->adresse = $request->adresse;
            $order->save();
            Cart::where('user_id',$user)->delete();
        }
        $request->input();

        return redirect("/");
    }

    public function myorder(){
        $user = Session::get('user')['id'];
        $myorder =  DB::table('orders')
        ->join('produits','orders.produit_id','=','produits.id')
        ->where('orders.user_id',$user)
        ->get();

        return view('pages.myorder',['produit' => $myorder]);
    }
}
