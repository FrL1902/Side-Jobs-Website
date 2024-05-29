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
    <main>
        <div class="w-50 center border rounded px-3 py-3 mx-auto">
            <h2 class="text-center" style="color:white"><span style="color: rgb(57, 82, 208)">Odder</span><span style="color: rgb(245, 205, 25)">Work</span></h2>
            <form action="/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                @if (session('status'))
                        <p class="text-center text-danger">{{ session('status') }}</p>
                @endif
                <div class="form-group" style="padding-top:0; padding-bottom:0" id="submitIncomingButtonAdd">
                    <div class="card mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
            <a class="text-end" href="/registerPage" style>don't have an account?</a>
        </div>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
