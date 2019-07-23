<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsorship;
use App\Apartment;
use Braintree_Transaction;

class SponsorshipController extends Controller
{
  public function process($amount, $apartmentId, $sponsorshipId, Request $request)
  {
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $status = Braintree_Transaction::sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'options' => [
        'submitForSettlement' => True
      ]
    ]);

    if($status->success){
      $apartment= Apartment::findOrFail($apartmentId);
      $apartment->sponsorships()->attach($sponsorshipId);
    }

    return response()->json($status);
  }

  public function showSponsorshipForm($id){

    $apartment = Apartment::findOrFail($id);
    $sponsorships = Sponsorship::all();

    return view('page.addSponsorship', compact('sponsorships', 'apartment'));
  }
}
