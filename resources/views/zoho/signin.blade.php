<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- bootstrap 5 css  cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css">
  
    
</head>
<body>
    <div class="coontainer">

        <div class="row">
            <div class="col-md-6 offset-md-4">
                <h1>Sign in with Zoho</h1>
                <a href="{{route('zoho.signin')}}" class="btn btn-primary">Connect with Zoho</a>
            </div>
        </div>
    </div>
    
</body>
</html>