@extends('layout.layout')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <h2>Job Info
                    @if ($jobInfo->job_status == 'opened')
                        <span style="color: rgb(0, 198, 0)">(Opened)</span>
                    @elseif($jobInfo->job_status == 'ongoing')
                        <span style="color: rgb(198, 148, 0)">(ongoing)</span>
                    @elseif($jobInfo->job_status == 'finished')
                        <span style="color: rgb(0, 89, 198)">(finished)</span>
                    @elseif($jobInfo->job_status == 'cancelled')
                        <span style="color: rgb(198, 23, 0)">(cancelled)</span>
                    @endif
                </h2>

            </a>
            <div>
                <button type="button"  class="btn btn-primary" data-bs-target="#makeJobModal"data-bs-toggle="modal">Edit Job</button>
                {{-- <div class="dropdown"> --}}
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Job Status
                    </button>
                    <ul class="dropdown-menu">
                        @if ($jobInfo->job_status == 'ongoing')
                            <li><a class="dropdown-item" href="#">End Job</a></li>
                        @endif
                            <li><a class="dropdown-item" href="#">Cancel Job</a></li>
                    </ul>
                  {{-- </div> --}}
            </div>
        </div>
    </header>
    <div class="container" style="min-height:100vh">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="card-title align-middle"><h4><strong>Job: </strong>{{$jobInfo->job_title}}</h4></div>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="largeInput">Job Description</label>
                            <input class="form-control" type="text" placeholder="{{$jobInfo->job_description}}"
                                aria-label="Disabled input example" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="largeInput">Job Compensation</label>
                            <input class="form-control" type="text" placeholder="{{$jobInfo->job_compensation}}"
                                aria-label="Disabled input example" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="largeInput">Deadline</label>
                            <input class="form-control" type="text" placeholder="{{date_format(date_create($jobInfo->created_at), 'd-M-Y')}}"
                                aria-label="Disabled input example" disabled>
                        </div>
                        @if ($jobInfo->is_online == 'yes')
                            <div class="form-group mb-2">
                                <label for="largeInput">Type of job</label>
                                <input class="form-control" type="text" placeholder="Online"
                                    aria-label="Disabled input example" disabled>
                            </div>
                        @else
                            <div class="form-group mb-2">
                                <label for="largeInput">Type of job</label>
                                <input class="form-control" type="text" placeholder="Offline"
                                    aria-label="Disabled input example" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="largeInput">City</label>
                                <input class="form-control" type="text" placeholder="{{App\Models\City::seeCity($jobInfo->city)}}"
                                    aria-label="Disabled input example" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="largeInput">Address</label>
                                <input class="form-control" type="text" placeholder="{{$jobInfo->address}}"
                                    aria-label="Disabled input example" disabled>
                            </div>
                        @endif
                        <div class="form-group mb-2">
                            <label for="largeInput">Employer</label>
                                <input class="form-control" type="text" placeholder="{{App\Models\User::seeEmployer($jobInfo->employer_id)}}"
                            aria-label="Disabled input example" disabled>
                        </div>
                        {{-- @if (Auth::check())
                            @if ($jobInfo->employer_id == auth()->user()->id)
                                <div class="form-group mt-4" style="width:100%">
                                    <a href="" class="btn btn-danger" style="width:100%">Cannot Apply To Your Own Job</a>
                                </div>
                            @else
                                <div class="form-group mt-4" style="width:100%">
                                    <a href="#" class="btn btn-success" style="width:100%">Apply To Job</a>
                                </div>
                            @endif
                        @else
                            <div class="form-group mt-4" style="width:100%">
                                <a href="/loginPage" class="btn btn-success" style="width:100%">Apply To Job</a>
                            </div>
                        @endif --}}
                        {{-- <div class="card mt-4">
                            <a href="#" class="btn btn-success">Apply to job</a>
                        </div> --}}
                        {{-- <button class="btn btn-success">Apply to job</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- table for job appliers --}}
        <div class="container d-flex flex-wrap justify-content-center" style="min-height: 80vh">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row2" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20%">apply time</th>
                                <th class="text-center" style="width: 10%">name</th>
                                <th class="text-center">description</th>
                                <th class="text-center" style="width: 10%">profile</th>
                                <th class="text-center" style="width: 7%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center" style="width: 20%">apply time</th>
                                <th class="text-center" style="width: 10%">name</th>
                                <th class="text-center">description</th>
                                <th class="text-center" style="width: 10%">profile</th>
                                <th class="text-center" style="width: 7%">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($appliers as $data)
                                <tr>
                                    <td class="text-center align-middle">{{date_format(date_create($data->created_at), 'D H:i:s d-M-Y')}}</td>
                                    <td class="text-start align-middle">{{App\Models\User::seeWorker($data->worker_id)}}</td>
                                    <td class="text-start align-middle">{{$data->apply_description}}</td>
                                    <td class="text-start align-middle"><a class="btn btn-primary" href="/profile/view/{{$data->worker_id}}">See Profile</a></td>
                                    {{-- unlocked no, applied yes ||normal --}}
                                    {{-- unlocked yes, applied no ||ga normal || kalo udah unlocked emang harus udah apply dulu, jadi case ini harusnya ga ada --}}
                                    @if ($data->status == 'applying')
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-primary"
                                            data-bs-target="#decideModal"
                                            data-bs-toggle="modal"
                                            >Decide</button>

                                            <div class="modal fade" id="decideModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Worker Applicant</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda ingin "{{App\Models\User::seeWorker($data->worker_id)}}" sebagai pekerja untuk pekerjaan ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/declineWorker" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="jobId" value="{{$data->job_id}}">
                                                            <input type="hidden" name="workerId" value="{{$data->worker_id}}">
                                                            <button type="submit" class="btn btn-danger">Tidak</button>
                                                        </form>
                                                        <form action="/acceptWorker" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="jobId" value="{{$data->job_id}}">
                                                            <input type="hidden" name="workerId" value="{{$data->worker_id}}">
                                                            <button type="submit" class="btn btn-primary">Ya</button>
                                                        </form>
                                                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                        <button type="button" class="btn btn-primary">Ya</button> --}}
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @elseif ($data->status == 'declined')
                                        <td class="text-center align-middle" style="font-weight:bold; color:rgb(181, 16, 1)">declined</td>
                                    @elseif ($data->status == 'accepted')
                                        <td class="text-center align-middle" style="font-weight:bold; color:rgb(1, 181, 1)">accepted</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>

@endsection
