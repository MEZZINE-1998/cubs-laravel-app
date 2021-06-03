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
            Mail::send('emails.admin', ['Recrutement' => $request], function($message) use($email)
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
            Mail::send('emails.ingenieur', ['Recrutement' => $request, 'date_entretien' => $date_entretien], function($message) use($email)
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
            Mail::send('emails.adminValidation', ['Recrutement' => $request], function($message) use($email)
            {
                $object = 'Digiwise notification - validation';
                $message->to($email)->subject($object);
            });
        }


        $Recrutement = Recrutement::find($request->id);
        $ings = $Recrutement->id_condidats;
        foreach ($ings as $ing) {
            $email = $ing['email'];
            Mail::send('emails.ingenieurVal', ['Recrutement' => $Recrutement], function($message) use($email)
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

    
}
