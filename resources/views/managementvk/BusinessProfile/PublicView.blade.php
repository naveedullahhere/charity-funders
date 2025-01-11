<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/324353ac19.js" crossorigin="anonymous"></script>
    <title>{{$businessProfile->title}}</title>
    <style>
        .bg-light {
            background-color: #515659 !important;
        }
        body{
            font-family: "Poppins", sans-serif;
        }
        .poppins-bold {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: normal;
        }
        iframe {
            width: 100% !important;
            margin-block: 20px;
        }
        a#\31 {
            background: #D95000;
            color: white !important;
            font-size: 20px;
            border-radius: 6px;
        }
        /*.navbar{*/
        /*    background: rgba(255, 255, 255, .9) !important;*/
        /*    z-index: 1050;*/
        /*    box-shadow: 0px 2px 6px rgba(90,90,90,0.2) !important;*/
        /*}*/
        .navbar {
            background: #323639 !important;
            z-index: 1050;
            box-shadow: 0px 2px 6px rgb(90 90 90) !important;
            color: white !important;
        }
        .header-text {
            font-size: 16px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-white bg-white sticky-top">
    <div class="container-fluid">
        <h6 class="text-center w-100 m-0 py-3 header-text" href="#">
            {{$businessProfile->title}}
        </h6>
    </div>
</nav>
<section class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto p-4 bg-white">
                @if(isset($header_image->path) != null)
                    <img class="w-100" src="{{url('file/'.$header_image->path)}}" alt="">
                @endif
                <div class="p-4">
                    <h1 class="poppins-bold">{{$businessProfile->title}}</h1>
                    <div>
                        {!! $businessProfile->description !!}
                    </div>
                    <div class="list-group list-group-flush">
                        <a id="1" href="{{$businessProfile->website}}" target="_blank" class="list-group-item list-group-item-action text-custom-brand-gp  d-flex justify-content-between align-items-center">
            <span style="font-weight: 600; gap: 1em" class="d-flex align-items-center flex-grow-1">
              <i class="fa-lg fa-fw fas fa-link"></i>
              <span class="two-line-ellipsis">
                Website
              </span>
            </span>
                            <span class="pl-1"><i class="fas fa-chevron-right fa-xs"></i></span>
                        </a>

                    </div>
                    @if($media)
                        @foreach($media as $image)
                            <img class="w-100 my-2" src="{{url('file/'.$image->path)}}" alt="">
                        @endforeach
                    @endif

                    <iframe width="768" height="500" src="{{$businessProfile->youtube_links}}" title="Satisfied Customer Feedback | Water Management System | Shafaat Ali #harjagahasani #shafaatali" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>        </div>

            </div>
        </div>
    </div>

</section>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
