<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Recrutement;
use App\Demande;
use Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class TestController extends Controller
{

	public function sendMail(Request $request){
    	
		// send email notification to admins
        $admins = User::where('post', 'admin')->get();
        foreach ($admins as $admin) {
        	$email = $admin->email;
            Mail::send('emails.admin', ['Recrutement' => $request, 'id_admin' => $admin['id']], function($message) use($email)
            {
                $object = 'Digiwise notification - interview';
                $message->to($email)->subject($object);
            });
        }

        // send email notification to engineers :
        $ings = $request->ings;
        foreach ($ings as $ing) {
        	$email = $ing['email'];
            $date_entretien = $ing['date_entretien'];
            Mail::send('emails.ingenieur', ['Recrutement' => $request, 'date_entretien' => $date_entretien, 'id_ing' => $ing['id']], function($message) use($email)
            {
                $object = 'Digiwise notification - interview';
                $message->to($email)->subject($object);
            });
        }

    	return Response()->json(['etate' => true, 'email'=> $email ]);    	
    }




    public function sendMailValidation(Request $request){


    	// send email notification to admins
        $admins = User::where('post', 'admin')->get();
        foreach ($admins as $admin) {
        	$email = $admin->email;
            Mail::send('emails.adminValidation', ['Recrutement' => $request, 'id_admin' => $admin['id']], function($message) use($email)
            {
                $object = 'Digiwise notification - validation';
                $message->to($email)->subject($object);
            });
        }


        $Recrutement = Recrutement::find($request->id);
        $ings = $Recrutement->id_condidats;
        foreach ($ings as $ing) {
            $email = $ing['email'];
            Mail::send('emails.ingenieurVal', ['Recrutement' => $Recrutement, 'id_ing' => $ing['id']], function($message) use($email)
            {
                $object = 'Digiwise notification - validation';
                $message->to($email)->subject($object);
            });
        }



    	return Response()->json(['etate' => true]);
    }



    public function sendMaiUpdateProfile(Request $request){

        $email = $request->email;
        Mail::send('emails.updateProfile', ['user' => $request], function($message) use($email)
        {
            $object = 'Digiwise notification - New account';
            $message->to($email)->subject($object);
        });

        return Response()->json(['email' => $email]);

    }


    //  send mail to admins and partner about lab reservation ...

    public function sendLabMail(Request $request){

        $entreprise = User::find(Auth::user()->id);

        // send email notification to admins
        $admins = User::where('post', 'admin')->get();
        foreach ($admins as $admin) {
            $email = $admin->email;
            Mail::send('emails.labReservationToAdmin', ['lab' => $request, 'entreprise_name' => $entreprise['name'] ], function($message) use($email)
            {
                $object = 'Digiwise notification - Lab';
                $message->to($email)->subject($object);
            });
        }

        // send email notification to partner
        $email = $entreprise['email'];
        Mail::send('emails.labReservationToPartner', ['lab' => $request], function($message) use($email)
        {
            $object = 'Digiwise notification - Lab';
            $message->to($email)->subject($object);
        });

        return Response()->json(['etat' => $email, 'etat2' => $entreprise['name']]);
    }

    
}
