<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;
use Auth;


class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){
    	return view('test.index');
    }

    public function getJoueurs(){
    	return User::where('categorie', 'Joueur')->get();
    }

    public function getTests(){
    	return Test::orderby('date', 'desc')->get();
    }

    public function addTest(Request $request){
    	$test = New Test;
    	$test->id_joueur = $request->id_joueur;
    	$test->test = $request->json_test;
    	$test->save();

    	$tests = Test::orderby('date', 'desc')->get();
    	return Response()->json(['tests' => $tests]);
    }

    public function deleteTest($id){
        $test = Test::find($id);
        $test->delete();
        $tests = Test::orderBy('date', 'desc')->get();
        return Response()->json(['tests' => $tests]);
    }


}
