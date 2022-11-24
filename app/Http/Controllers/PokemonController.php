<?php

namespace App\Http\Controllers;
use DB;
use App\Model\Pokemon;
use App\User;
use Illuminate\Http\Request;


class PokemonController extends Controller
{
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        if($request->pokemon_hate){
            foreach ($request->pokemon_hate as $key => $value) {
                $pk_h = new Pokemon;
                $pk_h->created_by = $request->user;
                $pk_h->created_dt = date("Y-m-d");
                $pk_h->pokemon = $value['name'];
                $pk_h->isfav = $value['status'];
                $pk_h->save();
            }
        }  

        if($request->pokemon_fav){
            foreach ($request->pokemon_fav as $key => $value) {
                $pk_f = new Pokemon;
                $pk_f->created_by = $request->user;
                $pk_f->created_dt = date("Y-m-d");
                $pk_f->pokemon = $value['name'];
                $pk_f->isfav = $value['status'];
                $pk_f->save();
            }
        }    
        return true;
    }

    public function getPokemon($id)
    {
        $pokemon = Pokemon::where(['created_by'=>$id])->get();
        return response()->json($pokemon);
    }
    
}
