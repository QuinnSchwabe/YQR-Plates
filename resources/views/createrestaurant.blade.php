<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/uploadrestaurant.css') }}">
  <title>Create Restaurant</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{ asset('js/uploadrestaurant.js') }}"></script>
</head>
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
@if(auth()->user()->type == "restaurant owner" && !auth()->user()->restaurant)
  <h2>Welcome, {{ auth()->user()->name }}!</h2>
  <h2>Enter Your Restaurant</h2>
</div>
<div class="center">
  <form action="/storerestaurant" method="POST" id="restaurant-form" enctype="multipart/form-data"> 
    @csrf 
    <input class="hidden" name="user_id" value={{ auth()->user()->id }} />
    @if ($errors->has('user_id')) <div id="name-error" class="error-message text-center">
        <h5>You already own a restaurant, please <a href="/editrestaurant" style="color: inherit; text-decoration: none">edit your restaurant</a></h5>
      </div> @endif 
    <label>
      <span>Restaurant Name</span>
      <input name="restaurant_name" id="restaurant_name" type="text" /> 
      @if ($errors->has('restaurant_name')) <div id="name-error" class="error-message">
        {{$errors->first('restaurant_name')}}
      </div> @endif 
    </label>
    <br>
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
          </div> @if ($errors->has('neighborhood')) <div id="neighborhood-error" class="error-message">
            {{$errors->first('neighborhood')}}
          </div> @endif
        </label>
      </div>
      <div class="col-sm-4">
        <label>
          <span>Food Type</span>
          <div class="row d-flex justify-content-center mt-100">
            <select id="choices-multiple-remove-button" name="food_type" onChange="foodType(this)">
            <option value="" selected disabled hidden></option>
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
            The food type field is required
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
          {{$errors->first('restaurant_type')}}
          </div> @endif
        </label>
      </div>
      <div class="col-sm-4">
        <label>
          <span>Price Range</span>
          <div class="row d-flex justify-content-center mt-100">
            <select id="choices-multiple-remove-button" name="price_range" onChange="priceRange(this)">
            <option value="none" selected disabled hidden></option>
              <option value="Low">Low</option>
              <option value="Medium">Medium</option>
              <option value="Medium High">Medium High</option>
              <option value="High">High</option>
            </select>
          </div> 
          @if ($errors->has('price_range')) <div id="price-range-error" class="error-message">
            The price range field is required
          </div> @endif
        </label>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <label>
      <span id="noMenu">Upload Menu</span>
      <div class="dropzone text-center" style="height: 20%; width: 100%" id="noMenu2">
        <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" id="displayImage" />
        <embed id="pdf" src="#" width="100%" height="100%" style="display: none" />
        <img id="image" src="#" alt="your image" style="display: none; width: 100%; height 100%; max-height: 160px" />
        <label>
          <span id="prompt">Upload or drop file here</span>
          <input type="file" class="upload-input" id="menu" name="menuimage" height="100%" width="100%" />
        </label>
      </div>  
    </label>
    <label>
      <span>or paste URL link here</span>
      <input type="text" id="menuLink" name="menulink" />
      @if ($errors->has('menulink') && $errors->has('menuimage'))
    <div id="menu-error" class="error-message">
        A menu is required to upload a restaurant.
    </div>
@endif
    </label>
    </div>
    <button type="submit" class="submit">Continue</button>
  </form>
@elseif(auth()->user()->type == "customer")
  <p>Sorry, only restaurant owners can create restaurants<p>
@elseif(auth()->user()->restaurant)
<p>You already own a restaurant, please go and edit it</p>
<button class="btn btn-lg largebtn" onclick="window.location.href='/editrestaurant'">Edit Restaurant</button>
@endif
  @else
  <p>Please sign in to create a restaurant</p>
  <button class="btn btn-lg largebutn" style="background-color: 79a263; width: 250px" onclick="window.location.href='/signin'">Sign in</button>
@endauth
</div>

<script>
  const pdf = document.getElementById('pdf');
const image = document.getElementById('image');
const displayImage = document.getElementById('displayImage');
const prompt = document.getElementById('prompt');
  function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
  }

  function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
      case 'jpg':
      case 'gif':
      case 'bmp':
      case 'png':
        //etc
        return true;
    }
    return false;
  }

  function isPDF(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
      case 'pdf':
        return true;
    }
    return false;
  }
  menu.onchange = evt => {
    const [file] = menu.files
    console.log(file)
    if (isPDF(file.name)) {
      pdf.src = URL.createObjectURL(file)
      prompt.style.display = "none"
      pdf.style.display = "inline-block"
      image.style.display = "none"
      displayImage.style.display = "none"
    }
    if (isImage(file.name)) {
      image.src = URL.createObjectURL(file)
      prompt.style.display = "none"
      pdf.style.display = "none";
      image.style.display = "";
      displayImage.style.display = "none"
    }
  }
  $(document).ready(function() {
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount: 15,
      searchResultLimit: 15,
      renderChoiceLimit: 15,
    });
  })(jQuery);
  


  $(document).ready(function() {
    $('#restaurant-form').submit(function(e) {
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
</script>