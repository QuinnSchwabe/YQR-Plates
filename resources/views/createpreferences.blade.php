<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/preferences.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{ asset('js/preferences.js') }}"></script>
</head>
<title>Create Preferences</title>

<header>
  <nav class="p-6">
    <div class="flex justify-between items-center">
      <div class="flex justify-between flex-grow">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="http://yqrplates.com">YQR PLATES</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </nav>
</header>

<div class="jumbotron text-center">

@auth
@if(auth()->user()->type == "customer" && !auth()->user()->preference)
  <h2 style="color: white">Welcome, {{ auth()->user()->name }}!</h2>
  <h2 style="color: white">Enter Your Preferences</h2>
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


<form action="/storepreferences" method="POST" id="preferences-form"> 
    @csrf
    <input class="hidden" name="user_id" value={{ auth()->user()->id }}/>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <label>
        <span>Neighbourhood</span>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
        <div class="row d-flex justify-content-center mt-100">
          <select id="choices-multiple-remove-button" name="neighborhood[]" multiple>
            <option value="North West">North West</option>
            <option value="North East">North East</option>
            <option value="South West">South West</option>
            <option value="South East">South East</option>
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
            <option value="" hidden selected disabled style="display: none"></option>
            <option value="Fast Food">Fast Food</option>
            <option value="Canadian">Canadian</option>
            <option value="Pizza">Pizza</option>
            <option value="Greek">Greek</option>
            <option value="Indian">Indian</option>
            <option value="Sushi">Sushi</option>
            <option value="Italian">Italian</option>
            <option value="Asian">Asian</option>
            <option value="Chinese">Chinese</option>
            <option value="Thai">Thai</option>
            <option value="Vietnamese">Vietnamese</option>
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
            <option value="Dine In">Dine In</option>
            <option value="Take Out">Take Out</option>
            <option value="Delivery">Delivery</option>
            <option value="Drive Thru">Drive Thru</option>
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
            <option value="" selected disabled></option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="Medium High">Medium High</option>
            <option value="High">High</option>
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
@elseif(auth()->user()->type == "restaurant owner")
<p>Sorry only customers can create preferences</p>
@elseif(auth()->user()->preference)
<p>Sorry, you have already created your preferences please edit them.</p>
<button class="btn btn-lg largebutn" onclick="window.location.href='/editpreferences'">Edit Preferences</button>
@if(auth()->user()->type == "restaurant owner")
<p>Sorry, only customers can edit their preferences</p>
@endif
@else
<p>Please sign in to create preferences</p>
<button class="btn btn-lg largebtn" onclick="window.location.href='/signin'">Sign in</button>
@endif
@endauth
@guest
<p>Please sign in to create preferences</p>
<button class="btn btn-lg largebutn" onclick="window.location.href='/signin'">Sign in</button>
@endguest
</div>


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
        type: 'POST',
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

  $('preferences-form').on('submit', function() {
    $(this).find('button[type="submit"]').prop('disabled', true);
});

</script>