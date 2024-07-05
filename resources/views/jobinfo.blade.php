@extends('layout.layout')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <h2>Job Info
                    @if ($jobInfo->job_status == 'opened')
                        <span style="color: rgb(0, 198, 0)">(opened)</span>
                    @elseif($jobInfo->job_status == 'ongoing')
                        <span style="color: rgb(198, 148, 0)">(ongoing)</span>
                    @elseif($jobInfo->job_status == 'finished')
                        <span style="color: rgb(0, 89, 198)">(finished)</span>
                    @elseif($jobInfo->job_status == 'cancelled')
                        <span style="color: rgb(198, 23, 0)">(cancelled)</span>
                    @endif
                </h2>

            </a>
            @if (auth()->user()->role == 2)
                @if ($jobInfo->job_status == 'opened' || $jobInfo->job_status == 'ongoing')
                    <div>
                        @if ($jobInfo->job_status == 'opened')
                            <button type="button"  class="btn btn-primary" data-bs-target="#editJobModal"data-bs-toggle="modal">Edit Job</button>
                        @endif
                        {{-- <div class="dropdown"> --}}
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Job Status
                        </button>
                        <ul class="dropdown-menu">
                            @if ($jobInfo->job_status == 'ongoing')
                                <li><a class="dropdown-item" data-bs-target="#endJobModal"data-bs-toggle="modal">End Job</a></li>
                            @endif
                            <li><a class="dropdown-item" data-bs-target="#cancelJobModal" data-bs-toggle="modal">Cancel Job</a></li>
                        </ul>
                        {{-- </div> --}}
                    </div>
                @endif
            @endif
        </div>
    </header>

    {{-- end job modal --}}
    <div class="modal fade" id="endJobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selesaikan Pekerjaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/endJob">
                @csrf
                    <div class="modal-body">
                        Anda akan menyelesaikan suatu pekerjaan, apakah anda yakin?<br><br>
                        Sebelum pekerjaan ditandai sebagai selesai, mohon konfirmasi hasil pekerjaan dengan pekerja anda.

                        {{-- <div class="form-group mt-4">
                            <label for="bank_id">Bank</label>
                            <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                                placeholder="your choice of bank" value="" id="bank_id"
                                name="bank_id">
                        </div> --}}

                        <div class="form-group mt-3">
                            <label for="addBankInfo">Nama Bank</label>
                            <select class="form-control" id="addBankInfo"
                                data-width="100%" name="bank_id">
                                <option>your choice of bank</option>
                                @foreach ($banks as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->bank_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="bank_account_number">Bank Account Number</label>
                            <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                                placeholder="your bank account number" value="" id="bank_account_number"
                                name="bank_account_number">
                        </div>
                        <div class="form-group mt-3">
                            <label for="largeInput">Compensation</label>
                            <input class="form-control" type="text" placeholder="{{$jobInfo->job_compensation}}"
                                aria-label="Disabled input example" disabled>
                            <input type="hidden" name="jobCompensation" value="{{$jobInfo->job_compensation}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="rating">Rating</label>
                            <input type="number" class="form-control form-control" style="border-color: #aaaaaa" id="rating" name="rating" min="0" max="5" step="1">
                        </div>
                        <div class="form-group mt-3">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" rows="3" name="comment" id="comment" style="border-color: #aaaaaa"></textarea>
                        </div>
                        <input type="hidden" name="jobIdHidden" value="{{ $jobInfo->id }}">
                        <div class="d-flex flex-row-reverse mt-4">
                            <button type="submit" class="btn btn-success">End Job</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-right:10px" style="border-color: #aaaaaa">Tidak</button>
                        </div>
                    </div>
                </form>

                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <a href="/cancelJob/{{$jobInfo->id}}"  class="btn btn-primary">Pekerjaan Selesai</a>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- cancel job modal --}}
    <div class="modal fade" id="cancelJobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Job</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda akan membatalkan suatu pekerjaan, apakah anda yakin?
            </div>
            <div class="modal-footer">
                {{-- <a href="/declineApplicant/" class="btn btn-danger"  data-bs-dismiss="modal">Tidak</a> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a href="/cancelJob/{{$jobInfo->id}}"  class="btn btn-warning">Ya</a>
                {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary">Ya</button> --}}
            </div>
            </div>
        </div>
    </div>


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
                        @if (auth()->user()->role == 2)
                            <div class="form-group mb-2">
                                <label for="largeInput">Employer</label>
                                    <input class="form-control" type="text" placeholder="{{App\Models\User::seeEmployer($jobInfo->employer_id)}}"
                                aria-label="Disabled input example" disabled>
                            </div>
                        @elseif (auth()->user()->role == 1)
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
                        @endif
                        @if (auth()->user()->role == 1)
                            <div class="form-group mb-2">
                                <label for="largeInput">Worker</label>
                                    <input class="form-control" type="text" placeholder="{{App\Models\User::seeWorker($jobInfo->worker_id)}} (you)"
                                aria-label="Disabled input example" disabled>
                            </div>
                        @endif

                        @if ($jobInfo->job_status == 'finished')
                            <div class="form-group mb-2">
                                <label for="largeInput">Rating From Employer</label>
                                <input class="form-control" type="text" placeholder="{{App\Models\Rating::seeRating($jobInfo->id)}}/5"
                                    aria-label="Disabled input example" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="largeInput">Comment From Employer</label>
                                <input class="form-control" type="text" placeholder="{{App\Models\Rating::seeComment($jobInfo->id)}}"
                                    aria-label="Disabled input example" disabled>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role == 2)
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
                                {{-- @if ($jobInfo->job_status == 'opened') --}}
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
                                {{-- @else
                                    <td class="text-center align-middle" style="font-weight:bold; color:rgb(181, 16, 1)">cancelled</td>
                                @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- edit job modal --}}
    <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Current Job</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" method="post" action="/makeJob">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supplier">Job Title</label>
                        <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                            placeholder="Title" value="" id="employer_address"
                            name="employer_address">
                    </div>
                    <div class="form-group mt-3">
                        <label for="job_description">Description</label>
                        <textarea class="form-control" rows="3" name="job_description" id="job_description" placeholder="your job's description" style="border-color: #aaaaaa"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="compensation">Job Compensation</label>
                        <input type="number" class="form-control form-control" style="border-color: #aaaaaa" id="compensation" name="compensation" min="0">
                    </div>
                    <div class="form-group mt-3">
                        <label for="job_type2">Check the box if job is online</label>
                        <input type="checkbox" id="job_type2" name="job_type2">
                    </div>
                    <div class="form-group mt-3" id="address_field2">
                        <label for="customerLabelExportBrand">City</label>
                        <select class="form-control" id="customerLabelExportBrand"
                            data-width="100%" name="city">
                            <option></option>
                            @foreach ($city as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->city_name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="address" class="mt-3">Address</label>
                        <input type="text" class="form-control form-control" style="border-color: #aaaaaa"
                            placeholder="Address" value="" id="address"
                            name="address">
                    </div>
                    <div class="form-group mt-3">
                        <label for="deadline">Deadline</label>
                        <input type="date" class="form-control form-control-sm" style="border-color: #aaaaaa" id="deadline" name="deadline">
                    </div>
                    <div class="d-flex flex-row-reverse mt-4">
                        <button type="submit" class="btn btn-primary">Make Job</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#job_type2').change(function(){
            if($(this).prop('checked')){
                $('#address_field2').hide();
            } else {
                $('#address_field2').show();
            }
        });
    });
</script>
<script>
    $('#addBankInfo').select2({
        dropdownParent: $('#endJobModal'),
        // placeholder: 'Pilih Kota'
    });
</script>
<script>
    $('#customerLabelExportBrand').select2({
        dropdownParent: $('#editJobModal'),
        placeholder: 'Pilih Kota'
    });

</script>
@endsection

