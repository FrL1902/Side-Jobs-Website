@extends('layout.layout')
@section('homeButton', 'active')

@section('content')


@auth

@else
<section class="hero-section hero-slide d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 text-center mx-auto">
                <div class="hero-section-text">
                    @auth
                    <small style="font-weight:bolder; color:white">Welcome to OdderWork</small>
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
@endauth


{{-- <header class="py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Double header</span>
      </a>
      <form class="col-12 col-lg-auto mb-3 mb-lg-0">
        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
      </form>
    </div>
  </header> --}}

<section style="background-color: rgb(234, 234, 234)">
    @auth
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-center mt-4">
          <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4">Welcome, {{Auth::user()->first_name}}!</span>
          </a>
          {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form> --}}
          {{-- <div> --}}
            <span class="d-flex align-items-center mb-3 mb-lg-0 text-dark text-decoration-none">User Role:
                @if (Auth::user()->role == 1)
                    Worker
                @elseif (Auth::user()->role == 2)
                    Employer
                @elseif (Auth::user()->role == 3)
                    ADMIN
                @endif
            </span>
          {{-- </div> --}}
        </div>
        <div class="container mt-3" style="border-bottom: 5px solid rgb(54, 54, 54)">

        </div>
    </header>
    @endauth
    <div class="container">
        @auth
            @if (Auth::user()->role == 3)
            @else

            @endif
        @endauth
        <div class="d-flex justify-content-between">
            <div>
                @auth
                    @if (Auth::user()->role == 2)
                        <h3 class="mt-3">Here are your active job postings</h3>
                    @elseif (Auth::user()->role == 1)
                        <h3 class="mt-3">Here are some newly posted jobs</h3>
                    @endif
                @else
                    <h3 class="mt-3">Here are some newly posted jobs</h3>
                @endauth
            </div>
            @auth
                @if (Auth::user()->role == 3)

                @elseif (Auth::user()->role == 1)
                    <div class="justify-content-center">
                        <a type="button" class="btn align-middle mt-3" style="color:white; background-color: rgb(256,212,76)" href="/searchJobs">Search more jobs</a>
                        {{-- <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Search more jobs</button> --}}
                    </div>
                @elseif (Auth::user()->role == 2)
                    <div class="justify-content-center">
                        <a type="button" class="btn align-middle mt-3" style="color:white; background-color: rgb(256,212,76)" href="/#">Manage your jobs</a>
                        {{-- <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Manage your jobs</button> --}}
                    </div>
                @endif
            @else
                <div class="justify-content-center">
                    {{-- <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Search more jobs</button> --}}
                    <a type="button" class="btn align-middle mt-3" style="color:white; background-color: rgb(256,212,76)" href="/searchJobs">Search more jobs</a>
                </div>
            @endauth


            {{-- <div class="d-flex justify-content-center">
                <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Search more jobs</button>
            </div> --}}
        </div>
        @auth
            @if (auth()->user()->role != 3)
                <div class="container d-flex flex-row" style="min-height:70vh; width:100%">
                    <div style="width:50%; padding-bottom: 20px;">
                        <div class="d-flex flex-column" style="height: 100%; border-right: 1px solid rgb(130, 130, 130); padding:10px">
                            <div class="p-2 mb-1 text-center" style="height: 8%;">
                                <h5>Your Active jobs</h5>
                            </div>
                            @if (count($activeJobs)>0)
                                @foreach ($activeJobs as $data)
                                    <div class="d-flex flex-row mb-3" style="height: 220px;border-radius: 10px;
                                    border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                                        <div class="text-start" style="height: 100%; width:60%">
                                            <h6>{{$data->job_title}}</h6>
                                            <p>{{$data->job_description}}</p>
                                        </div>
                                        <div class="text-start" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                                        border: 2px solid #000000;">
                                            <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                            <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                            <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                            <p style="font-size:15px"><strong>Status:</strong>
                                                @if ($data->job_status == 'opened')
                                                    <strong style="color: rgb(0, 198, 0)">Opened</strong>
                                                @else
                                                    <strong style="color: rgb(198, 148, 0)">Ongoing</strong>
                                                @endif
                                            </p>
                                            <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white; transform: translateY(-30px);" href="/jobInfo/{{$data->id}}">View Job</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-2 mb-1 text-center" style="height: 8%;">
                                    <p>no data</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div style="width:50%; padding-bottom: 20px;">
                        <div class="d-flex flex-column" style="height: 100%; border-left: 1px solid rgb(130, 130, 130); padding:10px">
                            <div class="p-2 mb-1 text-center" style="height: 8%;">
                                <h5>Newly Posted Jobs</h5>
                            </div>
                            @if (count($availableJobs)>0)
                                @foreach ($availableJobs as $data)
                                    <div class="d-flex flex-row mb-3" style="height: 220px;border-radius: 10px;
                                    border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                                        <div class="text-start" style="height: 100%; width:60%">
                                            <h6>{{$data->job_title}}</h6>
                                            <p>{{$data->job_description}}</p>
                                        </div>
                                        <div class="text-start" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                                        border: 2px solid #000000;">
                                            <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                            <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                            <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                            <p style="font-size:15px"><strong>Status:</strong>
                                                <strong style="color: rgb(0, 198, 0)">Opened</strong>
                                            </p>
                                            <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white; transform: translateY(-30px);" href="/jobInfo/{{$data->id}}">View Job</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-2 mb-1 text-center" style="height: 8%;">
                                    <p>no data</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="container" style="min-height:70vh; width:100%">
                </div>
            @endif
        @endauth
        @guest
        <div style="width:100%; padding-bottom: 20px;">
            <div class="d-flex flex-column" style="height: 100%; padding:10px">
                <div class="p-2 mb-1 text-center" style="height: 8%;">
                    <h5>Newly Posted Jobs</h5>
                </div>
                @if (count($availableJobs)>0)
                    @foreach ($availableJobs as $data)
                        <div class="d-flex flex-row mb-3" style="height: 220px;border-radius: 10px;
                        border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                            <div class="text-start" style="height: 100%; width:60%">
                                <h6>{{$data->job_title}}</h6>
                                <p>{{$data->job_description}}</p>
                            </div>
                            <div class="text-start" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                            border: 2px solid #000000;">
                                <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                <p style="font-size:15px"><strong>Status:</strong>
                                    <strong style="color: rgb(0, 198, 0)">Opened</strong>
                                </p>
                                <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white; transform: translateY(-30px);" href="/viewJob/{{$data->id}}">View Job</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-2 mb-1 text-center" style="height: 8%;">
                        <p>no data</p>
                    </div>
                @endif
            </div>
        </div>
        @endguest
    </div>
</section>

@endsection

