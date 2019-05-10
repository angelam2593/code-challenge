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
        $this->validate($request, ['query' => 'required']);

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
        
        $query_data = [];
        foreach($payload as $key => $value)
        {   
            $array_per_type = [];
            foreach($value->items as $value_specific)
            {
                $item_data = [];
                $item_data['id'] = $value_specific->id;
                $item_data['name'] = $value_specific->name;
                $item_data['image'] = asset('img/noimage.jpg'); // set default image
                
                switch ($key) {  // change default image
                    case 'tracks':
                        if(end($value_specific->album->images)->url != null)
                            $item_data['image'] = end($value_specific->album->images)->url;
                        break;
                    default:
                        if($value_specific->images != null)
                            $item_data['image'] = end($value_specific->images)->url;
                        break;
                }   

                array_push($array_per_type, $item_data);
            }

            $query_data[$key] = $array_per_type;
        }

        return view('search', ['searchTerm' => $query, 'query_data' => $query_data]);
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

        $sec = (int)(($data->duration_ms / 1000) % 60);
        $min = (int)(($data->duration_ms / 1000)  / 60);
        $data->duration_ms = ['min' => $min, 'sec' => $sec];

        return view('track_details', compact('data'));
        
    }
}
