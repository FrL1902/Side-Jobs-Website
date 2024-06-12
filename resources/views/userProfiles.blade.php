@extends('layout.layout')
@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-center mt-4">
          <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4">User Profile: {{$userInfo->first_name . ' ' . $userInfo->last_name}}</span>
          </a>
        </div>
        <div class="container mt-3" style="border-bottom: 5px solid rgb(54, 54, 54)">

        </div>
    </header>
        </div>
        <div class="container d-flex flex-row " style="height:70vh">
            {{-- <p>{{$userInfo->id}}</p> --}}
            <div class="p-2" style="width:22%">
                @if ($userInfo->image_path == '-')
                <img class="img-place rounded mx-auto d-block"
                    style="height: 69%;  width:100%"
                    src="https://cdn.discordapp.com/attachments/1211571942965125160/1248652686350483506/image.png?ex=6665c36f&is=666471ef&hm=a6f77486ba2416785ba3f3dabc9152dc9a6169213de3ca343b65958142c7d778&"
                    alt="no image" loading="lazy">
                @else
                <img class="img-place rounded mx-auto d-block"
                    style="height: 69%;  width:100%"
                    src="{{ Storage::url($userInfo->image_path) }}"
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
                            <p>{{$userInfo->email}}</p>
                        </div>
                        <div class="mt-2">
                            <span>Phone Number</span>
                            <p>{{$userInfo->phone_number}}</p>
                        </div>
                        <div class="mt-2">
                            <span>City</span>
                            @if ($userInfo->city_id == '-')
                                <p>-</p>
                            @else
                                <p>{{$userInfo->city_name}}</p>
                            @endif
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

