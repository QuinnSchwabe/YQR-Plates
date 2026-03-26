<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://yqrplates.com/css/signup.css">
</head>

<title>Sign Up</title>

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

<body>
<div class="container-fluid">
  <div class="row items-center">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <div class="signup--container">
        <div class="left text-center">
          <h3>If you already have an account, sign in!<h3>
          <button class="submit" style="width: 142px" onclick="location.href='https://yqrplates.com/signin';">SIGN IN</button>
        </div>
        <div class="right">
          <h2>CREATE YOUR ACCOUNT</h2>
          <form action="/register" method="POST" id="registration-form"> @csrf
            <label>
              <span>Name</span>
              <input name="name" type="text" value="{{ old('name')}}" /> 
              @if ($errors->has('name')) 
                <div id="name-error" class="error-message">
                  {{$errors->first('name')}}
                </div> 
              @endif 
            </label>
            <label>
              <span>Email</span>
              <input name="email" type="email" value="{{ old('email')}}" /> 
              @if ($errors->has('email')) 
                <div id="email-error" class="error-message">
                  {{$errors->first('email')}}
                </div> 
              @endif 
            </label>
            <label>
              <span>Birthday</span>
              <input name="birthday" type="date" value="{{ old('birthday')}}" /> 
              @if ($errors->has('birthday')) 
                <div id="birthday-error" class="error-message">
                  {{$errors->first('birthday')}}
                </div> 
              @endif 
            </label>
            <label>
              <span>Password</span>
              <input name="password" type="password" value="{{ old('password')}}" /> 
              @if ($errors->has('password')) 
                <div id="password-error" class="error-message">
                  {{$errors->first('password')}}
                </div> 
              @endif
            </label>
            <label>
              <span>Confirm Password</span>
              <input name="password_confirmation" type='password' value="{{ old('password_confirmation')}}" />
            </label>
            <label>
              <span>Customer or Restaurant Owner</span>
              <select name="type" id="type" class="select">
                <option value="none" selected disabled hidden></option>
                <option value="customer">Customer</option>
                <option value="restaurant owner">Restaurant Owner</option>
              </select>
              <div class="error-message"></div>
            </label>
            <button type="submit" class="submit">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-2"></div>
  </div>  
</div>
</body>
<script>
  $(document).ready(function() {
    $('registration-form').submit(function(e) {
      e.preventDefault();

      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
          window.location.href = '/preferences';
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