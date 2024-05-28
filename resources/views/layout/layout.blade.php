<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OdderWork</title>
    <link rel="icon" href="https://cdn.discordapp.com/attachments/1211571942965125160/1244616830744530944/image.png?ex=6655c340&is=665471c0&hm=b64ac6949677b54e7e5954e58320f37e799a27d66076fab9329d62f0b1c34d0f&" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/tooplate-moso-interior.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="/"><span style="color: rgb(57, 82, 208)">Odder</span><span style="color: rgb(245, 205, 25)">Work</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @yield('homeButton')" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @yield('findJobButton')" href="/searchJobs">Find Jobs</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle click-scroll" href="#section_3" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="shop-listing.html">Shop Listing</a></li>

                            <li><a class="dropdown-item" href="shop-detail.html">Shop Detail</a></li>
                        </ul>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link @yield('findUserButton')" href="/searchUsers">Find Users</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/loginPage" style="font-weight: bolder; color:black">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="background-color:rgb(22, 36, 65)">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 col-12 mb-3 mt-4">
                    <h3 style="color:white"><span style="color: rgb(57, 82, 208)">Odder</span><span style="color: rgb(245, 205, 25)">Work</span></h3>
                    <p class="text-white">Setting up jobs since 2024</p>
                </div>

                <div class="col-lg-3 col-md-3 col-12 ms-lg-auto mb-3 mt-4">
                    <h3 class="text-white mb-3">Available in</h3>

                    <p class="text-white mt-2">
                        <i class="bi-geo-alt"></i>
                        Indonesia, Nusantara
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 mb-3 mt-4">
                    <h3 class="text-white mb-3">Contact Info</h3>

                        <p class="text-white mb-1">
                            <i class="bi-telephone me-1"></i>

                            <a href="#" class="text-white">
                                08222627322345
                            </a>
                        </p>

                        <p class="text-white mb-0">
                            <i class="bi-envelope me-1"></i>

                            <a href="#" class="text-white">
                                odderwork@gmail.com
                            </a>
                        </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>
