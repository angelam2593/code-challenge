<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Code Challenge</title>
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
            <li class="breadcrumb-item active" aria-current="page">{{ $data->name }} info</li>
          </ol>
        </nav>
    <div class="row">
        <div class="col-md-12">
            <h3><b>Track:</b> {{ $data->name }}</h3> 
            <h4><b>Artist:</b> {{ $data->artists[0]->name }}</h4>
            <h4><b>Album:</b> {{ $data->album->name }} [{{ $data->album->release_date }}]</h4>
            <h4><b>Duration:</b> {{ $data->duration_ms }} ms</h4>
            <h4><b>Explicit:</b> 
                @if($data->explicit)
                    Yes
                @else
                    No
                @endif
            </h4>
            <h4><b>Available markets: </b> </h4> 
            @foreach($data->available_markets as $market)
                {{ $market }}
            @endforeach
        </div>
    </div>
</body>
</html>
