<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // เพิ่มการใช้งาน Log


class LineNotifyController extends Controller
{
    public function redirectToLineNotify(Request $request)
    {
        // Redirect user to Line Notify authorization page
        $clientId = config('services.line_notify.client_id');//เรีย client id line noitfy  หรือ ใช้ ENV แทน
        $redirectUri = urlencode('https://164e-1-20-63-176.ngrok-free.app/line-notify/callback'); //ลิ้งย้อนกลับต้องตรงกันถึงใช้ได้
        $state = uniqid();
        $scope = 'notify'; // Set the scope to 'notify'
        $url = "https://notify-bot.line.me/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}&scope={$scope}&state={$state}";
        return redirect($url);
    }
    public function handleLineNotifyCallback(Request $request)
    {
        // Handle Line Notify callback to retrieve access token
        $code = $request->input('code');

        if (!$code) {
            // Handle the case when code is missing
            // (e.g., redirect user to an error page or display an error message)
            return response()->json(['error' => 'Authorization code is missing'], 400);
        }

        $clientId = config('services.line_notify.client_id'); //client id line noitfy  หรือ ใช้ ENV แทน
        $clientSecret = config('services.line_notify.client_secret'); //client secret id line noitfy  หรือ ใช้ ENV แทน
        $redirectUri = 'https://164e-1-20-63-176.ngrok-free.app/line-notify/callback';

        // Exchange code for access token
        $client = new Client();
        try {
            $response = $client->post('https://notify-bot.line.me/oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => $redirectUri,
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle the case when there is an error in the request
            return response()->json(['error' => 'Invalid request: ' . $e->getResponse()->getBody()->getContents()], 400);
        }

        $data = json_decode($response->getBody(), true);

        if (!isset($data['access_token'])) {
            // Handle the case when access token is missing
            // (e.g., redirect user to an error page or display an error message)
            return response()->json(['error' => 'Access token is missing'], 400);
        }
        // Save access token for the user, you should implement your own logic for this
        // For example, you could save it in the user's database record
        $user = auth()->user(); // Assuming you have authentication set up
        DB::table('users')
            ->where('id', $user->id)
            ->update(['line_token' => $data['access_token']]);

        // Redirect user to wherever you want
        return redirect()->route('user.dashboard')->with('success','เชื่อมต่อรับการแจ้งเตือนแล้ว');
    }
}
