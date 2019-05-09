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
                   @foreach($query_data as $key=>$value)
                    <div class="col-md-4">
                        <b>{{ ucfirst($key) }}:</b><br>
                        <ol>
                            @foreach($value as $v)
                                <li>    
                                    <a href="{{ URL::route('search_'.$key, ['id' => $v['id'] ]) }}">{{ $v['name'] }}</a><br>
                                    <a href="{{ URL::route('search_'.$key, ['id' => $v['id'] ]) }}">
                                        <img src='{{ $v["image"] }}' height="100px" width="100px" />
                                    </a>
                                </li>
                            <hr>
                            @endforeach
                        </ol>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</body>
</html>
