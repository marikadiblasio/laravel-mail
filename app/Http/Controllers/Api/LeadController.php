<?php

namespace App\Http\Controllers\Api;

use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //faccio validazione direttamente qui
        $validator = Validator::make($data,
        [
            'name' => ['required'],
            'address' => ['required', 'email'],
            // 'address' => 'required', 'email',
            'body' => ['required']
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save(); //qst è normale controller non ha niete a che vedere con oggetto mailable che ha costruttore
        //se voglio inviarmi una mail con i dati che salvo nel db:
        //new NewContact invece passo i dati al costruttore - è qst l'oggetto mailable
        Mail::to('prova@prova.com')->send(new NewContact($newLead));

        return response()->json([ //success to stop axios
            'success'=>true
        ]);
    }

}
