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
                <div class="p-2 text-center" style="height: 10%;">
                    {{-- <button type="button" class="btn btn-info">Edit Image</button> --}}
                    <button type="button" class="btn btn-primary"
                            data-bs-target="#editPictureModal"
                            data-bs-toggle="modal"
                            >Edit Picture</button>
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
                    <div class="p-2 text-center" style="height: 10%;">
                        {{-- <button type="button" class="btn btn-info">Edit User Info</button> --}}
                        <button type="button" class="btn btn-primary"
                                                data-bs-target="#editUserInfoModal"
                                                data-bs-toggle="modal"
                                                >Edit User Info</button>
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
                        {{-- <button type="button" class="btn btn-info">Edit Worker Info</button> --}}
                        <button type="button" class="btn btn-primary"
                                                data-bs-target="#editWorkerInfoModal"
                                                data-bs-toggle="modal"
                                                >Edit Worker Info</button>
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
                    <div class="p-2 text-center" style="height: 10%;">
                        {{-- <button type="button" class="btn btn-info">Edit Employer Info</button> --}}
                        <button type="button" class="btn btn-primary"
                                                data-bs-target="#editEmployerInfoModal"
                                                data-bs-toggle="modal"
                                                >Edit Employer Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- edit picture modal --}}
<div class="modal fade" id="editPictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Picture</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/changePicture">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="largeInput">Enter New Picture (max: 10MB)</label>
                    <input type="file" class="form-control form-control-sm" style="border-color: #aaaaaa" id="user_image" name="user_image">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Change Picture</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- edit user info modal --}}
<div class="modal fade" id="editUserInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/changeUserInfo">
            @csrf
            <div class="modal-body">
                <div class="form-group mt-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Address" value="{{$userInfo->phone_number}}" id="phone_number"
                        name="phone_number">
                </div>
                <div class="form-group mt-3">
                    {{-- <label for="city">City</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="City" value="{{$userInfo->city_id}}" id="city"
                        name="city"> --}}

                    <label for="editUserInfo">City</label>
                    <select class="form-control" id="editUserInfo"
                        data-width="100%" name="city">
                        @if ($userInfo->city_id == '-')
                            <option value="">pilih kota anda saat ini</option>
                        @else
                            <option value="{{$userInfo->city_id}}">{{$userInfo->city_name}}</option>
                        @endif
                        @foreach ($cities as $data)
                            {{-- <option>asdfsa</option> --}}
                            <option value="{{ $data->id }}">
                                {{ $data->city_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="user_address">Address</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Address" value="{{$userInfo->address}}" id="user_address"
                        name="user_address">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Change User Info</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- edit worker info modal --}}
<div class="modal fade" id="editWorkerInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Worker Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/changeWorkerInfo">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="supplier">Description</label>
                    {{-- <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Address" value="{{$workerInfo->worker_description}}" id="worker_description"
                        name="worker_description"> --}}
                    <textarea class="form-control" rows="3" name="worker_description" id="worker_description">{{$workerInfo->worker_description}}</textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="supplier">Preference</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Address" value="{{$workerInfo->worker_preference}}" id="worker_preference"
                        name="worker_preference">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Change Worker Info</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- edit employer info modal --}}
<div class="modal fade" id="editEmployerInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employer Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/changeEmployerInfo">
            @csrf
            <div class="modal-body">
                {{-- <div class="form-group">
                    <label for="largeInput">Enter New Picture (max: 10MB)</label>
                    <input type="file" class="form-control form-control-sm" style="border-color: #aaaaaa" id="itemImage" name="incomingItemImage">
                </div> --}}
                <div class="form-group">
                    <label for="supplier">Description</label>
                    <textarea class="form-control" rows="3" name="employer_description" id="employer_description">{{$employerInfo->employer_description}}</textarea>
                    {{-- <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Description" value="{{$employerInfo->employer_description}}" id="supplier"
                        name="supplier"> --}}
                </div>
                <div class="form-group mt-3">
                    <label for="supplier">Address</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Address" value="{{$employerInfo->employer_address}}" id="employer_address"
                        name="employer_address">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Change Employer Info</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#editUserInfo').select2({
        dropdownParent: $('#editUserInfoModal'),
        // placeholder: 'Pilih Kota'
    });
</script>

@endsection
