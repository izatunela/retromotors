<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="">
    <style>
        .checker{
            background-image: linear-gradient(-45deg, #333 25%, transparent 25%),linear-gradient(45deg,#333 25% , transparent 25%),linear-gradient(-45deg,transparent 75% , #333 75%),linear-gradient(45deg,transparent 75% , #333 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            height: 30px;
            position: relative; ;
            z-index: -1;
            margin: 0 auto;
            margin-bottom: 20px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
                <div class="checker" style=""></div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="logo">
                    <img class="" style="max-width:400px;width:100%;display: block;margin: auto" src="{{asset('img/retromotorslogo.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <img style="max-width:400px;width:100%;display: block;margin:50px auto" src="{{asset('img/assembly.png')}}" alt="" width="500">
                <h3 style="font-family: monospace; text-align: center;font-weight: bold;font-size: 40px">ODRŽAVANJE SAJTA U TOKU<h3>
            </div>
        </div>
        <div class="checker" style=""></div>
    </div>
</body>
</html>