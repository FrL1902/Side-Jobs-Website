@extends('layout.layout')
@section('homeButton', 'active')

@section('content')

<section class="hero-section hero-slide d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 text-center mx-auto">
                <div class="hero-section-text">
                    @auth
                    <small style="font-weight:bolder; color:white">Welcome to OdderWork {{Auth::user()->first_name}}</small>
                    @endauth

                    <h1 class="hero-title text-white mt-2 mb-4">Find and set jobs to meet your needs</h1>

                    <div class="hero-btn d-flex justify-content-center align-items-center">
                        <a class="bi-arrow-down hero-btn-link smoothscroll" href="#section_2"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding" id="section_2">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 col-12">
                <h2 class="mt-2 mb-4">Why OdderWork?</h2>

                <h4 class="text-muted mb-3">in the beginning, we want to connect people better</h4>

                <p>OdderWork is an online platform for side job posting and searching. The main purpose of this platform is to bridge people that need workers and people who need jobs better than any website. We hope you find this platform as useful as we do.</p>
            </div>

            <div class="col-lg-3 col-md-5 col-5 mx-lg-auto">
                <img src="images/ikea-assembly.jpg" class="about-image about-image-small img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-7 col-7">
                <img src="images/pay.png" class="about-image img-fluid" alt="">
            </div>

        </div>
    </div>
</section>

<section style="background-color: rgb(226, 226, 226)">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h3 class="mt-3">Here are some newly posted jobs!</h3>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Search more jobs</button>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="d-flex row flex-wrap mt-2 justify-content-start mb-4">
                {{-- @foreach ($data as $d) --}}
                <div class="col-3">
                    <a href="xxx" style="text-decoration: none;">
                        <div class="card my-1" style="width: 18rem; height: 30rem">
                            <img src="https://cdn.discordapp.com/attachments/1211571942965125160/1244616830744530944/image.png?ex=66566c00&is=66551a80&hm=b5df70e02b873174ec84debad2d0d360c34217178046057ce80232cd0c2721d3&"
                                style="width: 100%; height: 200px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="my-2">name</h6>
                                <p class="card-text text-black">deadline</p>
                                <h6 class="text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet sequi sit voluptate</h6>
                            </div>
                            <div class="card-footer bg-transparent flex-row d-flex justify-content-between">
                                <div class="text-secondary">Pay: Rp 25000000</div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
</section>

@endsection

