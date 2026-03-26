<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/profile.css') }}">
  <script src="{{ asset('js/profile.js') }}"></script>
</head>

<title>Profile</title>

<header>
  <nav class="p-6">
    <div class="flex justify-between items-center">
      <div class="flex justify-between flex-grow">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="https://yqrplates.com">YQR PLATES</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </nav>
</header>

<div class="jumbotron text-center">

@auth
@if(auth()->user()->preference || auth()->user()->restaurant)
  <h2 style="color: white">Hello, {{ auth()->user()->name }}!</h2>
<form action="/logout" method="POST">
  @csrf
  <button class="btn btn-lg largebtn" type="submit">Log Out</button>
</div>
<div id="about" class="container-fluid" style="width: 400px">
  <div class="row">
    <div class="text-center">
      <div class="panel panel-default text-center">

        <div class="panel-heading">
          <h1>
            <?php
              $title = "";
              if(auth()->user()->type == "customer"){
                $title = "Current Preferences";
              }
              if(auth()->user()->type == "restaurant owner"){
                $title= "Restaurant Details";
              }
            ?>
            {{ $title }}
          </h1>
        </div>
        @if(auth()->user()->type == "restaurant owner")
        <div class="panel-body">
          <p>
            <strong>Name: </strong> 
              {{ auth()->user()->restaurant->name }}
          </p>
        </div>
        @endif
        <div class="panel-footer">
          <p>
            <strong>Price Range: </strong> 
              @if(auth()->user()->type == "customer")
                {{ auth()->user()->preference->price_range }}
              @endif
              @if(auth()->user()->type == "restaurant owner")
                {{ auth()->user()->restaurant->price_range }}
              @endif
          </p>
        </div>
        <div class="panel-footer">
          <p>
            <strong>Food Type: </strong> 
              @if(auth()->user()->type == "customer")
                {{ auth()->user()->preference->food_type }}
              @endif
              @if(auth()->user()->type == "restaurant owner")
                {{ auth()->user()->restaurant->food_type }}
              @endif
          </p>
        </div>
        <div class="panel-footer">
          <p>
            <strong>Restaurant Type: </strong> 
            <?php
              $count = 0;
              $separator = ", ";
              $types = "";
              $object = auth()->user()->type == "customer" ? auth()->user()->preference : auth()->user()->restaurant;
              if($object->dine_in){
                $types .= "Dine-in";
                $count++;
              }
              if($object->take_out){
                if($count > 0){
                  $types .= ", ";
                }
                $types .= "Take-out";
                $count++;
              }
              if($object->delivery){
                if($count > 0){
                  $types .= ", ";
                }
                $types .= "Delivery";
                $count++;
              }
              if($object->drive_thru){
                if($count > 0){
                  $types .= ", ";
                }
                $types .= "Drive-thru";
                $count++;
              }
              if($types == "")
                $types = "None";
            ?>
            {{ $types }}
          </p>
        </div>
        <div class="panel-footer">
          <p>
            <strong>Location: </strong> 
            <?php
              $count = 0;
              $separator = ", ";
              $areas = "";
              $object = auth()->user()->type == "customer" ? auth()->user()->preference : auth()->user()->restaurant;
              if($object->south_east){
                $areas .= "South-East";
                $count++;
              }
              if($object->south_west){
                if($count > 0){
                  $areas .= $separator;
                }
                $areas .= "South-West";
                $count++;
              }
              if($object->north_east){
                if($count > 0){
                  $areas .= $separator;
                }
                $areas .= "North-East";
                $count++;
              }
              if($object->north_west){
                if($count > 0){
                  $areas .= $separator;
                }
                $areas .= "North-West";
              }
              if($areas == "")
                $areas = "None";
            ?>
            {{ $areas }}
          </p>
        </div>
      </div>
      <button class="btn btn-lg largebtn" type="button" onclick="location.href='https://yqrplates.com/{{ auth()->user()->type == "customer" ? 'editpreferences' : 'editrestaurant' }}';">
        @if(auth()->user()->type == "customer")
          Update Preferences
        @endif
        @if(auth()->user()->type == "restaurant owner")
          Update Restaurant Details
        @endif
      </button>
    </div>
    </br>
    <a class="btn btn-lg largebtn" href="dashboard">View Dashboard</a>
    <br>
    @if(auth()->user()->type == "restaurant owner")
      <a class="btn btn-lg largebtn" href="promotions">Add Promotion</a>
    @endif
  </div>
</div>
  
</div>
@else
@if(auth()->user()->type == "customer")
<p>Please create your preferences before viewing your profile.</p>
  <button class="btn btn-lg largebtn" onclick="window.location.href='/createpreferences'">Create Preferences</button>
@else
<p>Please create your restaurant before viewing your profile.</p>
  <button class="btn btn-lg largebtn" onclick="window.location.href='/createrestaurant'">Create Restaurant</button>
  @endif
  @endif
  @else
  <p>You need to be logged to view your profile.</p>
  <button class="btn btn-lg largebtn" onclick="window.location.href='/signin'">Sign in</button>
  @endauth