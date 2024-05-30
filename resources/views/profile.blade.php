@extends('layout.layout')
@section('content')

<section style="background-color: rgb(234, 234, 234)">
    @auth
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-center mt-4">
          <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4">User Profile: {{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</span>
          </a>
        </div>
        <div class="container mt-3" style="border-bottom: 5px solid rgb(54, 54, 54)">

        </div>
    </header>
    @endauth

        </div>
        <div class="container d-flex flex-row " style="height:70vh">
            {{-- <p>{{$userInfo->id}}</p> --}}
            <div class="p-2" style="width:22%">
                <img class="img-place rounded mx-auto d-block"
                                    style="height: 69%;  width:100%"
                                    src="https://cdn.discordapp.com/attachments/1118167456347852921/1245693363131387985/image.png?ex=6659add9&is=66585c59&hm=9c9fd9cd2fccf8e0614f7f6f1c2ac460034e547101c666d57d8cf148ba0578ba&"
                                    alt="no picture" loading="lazy">
                                    <div class="p-2 text-center" style="height: 10%;">
                                        <button type="button" class="btn btn-info">Edit Image</button>
                                    </div>
            </div>
            <div class="p-2" style="width:26%;">
                <div class="d-flex flex-column mb-3" style="height: 100%;">
                    <div class="p-2 text-center" style="height: 10%;">
                        <h5>User Info</h5>
                    </div>
                    <div class="p-2 text-start flex-column" style="height: 80%; border-right: 2px solid rgb(130, 130, 130); color:black; font-weight:bold">
                        <div class="mt-2">
                            <span>Email</span>
                            <p>{{$userInfo->email}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Phone Number</span>
                            <p>{{$userInfo->phone_number}}</p>
                        </div>
                        <div class="mt-2">
                            <span>City</span>
                            <p>{{$userInfo->city_id}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Address</span>
                            <p>{{$userInfo->address}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Account Created</span>
                            <p>{{date_format(date_create($userInfo->created_at), 'd-M-Y')}}</p>
                        </div>
                    </div>
                    <div class="p-2 text-center" style="height: 10%;">
                        <button type="button" class="btn btn-info">Edit User Info</button>
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
                            <p>12345</p>
                        </div>
                        <div class="mt-2">
                            <span>Average Job Rating</span>
                            <p>xx / 5 stars</p>
                        </div>
                    </div>
                    <div class="p-2 text-center" style="height: 10%;">
                        <button type="button" class="btn btn-info">Edit Worker Info</button>
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
                                <p>12345</p>
                            </div>
                        @else

                        <div class="p-2 text-center">
                            <span>user has not applied yet</span>
                        </div>
                        @endif

                    </div>
                    <div class="p-2 text-center" style="height: 10%;">
                        <button type="button" class="btn btn-info">Edit Employer Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

