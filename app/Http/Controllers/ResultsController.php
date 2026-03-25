<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ResultsController extends Controller
{
    public function index()
    {
        return view('results');
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'xray_image' => 'required|image|mimes:jpeg,jpg,png|max:5120'
        ]);

        try {
            $file = $request->file('xray_image');
            
            // Get FastAPI URL from .env
            $fastApiUrl = env('FASTAPI_URL', 'http://localhost:8000');
            
            // Create Guzzle client
            $client = new Client([
                'timeout' => 120,
                'verify' => false
            ]);
            
            // Call FastAPI
            $response = $client->post($fastApiUrl . '/predict', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($file->getRealPath(), 'r'),
                        'filename' => $file->getClientOriginalName()
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (RequestException $e) {
            return response()->json([
                'success' => false,
                'message' => 'FastAPI connection error. Make sure it is running on port 8000.'
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}