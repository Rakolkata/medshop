<!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>crm : Digital Enablers for SMEs</title>
        <meta name="keywords" content="Accounting Software">
        <meta name="description" content="Dovetail-crm is a technology-driven  manufacturing company  delivering Billing, Payment &amp; Delivery Solutions for Small &amp; Medium Businesses.This software  is the web version of Accounting Software and  modified version of  Tally application. It extends the feature of tally application and provide flexibility to the user to use either web application for accounting or both tally and web application but data will be synced and will provide flexibility to the user.Start 7 Days Free Trial Now!">
       <!-- Fonts -->
        <link href="{{asset('public/user/css/lnt.css?v=1.0.0')}}" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right:10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 70px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .btn-primary{
                color: #fff !important;
                background-color: gold; 
                display: inline-block;
                padding: 10px !important;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle; 
                border: 1px solid transparent;
                line-height: 1.6;
                border-radius: .25rem;
                transition: color .15s 
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           
            @if (Route::has('login'))
             
           <div class="top-right links">
                    @auth
                    <a href="{{ url('/home') }}">Home</a>
                    @else 
                   <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius:10px;"><strong>Login</strong>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                  <li><a href="{{ route('admin.login') }}"><strong>Admin login</strong></a></li>
                  <li><a href="{{ route('login') }}"><strong>User login</strong></a></li>
                  </ul>
                   <span> <img src="# " height="30px" width="150px"></span>
                  </div>
                  @endauth
                </div>
               @endif

            <div class="content">
                <span><img alt="Image placeholder" class="rounded" src="#" width="230px" height="170px"></span>
                <div class="title m-b-mb">Ray Software Service</div>

                <div class="links" style="display:center;">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Support</a>
                    <a href="#">Mobile App</a>
                </div>
            </div>
        </div>
    </body>
</html>
