@extends('layout.layout')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <h2>Job Detail</h2>
            </a>
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
                            <div class="d-flex flex-row">
                                <div style="width:88%">
                                    <input class="form-control" type="text" placeholder="{{App\Models\User::seeEmployer($jobInfo->employer_id)}}"
                                aria-label="Disabled input example" disabled>
                                </div>
                                <div style="width:15% align-end">
                                    <a class="btn btn-primary" href="/profile/view/{{$jobInfo->employer_id}}">See Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="largeInput">Number of Appliers</label>
                            <input class="form-control" type="text" placeholder="asdf"
                                        aria-label="Disabled input example" disabled>
                        </div>
                        @if (Auth::check())
                            @if ($jobInfo->employer_id == auth()->user()->id)
                                <div class="form-group mt-4" style="width:100%">
                                    <a href="" class="btn btn-danger" style="width:100%">Cannot Apply To Your Own Job</a>
                                </div>
                            @elseif (App\Models\Job::applyCheck($jobInfo->id ,auth()->user()->id) == 1)
                                <div class="form-group mt-4" style="width:100%">
                                    <a href="" class="btn btn-danger" style="width:100%">Already Applied</a>
                                </div>
                            @else
                                <div class="form-group mt-4" style="width:100%">
                                    <a data-bs-target="#applyModal"data-bs-toggle="modal" class="btn btn-success" style="width:100%">Apply To Job</a>
                                </div>
                            @endif
                        @else
                            <div class="form-group mt-4" style="width:100%">
                                <a href="/loginPage" class="btn btn-success" style="width:100%">Apply To Job</a>
                            </div>
                        @endif
                        {{-- <div class="card mt-4">
                            <a href="#" class="btn btn-success">Apply to job</a>
                        </div> --}}
                        {{-- <button class="btn btn-success">Apply to job</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apply Job</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="/applyJob">
                    @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="job_message">Message to employer</label>
                                <textarea class="form-control" rows="3" name="job_message" id="job_message" placeholder="write a short description about yourself and why you want this job" style="border-color: #aaaaaa"></textarea>
                            </div>
                            <p style="font-size:small; color:red; font-weight:bold">Before you apply, be sure to see the employer's profile and contact them</p>
                            <div class="d-flex flex-row-reverse mt-4">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>
                        </div>
                        <input type="hidden" name="jobIdHidden" value="{{ $jobInfo->id }}">
                        @auth
                            <input type="hidden" name="applierIdHidden" value="{{auth()->user()->id}}">
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
