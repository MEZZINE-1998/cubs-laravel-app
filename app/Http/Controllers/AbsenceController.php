<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\User;
use Auth;

class AbsenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
    	return view('absence.index');
    }

    public function getUsers(){
    	return User::all();
    }

    public function getAbsences(){
    	return Absence::all();
    }

    public function addAbsence(Request $request){
    	$absence = New Absence;
    	$absence->absences = $request->json_absences;
    	$absence->save();

    	$absences = Absence::orderBy('date', 'desc')->get();

    	return Response()->json(['absences' => $absences]);
    }

    public function deleteAbsence($id){
        $absence = Absence::find($id);
        $absence->delete();
        $absences = Absence::orderBy('date', 'desc')->get();
        return Response()->json(['absences' => $absences]);
    }


}
