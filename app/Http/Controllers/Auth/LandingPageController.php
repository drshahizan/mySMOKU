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
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get form data
            $nama = trim($_POST['nama']);
            $telefon = trim($_POST['telefon']);
            $emel = trim($_POST['emel']);
            $tajuk = trim($_POST['tajuk']);
            $mesej = trim($_POST['mesej']);
            
            // Basic validation (you can expand this as needed)
            if (empty($nama) || empty($telefon) || empty($emel) || empty($tajuk) || empty($mesej)) {
                echo "Sila isi semua medan.";
                return;
            }

            // Email details
            $to = "bkoku@mohe.gov.my"; // Replace with your email
            $subject = "SistemBKOKU $tajuk";
            $body = "
                Nama: $nama\n
                Telefon: $telefon\n
                Emel: $emel\n
                Tajuk: $tajuk\n
                Mesej:\n$mesej
            ";
            $headers = "From: $emel";

            // Send email
            if (mail($to, $subject, $body, $headers)) {
                // Return response
                return back()->with('success', 'Terima kasih! Cadangan anda telah dihantar.');
            } 
        }
        

        
    }
}
