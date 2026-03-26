<?php
use App\Factories\PromotionDisplayFactory;
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/promotion.css') }}">
  <script src="{{ asset('js/promotions.js') }}"></script>
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

<title>Promotions</title>
<div class="jumbotron text-center">
  @guest
    <p style="color: white">You need to be logged in order to add a promotion</p>
    <button class="btn btn-lg largebtn" onclick="window.location.href='/signin'">Sign in</button>
  @endguest
  @auth
  @if(auth()->user()->restaurant)
    <?php
    if (auth()->user()->type == "restaurant owner")
      $promotions = auth()->user()->restaurant->promotions;

  ?>
    @if(auth()->user()->type == "restaurant owner")
    <h1>{{ auth()->user()->restaurant->name }}</h1>
  @elseif(auth()->user()->type == "customer")
  <h2 style="color: white;">Sorry, only restaurant owners can add promotions</h2>
@endif
  </div>
  @if(auth()->user()->type == "restaurant owner")
    <div id="about" class="container-fluid" style="width: 400px">
    <div class="row">
    <div class="panel panel-default text-center">
      <div class="panel-heading">
      <h1>Add Promotion</h1>
      </div>
      <form action="{{ url('/promotions') }}" method="POST">
      @csrf
      <div class="panel-body">
      <input hidden name="restaurant_id" value="{{ auth()->user()->restaurant->id }}"/>
      <p>
      <textarea name="promotion_entry" value="{{ old('promotion_entry')}}" class="form-control"
        id="exampleFormControlTextarea1" rows="3"
        style="font-family: 'Open Sans', Helvetica, Arial, sans-serif;"></textarea>
      @if ($errors->has('promotion_entry'))
      <div id="promotion-error" class="error-message">
        <p style="color: red">Please enter a promotion</p>
      </div>
    @endif

      <label>   
        <span style="width: 200px">Promotion Type</span>
          <br>
          <select name="promotion_type" id="type" class="select" style="width: 200px">
          <option value="none" selected disabled hidden></option>
          <option value="limited time">Limited Time</option>
          <option value="daily deal">Daily Deal</option>
          <option value="happy hour">Happy Hour</option>
        </select>
        @if($errors->has('promotion_type'))
        <div class="error-message">
          <p style="color: red">Please select a promotion type</p>
        </div>
        @endif
      </label>
      </p>
      </div>
      <div class="panel-footer">
      <button type="submit" class="submit" background-color:#fff>Add Promotion</button>
      </div>
      </form>
    </div>
    </div>
    </div>
    </div>
    <div>
    <div id="pricing" class="container-fluid">
    <h2>Current Promotions</h2>

    @if(auth()->user()->type == "restaurant owner")
        @php
          $factory = new PromotionDisplayFactory($promotions);
          $limitedTime = $factory->renderPromotionDisplay('limited time');
          echo $limitedTime->displayPromotions();
          $happyHour = $factory->renderPromotionDisplay('happy hour');
          echo $happyHour->displayPromotions();
          $dailyDeal = $factory->renderPromotionDisplay('daily deal');
          echo $dailyDeal->displayPromotions();
        @endphp
    @endif
@endif
    @endauth
@endif
    @auth
    @if(auth()->user()->type == "restaurant owner" && !auth()->user()->restaurant)
    <p style="color: white;">Please create your restaurant before creating promotions.</p>
    <button class="btn btn-lg largebtn" onclick="window.location.href='/createrestaurant'">Create Restaurant</button>
  @else
  <p style="color: white">Sorry, only restaurant owners can create promotions</p>
@endif
  @endauth
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="padding-top: 15%;">
      <div class="modal-content">
        <form method="POST" action="{{ url('/promotions')}}">
          @csrf
          @method('DELETE')
          <input type="hidden" name="promotion_id" id="deletePromotionId">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 10px">
              <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="modal-title text-center" id="exampleModalLongTitle">Are you sure you want to remove</h2>
            <h3 class="text-center" id="promotionText"></h3>
          </div>
          <div class="modal-body text-center">
            <p>
              <strong>Doing so will remove this promotion from your restaurant</strong>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="submit" data-dismiss="modal" style="width: 25%">Cancel</button>
            <button type="submit" class="submit" style="width: 40%">Confirm Removal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $('#exampleModalCenter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var text = button.data('text');

    var modal = $(this);
    modal.find('#deletePromotionId').val(id);
    modal.find('#promotionText').text(text);
  });
</script>