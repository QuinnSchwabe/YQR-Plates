<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/editpreferences.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{ asset('js/preferences.js') }}"></script>
</head>
<title>Edit Preferences</title>

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
              @auth
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="profile">PROFILE</a>
                </li>
              </ul>
              @endauth
            </div>
          </div>
        </nav>
      </div>
    </div>
  </nav>
</header>

<div class="jumbotron text-center">

@auth
@if(auth()->user()->preference)
  <h1>Update Your Preferences</h1>
</div>

<div class="row">
<div class="col-sm-2"></div>
  <div class="col-sm-4 text-center">
    <span><h5 style="font-size: 18px;">Neighbourhoods:</h5>
    North East:&emsp;North of Victoria Ave. and East of Albert St.<br/>
    North West:&emsp;North of Victoria Ave. and West of Albert St.<br/>
    South East:&emsp;South of Victoria Ave. and East of Albert St.<br/>
    South West:&emsp;South of Victoria Ave. and West of Albert St.</span>
  </div>
  <div class="col-sm-4 text-center">
  <span><h5 style="font-size: 18px;">Price Ranges:</h5>
    Low:&emsp;Under $15 / person<br/>
    Medium:&emsp;$15 - $30 / person<br/>
    Medium High:&emsp;$30 - $45 / person<br/>
    High:&emsp;$45 or more / person</span>
  </div>
  <div class="col-sm-2"></div>
</div>

