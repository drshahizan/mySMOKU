<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\TarikhIklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class LandingPageController extends Controller
{

    public function index()
    {   
        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";

        return view('pages.landing', compact('catatan'));
    }   

    public function sendEmail(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
            'emel' => 'required|email|max:255',
            'tajuk' => 'required|string|max:255',
            'mesej' => 'required|string|max:2000',
        ]);

        // Prepare email data
        $emailData = [
            'nama' => $validatedData['nama'],
            'telefon' => $validatedData['telefon'],
            'emel' => $validatedData['emel'],
            'tajuk' => $validatedData['tajuk'],
            'mesej' => $validatedData['mesej'],
        ];

        // Send email
        Mail::send('pages.auth.suggestion', $emailData, function ($message) use ($emailData) {
            $message->from($emailData['emel'], "SisPO") // Set the "From" address using the form data
                    ->replyTo($emailData['emel'], $emailData['nama']) // Set the reply-to as the user's email
                    ->to('sispo@mohe.gov.my') // Replace with the recipient email
                    ->subject($emailData['tajuk']);
        });

        // Return response
        return back()->with('success', 'Terima kasih! Cadangan anda telah dihantar.');
    }
}
