@extends('layout.layout')

@section('content')


<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
        <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <h2>Find Jobs Page</h2>
        </a>
        <button type="button" style="height:100%" class="btn btn-warning" data-bs-target="#filterJobsModal"data-bs-toggle="modal">FILTER</button>
        </div>
    </header>
    <div class="container d-flex justify-content-center" style="min-height:70vh; width:100%">
        <div style="width:70%; padding-bottom: 20px;">
            <div class="d-flex flex-column" style="height: 100%; padding:10px">
                <div class="p-2 mb-5 text-center" style="height: 8%;">
                    <h3>find yourself a side gig!</h3>
                </div>
                @foreach ($activeJobs as $data)
                    <div class="d-flex flex-row mb-3" style="height: 50%;border-radius: 10px;
                    border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                        <div class="text-start" style="height: 100%; width:60%">
                            <h6>{{$data->job_title}}</h6>
                            <p>{{$data->job_description}}</p>
                        </div>
                        <div class="text-start d-flex flex-row" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                        border: 2px solid #000000;">
                            <div style="height: 100%; width:70%;">
                                <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                <p style="font-size:15px"><strong>Job Type:</strong>
                                    @if ($data->is_online == 'yes')
                                        online
                                    @else
                                        on-site
                                    @endif
                                </p>
                                <p style="font-size:15px"><strong>Status:</strong>
                                    @if ($data->job_status == 'opened')
                                        <strong style="color: rgb(0, 198, 0)">Opened</strong>
                                    @else
                                        <strong style="color: rgb(198, 148, 0)">Ongoing</strong>
                                    @endif
                                </p>
                            </div>
                            <div class="d-flex align-items-center" style="height: 100%; width:30%;">
                                <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white;" href="/viewJob/{{$data->id}}">View Job</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-4">
        {{$activeJobs->links()}}
    </div>
</section>

<div class="modal fade" id="filterJobsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Job</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/makeJob">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Check the box if job is online</label>
                    <input type="checkbox" id="" name="">
                </div>
                <div class="form-group mt-3">
                    <label for="supplier">Job name</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="what kind of job?" value="" id="name"
                        name="employer_address">
                </div>
                <div class="form-group mt-3">
                    <label for="supplier">Job Area</label>
                    <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                        placeholder="Choose a city" value="" id="employer_address"
                        name="employer_address">
                </div>
                <div class="form-group mt-3">
                    <label for="compensation">Compensation Minimum</label>
                    <input type="number" class="form-control form-control" style="border-color: #aaaaaa" id="compensation" name="compensation" min="0">
                </div>
                <div class="form-group mt-3">
                    <label for="compensation">Compensation Maximum</label>
                    <input type="number" class="form-control form-control" style="border-color: #aaaaaa" id="compensation" name="compensation" min="0">
                </div>
                <div class="form-group mt-3">
                    <label for="deadline">Deadline Before</label>
                    <input type="date" class="form-control form-control-sm" style="border-color: #aaaaaa" id="deadline" name="deadline">
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
