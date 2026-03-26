<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/restaurants.css') }}">
  <script src="{{ asset('js/restaurants.js') }}"></script>
</head>

<title>Restaurants</title>

<header>
  <nav class="p-6">
    <div class="flex justify-between items-center">
      <div class="flex justify-between flex-grow">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="http://yqrplates.com">YQR PLATES</a>
            </div>
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

<div class="jumbotron text-center">
  <h1>Restaurants</h1>
</div>

<div class="container-fluid">
  <div class="row">
    @foreach($restaurants as $restaurant)
      <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default text-center">
          <div class="panel-heading" style="height:125px;padding:1px 7px;">
            <h1>{{ $restaurant->name }}</h1>
          </div>
          <div class="panel-footer">
            <a class="btn btn-lg" href="{{ url('/restaurants/details/' . $restaurant->id) }}">View Details & Promotions</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>