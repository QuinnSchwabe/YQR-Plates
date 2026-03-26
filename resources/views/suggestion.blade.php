<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/suggestion.css') }}">
  <script src="{{ asset('js/suggestion.js') }}"></script>
</head>
<title>Suggestion Generator</title>
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
  <h1>Pick Your Plate</h1>
</div>

<form id="testForm" method="POST" action="/getSuggestion"> 
  @csrf 
  @auth
  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
  @endauth
  <div class="container-fluid">
    <div class="text-center">
      <button style="background: none;border: none;padding: 0;cursor: pointer; " type="submit" id="allButton">
        <img src="{{ asset('images/Generate.png') }}" alt="Click to Generate" height="325px" id="allImage">
      </button>
  <div class="container-fluid">
    <div class="text-center">
</div>
@if(session('error'))
<p style="color: red">{{ session('error') }}</p>
<div style="text-align: center; padding-top: 15px">
  @endif
  @guest
  <p style="font-size: 18px">Please <a href="/signin" style="text-decoration: none; color: black">Sign In </a>To Use Preferences</p>
  @endguest
  @auth
  @if(auth()->user()->type == "customer")
  <p style="font-size: 18px">Use Preferences</p>
    <label class="switch">
      <input type="checkbox" id="preferences" name="preference">
      <span class="slider round"></span>
    </label>
  </form>
  @endif
  @endauth
</div>
</div>
</div>
</div>
