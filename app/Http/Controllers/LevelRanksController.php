<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelRanks;
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
        $user = LevelRanks::where('steam', $id)->first();

        $user['weapons'] = DB::table('lvl_base_weapons')->where('steam', $id)->orderBy('classname')->get();

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
            case "1": 
                    $query = LevelRanks::select('steam','name','value')->orderBy('value', 'DESC');
                    break;

            //Kills
            case "2": 
                    $query = LevelRanks::select('id','steam','name','kills')->orderBy('kills', 'DESC');
                    break;

            // headshot
            case "3": 
                    $query = LevelRanks::select('id','steam','name','head')->orderBy('head', 'DESC');
                    break;

            // knife
            case "4": 
                    $query = LevelRanks::select('id','steam','name','knife')->orderBy('knife', 'DESC');
                    break;

            // mvp
            case "5": 
                    $query = LevelRanks::select('id','steam','name','mvp')->orderBy('mvp', 'DESC');
                    break;

            // default: $query = DB::table('rankme')->select('id','steam','name','score', 'deaths')->orderBy('score', 'DESC');
        }

        return DataTables::eloquent($query)
            ->addColumn('name', function ($user) {
                return '<a class="font-weight-bold text-primary" href="/player/'. $user->steam .'">'. $user->name .'</a>';
            })
            ->rawColumns(['name'])
            ->toJson();
    }


}