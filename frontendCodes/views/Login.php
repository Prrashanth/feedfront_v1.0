<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>feedfront.ai | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body{
            background: url('./img/loginbk.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .transp{
           background-color: #0000008a;
           color: white;
        }
    </style>
</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6 transp">
                <h2 class="font-bold">Welcome to feedfront.ai</h2>

              <p> A voice-enabled feedback platform to collect and analyze your market's sentiments.</p> 


              <p> Use the power of AI to understand what's working for your customers and what isn't.</p>
 

<p>feedfront.ai gives you deep insight about the topics your customers are talking about, the areas you excel in and the gaps in your business. Use this feedback analysis to boost your CSAT.</p>

               

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="index.html">
                        <h2>Login</h2><br/>
                        <div id="error" class="alert alert-danger"></div>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" >
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

<!--                        <a href="#">
                            <small>Forgot password?</small>
                        </a>-->
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Digiconnectt Technologies
            </div>
            <div class="col-md-6 text-right">
               <small>© 2019-2020</small>
            </div>
        </div>
    </div>

</body>
<script src="js/jquery-3.1.1.min.js"></script>
<script>
    $('#error').hide();
      $(function () {
        $('form').on('submit', function (e) {
          e.preventDefault();
          var username=$('#username').val();
          var password=$('#password').val();
          if(username == '')
          {
              $('#error').html('Please enter a User Name');
              $('#error').show();
              return false;
          }
          if(password == '')
          {
              $('#error').html('Please enter a Password');
              $('#error').show();
              return false;
          }
          $('#error').hide();
          $.ajax({
            type: 'post',
            url: 'Logincontroller/Verify',
            data: $('form').serialize(),
            success: function (data) {
                if(data == 0)
                {
                    $('#error').html("Login failed - Please enter correct Username and Password");
                    $('#error').show();
                }else{
                    window.location = "Dashboard";
                }
//              alert('form was submitted');
            }
          });
        });
      });
</script>
</html>
