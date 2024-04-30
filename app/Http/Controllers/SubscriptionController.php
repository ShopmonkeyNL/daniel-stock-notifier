<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use App\Models\Customer; 
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $email = $request->input('email');

        // Controleer of het e-mailadres een geldig formaat heeft
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Het opgegeven e-mailadres is ongeldig.']);
        }


        $existingSubscription = Subscription::where('email', $request->input('email'))
                                     ->where('variant_id', $request->input('variantId'))
                                     ->where('notification', 0)
                                     ->exists();

        if ($existingSubscription) {
            return response()->json(['error' => 'Er bestaat al een abonnement met dit e-mailadres voor dit product.']);
        }


    
            

        // return response()->json([$request->input('name'), $request->input('email'), $request->input('variantId'), $request->input('shopId')], 201);
        $subscrition = new Subscription();
        $subscrition->name = $request->input('name');
        $subscrition->email = $request->input('email');
        $subscrition->variant_id = $request->input('variantId');
        $subscrition->shop_id = $request->input('shopId');
        $subscrition->notification = $request->input('notification');


        $subscrition->save();
        
        return response()->json(['message' => 'Subscription opgeslagen'], 201);
        
    }
}