<form action="/updatepreferences" method="POST" id="preferences-form"> 
    @csrf
    <input class="hidden" name="user_id" value={{ auth()->user()->id }}/>
    <input class="hidden" name="id" value={{ auth()->user()->preference->id }}/>
    <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <label>
        <span>Neighbourhood</span>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
        <div class="row d-flex justify-content-center mt-100">
          <select id="choices-multiple-remove-button" name="neighborhood[]" multiple>
          @if (auth()->user()->preference->north_west == TRUE)
              <option value="North West" selected>North West</option>
              @else
              <option value="North West">North West</option>
              @endif
              @if (auth()->user()->preference->north_east == TRUE )
              <option value="North East" selected>North East</option>
              @else
              <option value="North East">North East</option>
              @endif
              @if  (auth()->user()->preference->south_west == TRUE )
              <option value="South West" selected>South West</option>
              @else
              <option value="South West">South West</option>
              @endif
              @if ( auth()->user()->preference->south_east == TRUE )
              <option value="South East" selected>South East</option>
              @else
              <option value="South East">South East</option>
              @endif
          </select>
        </div> @if ($errors->has('neighborhoods')) <div id="neighborhood-error" class="error-message">
          {{$errors->first('neighborhood')}}
        </div> @endif
      </label>
    </div>
    <div class="col-sm-4">
      <label>
        <span>Food Type</span>
        <div class="row d-flex justify-content-center mt-100">
          <select id="choices-multiple-remove-button" name="food_type" onChange="foodType(this)">
          @if(auth()->user()->preference->food_type == "None")
            <option value="" hidden selected disabled></option>
            @else
            <option value="" hidden disabled></option>
            @endif
            @if(auth()->user()->preference->food_type == "Fast Food")
              <option value="Fast Food" selected>Fast Food</option>
              @else
              <option value="Fast Food">Fast Food</option>
              @endif
              @if(auth()->user()->preference->food_type === "Canadian")
              <option value="Canadian" selected>Canadian</option>
              @else
              <option value="Canadian">Canadian</option>
              @endif
              @if(auth()->user()->preference->food_type === "Pizza")
              <option value="Pizza" selected>Pizza</option>
              @else
              <option value="Pizza">Pizza</option>
              @endif
              @if(auth()->user()->preference->food_type === "Greek")
              <option value="Greek" selected>Greek</option>
              @else
              <option value="Greek">Greek</option>
              @endif
              @if(auth()->user()->preference->food_type === "Indian")
              <option value="Indian" selected>Indian</option>
              @else
              <option value="Indian">Indian</option>
              @endif
              @if(auth()->user()->preference->food_type === "Sushi")
              @else
              <option value="Sushi">Sushi</option>
              @endif
              @if(auth()->user()->preference->food_type === "Italian")
              <option value="Italian" selected>Italian</option>
              @else
              <option value="Italian">Italian</option>
              @endif
              @if(auth()->user()->preference->food_type === "Asian")
              <option value="Asian" selected>Asian</option>
              @else
              <option value="Asian">Asian</option>
              @endif
              @if(auth()->user()->preference->food_type === "Chinese")
              <option value="Chinese" selected>Chinese<option>
              @else
              <option value="Chinese">Chinese<option>
              @endif
              @if(auth()->user()->preference->food_type === "Thai")
              <option value="Thai" selected>Thai</option>
              @else
              <option value="Thai">Thai</option>
              @endif
              @if(auth()->user()->preference->food_type === "Vietnamese")
              <option value="Vietnamese" selected>Vietnamese</option>
              @else
              <option value="Vietnamese">Vietnamese</option>
              @endif
          </select>
        </div> @if ($errors->has('food_type')) <div id="food-type-error" class="error-message">
          {{$errors->first('food_type')}}
        </div> @endif
      </label>
    </div>
    <div class="col-sm-2"></div>
  </div>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <label>
        <span>Restaurant Type</span>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
        <div class="row d-flex justify-content-center mt-100">
          <select id="choices-multiple-remove-button" name="restaurant_type[]" multiple>
          @if(auth()->user()->preference->dine_in == TRUE)
              <option value="Dine In" selected>Dine In</option>
              @else
              <option value="Dine In">Dine In</option>
              @endif
              @if(auth()->user()->preference->take_out == TRUE)
              <option value="Take Out" selected>Take Out</option>
              @else
              <option value="Take Out">Take Out</option>
              @endif
              @if(auth()->user()->preference->delivery == TRUE)
              <option value="Delivery" selected>Delivery</option>
              @else
              <option value="Delivery">Delivery</option>
              @endif
              @if(auth()->user()->preference->drive_thru == TRUE)
              <option value="Drive Thru" selected>Drive Thru</option>
              @else
              <option value="Drive Thru">Drive Thru</option>
              @endif
          </select>
        </div> @if ($errors->has('restaurant_type')) <div id="restaurant-type-error" class="error-message">
          {{$errors->first('restaurant-type')}}
        </div> @endif
      </label>
    </div>
    <div class="col-sm-4">
      <label>
        <span>Price Range</span>
        <div class="row d-flex justify-content-center mt-100">
          <select id="choices-multiple-remove-button" name="price_range" onChange="priceRange(this)">
          @if(ucwords(auth()->user()->preference->price_range) == "None")
            <option value="" selected disabled></option>
            @else
            <option value="" disabled></option>
            @endif
            @if(ucwords(auth()->user()->preference->price_range) == "Low")
              <option value="Low" selected>Low</option>
              @else
              <option value="Low">Low</option>
              @endif
              @if(ucwords(auth()->user()->preference->price_range) == "Medium")
              @else
              <option value="Medium">Medium</option>
              @endif
              @if(ucwords(auth()->user()->preference->price_range) == "Medium High")
              <option value="Medium High" selected>Medium High</option>
              @else
              <option value="Medium High">Medium High</option>
              @endif
              @if(ucwords(auth()->user()->preference->price_range) == "High")
              <option value="High" selected>High</option>
              @else
              <option value="High">High</option>
              @endif
          </select>
        </div> @if ($errors->has('price-range')) <div id="price-range-error" class="error-message">
          {{$errors->first('price-range')}}
        </div> @endif
      </label>
    </div>
    <div class="col-sm-2"></div>
  </div>
  <button type="submit" class="submit">Continue</button>
</form>
@if(auth()->user()->type == "customer" && !auth()->user()->preference)
<p>You don't currently have preferences set, please create them before editting them</p>
<button class="btn btn-lg largebutn" style="width: 250px" onclick="window.location.href='/createpreferences'">Create Preferences</button>
@else
@endif
@endif
@if(auth()->user()->type == "restaurant owner")
<p>Sorry, only customers can edit their preferences</p>
@endif
@endauth
@guest
<p>Please sign in to edit your preferences</p>
<button class="btn btn-lg largebutn" style="width: 250px" onclick="window.location.href='/signin'">Sign in</button>
@endguest

<script>
  $(document).ready(function() {
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount: 15,
      searchResultLimit: 15,
      renderChoiceLimit: 15,
    });
  })(jQuery);
  $(document).ready(function() {
    $('preferences-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
          window.location.href = '/profile';
        },
        error: function(xhr) {
          var errors = xhr.responseJSON.errors;
          $('.error-message').empty();
          $.each(errors, function(key, value) {
            $('#' + key + '-error').text(value[0]);
          });
        }
      });
    });
  });
</script>