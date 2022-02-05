<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelRanks;
use App\Models\LevelRanksWeapons;
use DB;
use DataTables;

class LevelRanksController extends Controller
{
    public function total(){
        $total['players'] = LevelRanks::count();
        $total['headshots'] = LevelRanks::sum('headshots');
        $total['kills'] = LevelRanks::sum('kills');
        $total['knifes'] = DB::table('lvl_base_weapons')->where('classname', 'weapon_knife')->sum('kills');

        $total['ptop'] = LevelRanks::select('steam','name','value')->orderBy('value', 'DESC')->first();

        $total['htop'] =  LevelRanks::select('steam','name','headshots')->orderBy('headshots', 'DESC')->first();

        $total['ktop'] = LevelRanks::select('steam','name','kills')->orderBy('kills', 'DESC')->first();
        
        $total['knifetop'] = DB::table('lvl_base_weapons')->where('classname', 'weapon_knife')    ->orderBy('kills', 'DESC')->first();

        $topknife_name = LevelRanks::select('name')->where('steam', $total['knifetop']->steam)->first();
        $total['knifetop']->name = $topknife_name->name;


        return response()->json($total);
    }

    public function points(){
        $result = LevelRanks::select('steam','name','value')->orderBy('value', 'DESC')->get();

        return response()->json($result);
    }

    public function deaths(){
        $result = LevelRanks::select('steam','name','deaths')->orderBy('deaths', 'DESC')->get();

        return response()->json($result);
    }

    public function hs(){
        $result = LevelRanks::select('steam','name','headshots')->orderBy('headshots', 'DESC')->get();

        return response()->json($result);
    }

    public function kills(){
        $result = LevelRanks::select('steam','name','kills')->orderBy('kills', 'DESC')->get();

        return response()->json($result);
    }

    public function knifes(){
        $result = LevelRanks::select('steam','name','knifes')->orderBy('knifes', 'DESC')->get();

        return response()->json($result);
    }

    public function getUser($id){
        $user = LevelRanks::with(['base_hits','weapons','maps','unusual'])->where('steam', $id)->first();
        
        // dd($points);
        if(!$user)
            return response()->json(['error' => 'Not Found'], 404); 
        
        
        return response()->json($user);
    }

    public function getPoints($id)
    {
        switch($id)
        {
            // Points
            case "points": 
                    $query = LevelRanks::select('steam','name','value')->orderBy('value', 'DESC');
                    break;

            //Kills
            case "kills": 
                    $query = LevelRanks::select('id','steam','name','kills')->orderBy('kills', 'DESC');
                    break;

            // headshot
            case "headshots": 
                    $query = LevelRanks::select('id','steam','name','head')->orderBy('head', 'DESC');
                    break;

            // knife
            case "knifes": 
                    $query = LevelRanks::select('id','steam','name','knife')->orderBy('knife', 'DESC');
                    break;

            // default: $query = DB::table('rankme')->select('id','steam','name','score', 'deaths')->orderBy('score', 'DESC');
        }

        return DataTables::eloquent($query)
            // ->addColumn('name', function ($user) {
            //     return '<span style="cursor: pointer;" v-on:click="getTest('.$user->steam.')" class="font-weight-bold text-primary">'. $user->name .'</span>';
            // })
            // ->rawColumns(['name'])
            ->toJson();
    }


}