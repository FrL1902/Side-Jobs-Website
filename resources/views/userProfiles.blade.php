@extends('layout.layout')
@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-center mt-4">
          <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4">User Profile: {{$userData->first_name . ' ' . $userData->last_name}}</span>
          </a>
        </div>
        <div class="container mt-3" style="border-bottom: 5px solid rgb(54, 54, 54)">

        </div>
    </header>
        </div>
        <div class="container d-flex flex-row " style="height:70vh">
            {{-- <p>{{$userInfo->id}}</p> --}}
            <div class="p-2" style="width:22%">
                @if ($userData->image_path == '-')
                <img class="img-place rounded mx-auto d-block"
                    style="height: 69%;  width:100%"
                    src="https://media.istockphoto.com/id/1300845620/id/vektor/ikon-pengguna-datar-terisolasi-pada-latar-belakang-putih-simbol-pengguna-ilustrasi-vektor.jpg?s=612x612&w=0&k=20&c=QN0LOsRwA1dHZz9lsKavYdSqUUnis3__FQLtZTQ--Ro="
                    alt="no image" loading="lazy">
                @else
                <img class="img-place rounded mx-auto d-block"
                    style="height: 69%;  width:100%"
                    src="{{ Storage::url($userData->image_path) }}"
                    alt="no image" loading="lazy">
                @endif
            </div>
            <div class="p-2" style="width:26%;">
                <div class="d-flex flex-column mb-3" style="height: 100%;">
                    <div class="p-2 text-center" style="height: 10%;">
                        <h5>User Info</h5>
                    </div>
                    <div class="p-2 text-start flex-column" style="height: 80%; border-right: 2px solid rgb(130, 130, 130); color:black; font-weight:bold">
                        <div class="mt-2">
                            <span>Email</span>
                            <p>{{$userData->email}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Phone Number</span>
                            <p>{{$userData->phone_number}}</p>
                        </div>
                        <div class="mt-2">
                            <span>City</span>
                            @if ($userData->city_id == '-')
                                <p>-</p>
                            @else
                                <p>{{App\Models\City::seeCity($userData->city_id)}}</p>
                            @endif
                        </div>
                        <div class="mt-2">
                            <span>Address</span>
                            <p>{{$userData->address}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Account Created</span>
                            <p>{{date_format(date_create($userData->created_at), 'd-M-Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 text-center" style="width:26%">
                <div class="d-flex flex-column mb-3" style="height: 100%;">
                    <div class="p-2 text-center" style="height: 10%;"><h5>Worker Info</h5></div>
                    <div class="p-2 text-start flex-column" style="height: 80%; border-right: 2px solid rgb(130, 130, 130); border-left: 2px solid rgb(130, 130, 130); color:black; font-weight:bold">
                        <div class="mt-2">
                            <span>Description</span>
                            <p>{{$workerInfo->worker_description}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Preference</span>
                            <p>{{$workerInfo->worker_preference}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Jobs Done</span>
                            <p>{{App\Models\Job::seeFinishedJobs($workerInfo->user_email)}}</p>
                        </div>
                        @if (App\Models\Job::seeFinishedJobs($workerInfo->user_email) >0)
                            <div class="mt-2">
                                <span>Average Job Rating</span>
                                <p>{{App\Models\Job::seeRating($workerInfo->user_email)}} / 5 stars</p>
                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-2 text-center" style="width:26%">
                <div class="d-flex flex-column mb-3" style="height: 100%;">
                    <div class="p-2 text-center" style="height: 10%;"><h5>Employer Info</h5></div>
                    <div class="p-2 text-start" style="height: 80%; border-left: 2px solid rgb(130, 130, 130); color:black; font-weight:bold">
                        @if ($employerInfo->is_unlocked == 'yes')
                            <div class="mt-2">
                                <span>Description</span>
                                <p>{{$employerInfo->employer_description}}</p>
                            </div>
                            <div class="mt-2">
                                <span>Address</span>
                                <p>{{$employerInfo->employer_address}}</p>
                            </div>
                            <div class="mt-2">
                                <span>Jobs Opened</span>
                                <p>{{$jobCount}}</p>
                            </div>
                        @else

                        <div class="p-2 text-center">
                            <span>user has not applied yet</span>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

