<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Rider OTP Check</title>
</head>
<body>
    <style>
        a{
            text-decoration:none;
        }
    </style>
    <div class="container-fluid vh-100 bg-secondary">
    <br><br><br><br><br><br><br>
            <div class="" style="margin-top:100px ">
                <div class="rounded d-flex justify-content-center rounded">
                    <div class="col-md-4 col-sm-12 shadow-lg bg-light rounded">
                        <div class="text-center">
                        <br>
                            <h3 class="text-warning">Otp</h3>
                        </div>
                        <form action="{{route('riderOtp')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                </div>
                         @endif


  
                                    <input type="text" class="form-control" name="otp" id="otp" value="{{old('otp')}}" placeholder="Enter your OTP"><br><br>
                                <div class="d-grid col-12 mx-auto">
                                    <input type="submit" class="btn btn-warning" value="Send" >
                                </div>

                        </div>
    </form>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>