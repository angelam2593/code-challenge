<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getAccessToken()
    {
        $url = "https://accounts.spotify.com/api/token";
        $client = new Client(['header' => ['User-Agent' => 'MyRSSFeed'], 'verify' => 'C:/wamp64/bin/php/php7.1.16/extras/ssl/cacert.pem']);
        $headers = [
            'Authorization' => 'Basic '.config('app.spotify_authorization')
        ];
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'form_params'  => [
                'grant_type' => 'client_credentials'
                ]           
        ]);
        
        $payload = json_decode($response->getBody()->getContents()); 

        return $payload->access_token;
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        $access_token = $this->getAccessToken(); 

        $url = "https://api.spotify.com/v1/search?query=".$query."&type=album,track,artist";
        $client = new Client(['header' => ['User-Agent' => 'MyRSSFeed'], 'verify' => 'C:/wamp64/bin/php/php7.1.16/extras/ssl/cacert.pem']);
        $headers = [
            'Authorization' => 'Bearer ' . $access_token,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);

        $payload = json_decode($response->getBody()->getContents());
        
        $albums = collect(); 
        $artists = collect();
        $tracks = collect();

        foreach($payload->albums->items as $item)
        {
            $item_data = [];
            $item_data['id'] = $item->id;
            $item_data['name'] = $item->name;
            if($item->images != null)
                $item_data['image'] = end($item->images)->url;
            else
                $item_data['image'] = null;

            $albums->push($item_data);
        }

        foreach($payload->artists->items as $item)
        {
            $item_data = [];
            $item_data['id'] = $item->id;
            $item_data['name'] = $item->name; 
            if($item->images != null)
                $item_data['image'] = end($item->images)->url;
            else
                $item_data['image'] = null;

            $artists->push($item_data);
        }

        foreach($payload->tracks->items as $item)
        {
            $item_data = [];
            $item_data['id'] = $item->id;
            $item_data['name'] = $item->name; 
            if($item->album->images[0]->url != null)
                $item_data['image'] = end($item->album->images)->url;
            else
                $item_data['image'] = null;

            $tracks->push($item_data);
        }

        return view('search', ['searchTerm' => $query, 'albums' => $albums, 'artists' => $artists, 'tracks' => $tracks]);
    }

    public function searchArtist($id)
    {
        $access_token = $this->getAccessToken(); 

        $url = "https://api.spotify.com/v1/artists/".$id;
        $client = new Client(['header' => ['User-Agent' => 'MyRSSFeed'], 'verify' => 'C:/wamp64/bin/php/php7.1.16/extras/ssl/cacert.pem']);
        $headers = [
            'Authorization' => 'Bearer ' .$access_token,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);
        $data = json_decode($response->getBody()->getContents());

        return view('artist_details', compact('data'));
    }

     public function searchAlbum($id)
    {
        $access_token = $this->getAccessToken(); 

        $url = "https://api.spotify.com/v1/albums/".$id;
        $client = new Client(['header' => ['User-Agent' => 'MyRSSFeed'], 'verify' => 'C:/wamp64/bin/php/php7.1.16/extras/ssl/cacert.pem']);
        $headers = [
            'Authorization' => 'Bearer ' .$access_token,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);
        $data = json_decode($response->getBody()->getContents());

        return view('album_details', compact('data'));
    }

    public function searchTrack($id)
    {
        $access_token = $this->getAccessToken(); 

        $url = "https://api.spotify.com/v1/tracks/".$id;
        $client = new Client(['header' => ['User-Agent' => 'MyRSSFeed'], 'verify' => 'C:/wamp64/bin/php/php7.1.16/extras/ssl/cacert.pem']);
        $headers = [
            'Authorization' => 'Bearer ' .$access_token,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);
        $data = json_decode($response->getBody()->getContents());

        return view('track_details', compact('data'));
        
    }
}
