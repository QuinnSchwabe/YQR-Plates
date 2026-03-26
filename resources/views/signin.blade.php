<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://yqrplates.com/css/newsignin.css">
</head>

<title>Sign In</title>

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
    <div class="signin--container">
        <div class="left">
            <h2>WELCOME TO YQR PLATES</h2>
            <form action="/signin" id="signin-form" method="POST"> 
              @csrf
                <label>
                  <span>Email</span>
                  <input name="email" type="email" value="{{ old('email')}}"/> 
                  @if ($errors->has('email')) 
                    <div id="email-error" class="error-message">
                      {{$errors->first('email')}}
                    </div> 
                  @endif 
                </label>
                <label>
                  <span>Password</span>
                  <input name="password" type="password"/> 
                  @if ($errors->has('password')) 
                    <div id="password-error" class="error-message">
                      {{$errors->first('password')}}
                    </div> 
                  @endif 
                </label>
                @if ($errors->has('message')) 
                  <div class="error-message">
                    {{$errors->first('message')}}
                  </div> 
                @endif 
                <a href="https://www.yqrplates.com/resetpassword">
                  <p class="forgot-pass">Forgot password?</p>
                </a>
                <td>
                  <?echo "$error";?>
                </td>
                <button type="submit" class="submit" style="border: 1px solid white;padding-bottom: 40px;">
                  <input type="submit" value="Sign In" style="border-bottom: none;" />
                </button>
            </form>
        </div>
        <div class="right text-center">
        <h3>Don't have an account? Please sign up!<h3>
            <button class="submit" style="width: 142px; border: 1px solid white;" onclick="location.href='https://yqrplates.com/signup';">SIGN UP</button>
        </div>
    </div>
</body>
</html>

<script>
  $(document).ready(function() {
    $('signin-form').submit(function(e) {
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
