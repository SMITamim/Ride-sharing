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
    <title>Customer Registration</title>
</head>
<body>
    <style>
        a{
            text-decoration:none;
        }
    </style>

    <div class="container-fluid vh-100">
            <div class="" style="margin-top:100px">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow-lg bg-light">
                        <div class="text-center">
                            <h3 class="text-primary">Create Account</h3>
                        </div>
                        <form action="{{route('customerCreateSubmit')}}" class="form-group" method="post" enctype="multipart/form-data">
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


                         @if (\Session::has('failed'))
                         <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('failed') !!}
                        </div>
                        @endif

                        @if (\Session::has('success'))
                         <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('success') !!}
                        </div>
                        @endif



                            <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person text-white"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Name"><br>

                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-calendar text-white"></i></span>
                                    <input type="date" class="form-control" name="dob" id="dob" value="{{old('dob')}}"><br>


                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-telephone text-white"></i></span>
                                    <input type="tel" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Phone Number"><br>

                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-geo-alt text-white"></i></span>
                                    <input type="tel" class="form-control" name="address" id="address" value="{{old('address')}}" placeholder="Your Address"><br>

                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person-plus-fill text-white"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Username"><br>

                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-envelope text-white"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Email">


                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="password"><br>

                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                    class="bi bi-file-earmark-arrow-up text-white"></i></span>
                                    <input class="form-control" type="file" id="formFile" name="image" id="image" value="{{old('image')}}" placeholder="Upload Image"><br>

                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <input type="submit" class="btn btn-primary" value="Sign Up" >
                                </div>
                                <p class="text-center mt-3">Already have an account?
                                    <span class="text-primary"><a href="{{route('customerLogin')}}">Sign in</a></span>

                                </p>

                        </div>
    </form>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>