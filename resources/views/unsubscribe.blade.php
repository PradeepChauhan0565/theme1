<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .update-btn {
            border: 1px solid #071d49;
            border-radius: 7px;
            background-color: #071d49;
            color: white;
        }

        .update-btn:hover {
            background-color: white;
            color: #071d49;

        }
    </style>

</head>

<body>
    <div class="container" style="color:#071d49">

        <div class="container" style="color:#071d49">

            <div class="row justify-content-center mt-5">
                <div class="col-lg-5 text-center py-5 px-4"
                    style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="  mb-4">
                        <p style=""> By entering your email id below you will be unsubscribed from our Newsletter
                        </p>
                    </div>
                    <form action="{{ asset('unsubscribe') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input style="border:1px solid #6c7485;" class="w-100 px-4 py-2 rounded" type="text"
                            placeholder="Email" value="{{ $email }}" name="email"><br>
                        <button onclick="return confirm('Are you sure you want to unsubscribe?')"
                            class="my-4 update-btn py-2 px-4">Update Now</button>
                    </form>

                    @if (session()->has('msg'))
                        <div class="alert alert-success">
                            <div class="  mb-3">
                                <h2 style=""> Thanks!</h2>
                            </div>
                            <div>{{ session('msg') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
