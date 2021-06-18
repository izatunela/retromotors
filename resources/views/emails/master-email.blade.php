<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        *{
            font-family: Avenir,sans-serif;
            margin: 0;
        }
        html,body{
            width: 100%;
            height: 100%;
            margin: 0 !important;
        }
        .container{
            width: 100%;
        }
        .header{
            margin: 20px 0;
        }
        #header-logo{
            width: 100%;
            max-width: 200px;
        }
        .inner{
            width: 90%;
            margin: 0 auto;
        }
        .body-message{
            margin: 15px 0;
        }
        #socials img{
            width: 32px;
        }
        .button{
            margin: 50px auto;
        }
        .button a{
            background: #009ADA;
            color: #fff;
            width: 50px;
            padding: 10px 20px;
            border-radius: 2px;
            font-weight: 700;
        }
        a{
            text-decoration: none;
            word-wrap: break-word;
        }
        p{
            color: #333;
        }
        @media only screen and (min-width: 865px){
            .container{
                width: 50%;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="inner">
            <div class="header">
                <img id="header-logo" src="{{asset('img/retromotorslogo.png')}}" alt="">
            </div>
            <div class="content">
                @yield('content')
            </div>
            <footer>
                <p>Srdačan pozdrav,<br>Retro Motors</p>
                <hr style="margin:10px 0;opacity:0.5;border-top-color: #EDEFF2;border-bottom: transparent;">
                <div id="socials">
                    <a href="https://www.facebook.com/retromotors.rs/"><img src="{{asset('img/fb.png')}}"></a>
                    <a href="https://www.instagram.com/retromotors.rs/"><img src="{{asset('img/insta.png')}}"></a>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>