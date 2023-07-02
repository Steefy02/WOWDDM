<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Favorite;
use Auth;
use DB;

class FavoritesController extends Controller {

    public function add_product_to_fav(Request $request, $id) {
        $fav = new Favorite;
        if(Auth::check()) {
            $user = Auth::user();

            $fav->id_Product = $id;
            $fav->id_User = $user->id;
            $fav->save();

            return redirect()->back()->with('message_fav', 'yes');
        }else {
            return redirect()->route('home')->with('err', 'Trebuie sa fii logat pentru a salva aricole!');
        }
    }

    public function delete_product_from_fav(Request $request, $id) {
        $fav = Favorite::find($id);
        $fav->delete();

        return redirect()->back()->with('del_success', 'yes');
    }

    public static function fetch_user_favorites() {
        $user = Auth::user();

        return Favorite::select('*')->where('id_User', $user->id)->get();
    }

    public static function check_product($id) {
        $res = DB::select("select * from favorites where id_User = " . Auth::user()->id . " and id_Product = " . $id . " and deleted_at is null");

        if(sizeof($res) > 0) {
            return true;
        }

        return false;
    }



}