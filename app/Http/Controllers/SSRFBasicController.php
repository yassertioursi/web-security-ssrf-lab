<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SSRFBasicController extends Controller
{
    public function index()
    {
        $product = [
            'id' => 1,
            'name' => 'Premium Developer T-Shirt',
            'price' => '$29.99',
            'image' => 'https://developer-shop.com/cdn/shop/products/unisex-premium-t-shirt-black-front-605bb45b4ac6c.jpg?v=1616622695&width=1445',
            'description' => 'High-quality cotton t-shirt for developers. Available in multiple sizes.',
            'stock_check_url' => 'http://stock-api.internal/check?product_id=1'
        ];

        return view('ssrf.basic', compact('product'));
    }

    public function fetchUrl(Request $request)
    {
        $url = $request->input('url') ?? $request->json('url');

        if (empty($url)) {
            return response()->json(['error' => 'URL required'], 400);
        }

        $parsed = parse_url($url);
        if (!$parsed) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        $scheme = $parsed['scheme'] ?? 'http';

        if (strtolower($scheme) === 'gopher') {
            return $this->handleGopher($url, $parsed);
        }

        $context = stream_context_create([
            'http' => ['timeout' => 10, 'follow_location' => 0],
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
        ]);

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        return response()->json(['data' => $response]);
    }

    private function handleGopher($url, $parsed)
    {
        $host = $parsed['host'] ?? 'localhost';
        $port = $parsed['port'] ?? 70;
        $path = $parsed['path'] ?? '/';


        if (substr($path, 0, 1) === '/') {
            $path = substr($path, 1);
        }


        if (strlen($path) > 0 && $path[0] === '_') {
            $path = substr($path, 1);
        }

       
        $path = urldecode($path);

        $socket = @fsockopen($host, $port, $errno, $errstr, 10);
        if (!$socket) {
            return response()->json(['error' => 'Connection failed'], 500);
        }

        stream_set_timeout($socket, 5);
        fwrite($socket, $path . "\r\n");

        $response = '';
        $loops = 0;
        while (!feof($socket) && $loops < 100) {
            $chunk = fread($socket, 8192);
            if (!$chunk) break;
            $response .= $chunk;
            $loops++;
        }

        fclose($socket);
        return response()->json(['data' => $response]);
    }

    public function checkAvailability(Request $request)
    {
        return $this->fetchUrl($request);
    }
}

