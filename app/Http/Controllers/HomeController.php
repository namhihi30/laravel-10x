<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    public $data = [];

    public function index()
    {
        $this->data['welcome'] = 'Học lập trình laravel';
        return view('home/home', $this->data);
    }



    public function test(Request $request)
    {


        // Generate OTP
        $otp = rand(100000, 999999);

        // Set up the request URL và parameters
        $url = 'http://localhost/laravel_10x/public/testSend';
        $params = [
            'otp' => $otp,
        ];

        try {
            // Send the GET request and get the response
            $response = Http::get($url, $params);

            // Debugging response
            dd($response->body());
        } catch (\Exception $e) {
            \Log::error('Error in GET request: ' . $e->getMessage());
            dd('Error: ' . $e->getMessage());
        }
    }


}
