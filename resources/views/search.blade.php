<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code Challenge</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 50px;
        }

        .full-height {
            height: 100vh;
        }

        .result {
        }
    </style>
</head>
<body>
    <nav aria-label="breadcrumb" style="margin-top: -50px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Searched data</li>
      </ol>
    </nav>
    <div class="full-height">
        <div class="result">
            Your Search Term Was: <b>{{$searchTerm}}</b>
              <hr>
                <div class="row">
                    <div class="col-md-4">
                        <b>Artists:</b><br>
                        <ol>
                            @foreach($artists as $artist)
                                <li>    
                                    <a href="{{ URL::route('search_artist', ['id' => $artist['id'] ]) }}">{{ $artist['name'] }}</a><br>
                                    @if($artist['image'] != null)
                                        <a href="{{ URL::route('search_artist', ['id' => $artist['id'] ]) }}"><img src='{{ $artist["image"] }}' height="100px" width="100px" /></a>
                                    @else
                                        <a href="{{ URL::route('search_artist', ['id' => $artist['id'] ]) }}"><img src='{{asset("img/noimage.jpg")}}' height="100px" width="100px" /></a>
                                    @endif
                                </li>
                            <hr>
                        @endforeach
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <b>Albums:</b><br>
                        <ol>
                            @foreach($albums as $album)
                               <li>
                                    <a href="{{ URL::route('search_album', ['id' => $album['id'] ]) }}">{{ $album['name'] }}</a><br>
                                    @if($album['image'] != null)
                                        <a href="{{ URL::route('search_album', ['id' => $album['id'] ]) }}"><img src='{{ $album["image"] }}' height="100px" width="100px" /></a>
                                    @else
                                        <a href="{{ URL::route('search_album', ['id' => $album['id'] ]) }}"><img src='{{asset("img/noimage.jpg")}}' height="100px" width="100px" /></a>
                                    @endif
                                    <hr>
                               </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <b>Tracks:</b><br>
                        <ol>
                           <li>
                                 @foreach($tracks as $track)
                                    <a href="{{ URL::route('search_track', ['id' => $track['id'] ]) }}">{{ $track['name'] }}</a><br>
                                    @if($track['image'] != null) 
                                        <a href="{{ URL::route('search_track', ['id' => $track['id'] ]) }}"><img src='{{ $track["image"] }}' height="100px" width="100px" /></a>
                                    @else
                                        <a href="{{ URL::route('search_track', ['id' => $track['id'] ]) }}"><img src='{{asset("img/noimage.jpg")}}' height="100px" width="100px" /></a>
                                    @endif
                                    <hr>
                                 @endforeach
                           </li>
                        </ol>
                    </div>
                </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
