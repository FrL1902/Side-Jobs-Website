@extends('layout.layout')
@section('homeButton', 'active')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    @auth
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-center mt-4">
          <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4">Manage Applicants</span>
          </a>
            <span class="d-flex align-items-center mb-3 mb-lg-0 text-dark text-decoration-none">User Role:
                @if (Auth::user()->role == 1)
                    Worker
                @elseif (Auth::user()->role == 2)
                    Employer
                @elseif (Auth::user()->role == 3)
                    ADMIN
                @endif
            </span>
        </div>
        <div class="container mt-3" style="border-bottom: 5px solid rgb(54, 54, 54)">

        </div>
    </header>
    @endauth

    <div class="container d-flex flex-wrap justify-content-center mt-4" style="min-height: 80vh">
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 3%">id</th>
                            <th class="text-center" style="width: 3%">unlocked</th>
                            <th class="text-center" style="width: 3%">applied</th>
                            <th class="text-center">email</th>
                            <th class="text-center">address</th>
                            <th class="text-center">description</th>
                            <th class="text-center" style="width: 13%">date updated</th>
                            <th class="text-center" style="width: 7%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">unlocked</th>
                            <th class="text-center">applied</th>
                            <th class="text-center">email</th>
                            <th class="text-center">address</th>
                            <th class="text-center">description</th>
                            <th class="text-center">date updated</th>
                            <th class="text-center" style="width: 7%">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($employer as $data)
                            <tr>
                                <td class="text-center align-middle">{{$data->id}}</td>
                                <td class="text-start align-middle">{{$data->is_unlocked}}</td>
                                <td class="text-start align-middle">{{$data->has_applied}}</td>
                                <td class="text-start align-middle">{{$data->user_email}}</td>
                                <td class="text-start align-middle">{{$data->employer_address}}</td>
                                <td class="text-start align-middle">{{$data->employer_description}}</td>
                                <td class="text-start align-middle">{{ date_format(date_create($data->updated_at), 'd-M-Y')}}</td>
                                @if ($data->is_unlocked == 'yes' && $data->has_applied == 'yes')
                                    <td class="text-center align-middle" style="font-weight:bold; color:rgb(1, 181, 1)">activated</td>
                                @elseif ($data->is_unlocked == 'no' && $data->has_applied == 'no')
                                    <td class="text-center align-middle" style="font-weight:bold; color:rgb(181, 16, 1)">has not applied</td>
                                @else
                                {{-- unlocked no, applied yes ||normal --}}
                                {{-- unlocked yes, applied no ||ga normal || kalo udah unlocked emang harus udah apply dulu, jadi case ini harusnya ga ada --}}
                                <td class="align-middle"><button type="button" class="btn btn-primary"
                                    data-bs-target="#decideModal"
                                    data-bs-toggle="modal"
                                    data-pic_url="{{ $data->id }}"
                                    >Decide</button></td>
                                @endif
                            </tr>
                            {{-- modal --}}
                            <div class="modal fade" id="decideModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Employer Applicant</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah user "{{$data->user_email}}" cocok untuk menjadi employer / pemberi pekerja?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/declineApplicant/{{$data->user_email}}" class="btn btn-danger">Tidak</a>
                                        <a href="/acceptApplicant/{{$data->user_email}}" class="btn btn-primary">Ya</a>
                                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                        <button type="button" class="btn btn-primary">Ya</button> --}}
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>





    </div>

</section>

@endsection


@section('script')
@endsection
