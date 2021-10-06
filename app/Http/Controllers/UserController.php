<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Test;
use App\Absence;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function newUser(){
    	return view('user.create');
    }

    public function addUser(Request $request){
        
    	$user=new User();
    	$user->name=$request->name;
    	$user->matricule=$request->matricule;
    	$user->gender=$request->gender;
    	$user->email=$request->email;
        $user->categorie=$request->categorie;
        if ($request->categorie_joueur != null) {
            $user->categorie_joueur=$request->categorie_joueur;
        }
        $user->password=Hash::make($request->password);


       
    	$user->save();
    	return Response()->json(['user' => $user]);
    }

    public function profileUser(){
        return view('user.index');
    }

    public function updateUser(Request $request){
        
        $user= User::find(Auth::user()->id);
        $user->name=$request->name;
        $user->matricule=$request->matricule;
        $user->gender=$request->gender;
        $user->email=$request->email;
        $user->categorie=$request->categorie;
        if ($request->categorie_joueur != null) {
            $user->categorie_joueur=$request->categorie_joueur;
        }
        $user->password=Hash::make($request->password);

        $user->save();
        return Response()->json(['user' => $user]);
    }


    public function getUsers(){
        $users = User::all();
        return view('user.users', ['users' => $users]);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        $users = User::all();
        return Response()->json(['users' => $users]);
    }

    public function goToUserHome($id){
        $user = User::find($id);
        $tests = Test::where('id_joueur', $id)->get();
        $absences = Absence::all();
        return view('user.home', ['user' => $user,'tests' => $tests, 'absences' => $absences]);
    }


}
