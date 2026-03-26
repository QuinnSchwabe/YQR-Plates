<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}"></script>
</head>

<title>YQR Plates</title>

<header>
  <nav class="p-6">
    <div class="flex justify-between items-center">
      <div class="flex justify-between flex-grow">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
              @guest  
                <li>
                    <a href="signin">SIGN IN</a>
                </li>
              @endguest
              @auth
                <li>
                  <a href="profile">PROFILE</a>
                </li>
              @endauth
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </nav>
</header>
<div class="flex justify-between jumbotron text-center">
  <img src="{{ asset('images/YQRPlates.png') }}" alt="YQR Plates" height="320px">
</div>
<div class="container-fluid">
  <div class="row items-center">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <div class="largebtn" onclick="location.href='https://yqrplates.com/suggestion';">
        <h2>Pick Your Plate</h2>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="largebtn" onclick="location.href='https://yqrplates.com/restaurants';">
        <h2>Restaurants</h2>
      </div>
    </div>
    <div class="col-sm-2"></div>
  </div>
</div>