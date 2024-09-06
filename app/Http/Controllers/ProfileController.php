<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function testSend(Request $request)
    {
        // Get user phone and OTP from request
        $phone = $request->input('phone'); // hoặc $request->get('phone');
        $otp = $request->input('otp'); // hoặc $request->get('otp');

        // Debugging to check if data is received correctly
        dd($request->request);

        try {
            // Create HTTP client
            $client = new \GuzzleHttp\Client();

            // Set up the request URL and parameters
            $url = 'https://example.com/api/send-otp';
            $params = [
                'phone' => (string)$this->normalizePhoneNumber($phone),
                'otp' => (string)$otp,
                'tracking_id' => \Illuminate\Support\Str::uuid(),
            ];

            // Log the params for debugging purposes
            \Log::info('Sending OTP with params: ', $params);

            // Get access token from session
            $accessToken = $request->session()->get('access_token');

            // If access token is not available, refresh it
            if (!$accessToken) {
                $this->refreshToken($request);
                $accessToken = $request->session()->get('access_token');
            }

            // Set up the headers
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
            ];

            // Send the request and get the response
            $response = $client->request('POST', $url, ['json' => $params, 'headers' => $headers]);

            $data = json_decode($response->getBody()->getContents(), true);
            if (isset($data['error'])) {
                // If there is an error
                \Log::error('Error in testSend: ' . $data['error']);
            } else {
                // Success log
                \Log::info('OTP sent successfully.');
            }

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in testSend: ' . $e->getMessage());
        }
    }

}
