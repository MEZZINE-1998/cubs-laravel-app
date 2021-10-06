<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){

        $events = [];
        $color = '#ccc';
        
        if (Auth::user()->categorie == 'Joueur') {
            $data = Event::where([['categorie', 'Match'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Test'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Entrainement'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Rencontre'], ['rencontre_joueur', Auth::user()->id]])
            ->orWhere('categorie', 'Repos')
            ->get();
        }
        else{
            $data = Event::all();
        }
        if($data->count())
         {
            foreach ($data as $key => $value) 
            {
                if ($value->categorie == "Match") {
                    $color = "#c0f5a2";
                }
                elseif ($value->categorie == "Repos") {
                    $color = "#fcf081";
                }
                elseif ($value->categorie == "Entrainement") {
                    $color = "#75e7eb";
                }
                elseif ($value->categorie == "Test") {
                    $color = "#dc89fa";
                }
                elseif ($value->categorie == "Rencontre") {
                    $color = "#f56e7c";
                }

                $events[] = Calendar::event(
                    $value->title,
                    false,
                    new \DateTime($value->startdate),
                    new \DateTime($value->enddate.'+1 day'),
                    $value->id,
                    // Add color
                     [
                         'color' => $color,
                         'textColor' => '#000',
                     ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('event.index', compact('calendar'));
    }


    public function getEvents(){
        if (Auth::user()->categorie == 'Joueur') {
            return Event::where([['categorie', 'Match'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Test'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Entrainement'], ['sexe', Auth::user()->gender], ['categorie_joueur', Auth::user()->categorie_joueur]])
            ->orWhere([['categorie', 'Rencontre'], ['rencontre_joueur', Auth::user()->id]])
            ->orWhere('categorie', 'Repos')
            ->orderBy('startdate')
            ->get();
        }
        else{
            return Event::orderBy('startdate')->get();
        }
        return Event::orderBy('startdate')->get();
    }


    public function store(Request $request){

        $event= new Event();
        $event->title=$request->title;
        $event->categorie=$request->categorie;
        $event->startdate=$request->startdate;
        $event->enddate=$request->enddate;
        $event->description=$request->description;
        $event->sexe = 'x';
        $event->categorie_joueur = 'x';
        $event->rencontre_joueur = 0;

        if ($request->sexe != '') {
            $event->sexe=$request->sexe;
        }
        if ($request->categorie_joueur != '') {
            $event->categorie_joueur=$request->categorie_joueur;
        }
        if ($request->rencontre_joueur != '') {
            $event->rencontre_joueur=$request->rencontre_joueur;
        }
        
        $event->save();

        $events = Event::orderBy('startdate')->get();
        return Response()->json(['events' => $events]);        
    }

    public function deleteEvent($id){
        $event = Event::find($id);
        $event->delete();
        $events = Event::orderBy('startdate')->get();
        return Response()->json(['events' => $events]);
    }



}
