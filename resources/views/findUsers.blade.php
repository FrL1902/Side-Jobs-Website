@extends('layout.layout')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
        <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <h2>Find Users Page</h2>
        </a>
        <button type="button" style="height:100%" class="btn btn-warning" data-bs-target="#filterUserModal"data-bs-toggle="modal">FILTER</button>
        </div>
    </header>
    <div class="container d-flex flex-column" style="min-height:50vh; width:100%">
        <div class='d-flex col-9 flex-column'>
            <div class="row d-flex justify-content-start g-0" id="areaList">
            @foreach ($users as $data)
                <div class="col-4">
                    <a href="/profile/view/{{$data->id}}" style="text-decoration: none">
                        <div class="card my-2" style="width: 18rem; height: 25rem">
                            @if ($data->image_path == '-')
                            <img class="img-place rounded mx-auto d-block"
                                style="height: 200px;  width:100%"
                                src="https://media.istockphoto.com/id/1300845620/id/vektor/ikon-pengguna-datar-terisolasi-pada-latar-belakang-putih-simbol-pengguna-ilustrasi-vektor.jpg?s=612x612&w=0&k=20&c=QN0LOsRwA1dHZz9lsKavYdSqUUnis3__FQLtZTQ--Ro="
                                alt="no image" loading="lazy">
                            @else
                            <img class="img-place rounded mx-auto d-block"
                                style="height: 69%;  width:100%"
                                src="{{ Storage::url($data->image_path) }}"
                                alt="no image" loading="lazy">
                            @endif
                            {{-- <img src="asdf"
                                style="width: 100%; height: 200px" class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                                <h6 class="my-2">{{ $data->first_name . ' ' . $data->first_name }}</h6>
                                @if ($data->city_id == '-')
                                    <h6 class="text-secondary">Location: -</h6>
                                @else
                                    <h6 class="text-secondary">Location: {{App\Models\City::seeCity($data->city_id)}}</h6>
                                @endif
                                <p class="card-text text-black" style="margin-top: 60px">Account Created: {{date_format(date_create($data->created_at), 'd-M-Y')}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        <div class="d-flex justify-content-center mb-4 mt-4">
            {{$users->links()}}
        </div>
</section>

<div class="modal fade" id="filterUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Filter User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/makeJob">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="supplier">User Area</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Choose a city" value="" id="employer_address"
                        name="employer_address">
                </div>
                <div class="form-group mt-3">
                    <label for="supplier">User name</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="type a user's name" value="" id="name"
                        name="employer_address">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- @foreach ($users as $data)
<p>{{$data->email}}</p>


@endforeach
{{$users->links()}} --}}
@endsection
