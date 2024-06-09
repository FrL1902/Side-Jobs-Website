@extends('layout.layout')
@section('manageJobsButton', 'active')

@section('content')
<section style="background-color: rgb(234, 234, 234)">
    @auth
        <header class="py-3 mb-4">
            <div class="container d-flex flex-wrap justify-content-between mt-4">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <h2>Manage Jobs Page</h2>
            </a>
            @if (Auth::user()->role == 2)
                {{-- <a type="button" class="btn align-middle mt-3 btn-primary" href="/#" style="height:100%">Manage your jobs</a> --}}
                <button type="button" style="height:100%" class="btn btn-primary" data-bs-target="#makeJobModal"data-bs-toggle="modal">Make New Job</button>
            @endif
            </div>
        </header>
    @endauth

    @if (auth()->user()->role == 2)
        <div class="container d-flex flex-row" style="height:70vh; width:100%">
            <div style="width:50%; padding-bottom: 20px;">
                <div class="d-flex flex-column" style="height: 100%; border-right: 1px solid rgb(130, 130, 130); padding:10px">
                    <div class="p-2 mb-1 text-center" style="height: 8%;">
                        <h5>Active jobs</h5>
                    </div>
                    @foreach ($activeJobs as $data)
                        <div class="d-flex flex-row mb-3" style="height: 50%;border-radius: 10px;
                        border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                            <div class="text-start" style="height: 100%; width:60%">
                                <h6>{{$data->job_title}}</h6>
                                <p>{{$data->job_description}}</p>
                            </div>
                            <div class="text-start" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                            border: 2px solid #000000;">
                                <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                <p style="font-size:15px"><strong>Status:</strong>
                                    @if ($data->job_status == 'opened')
                                        <strong style="color: rgb(0, 198, 0)">Opened</strong>
                                    @else
                                        <strong style="color: rgb(198, 148, 0)">Ongoing</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div style="width:50%; padding-bottom: 20px;">
                <div class="d-flex flex-column" style="height: 100%; border-left: 1px solid rgb(130, 130, 130); padding:10px">
                    <div class="p-2 mb-1 text-center" style="height: 8%;">
                        <h5>Past jobs</h5>
                    </div>
                    @foreach ($pastJobs as $data)
                        <div class="d-flex flex-row mb-3" style="height: 50%;border-radius: 10px;
                        border: 4px solid #272727; background-color:#f8f8f8; padding:10px">
                            <div class="text-start" style="height: 100%; width:60%">
                                <h6>{{$data->job_title}}</h6>
                                <p>{{$data->job_description}}</p>
                            </div>
                            <div class="text-start" style="height: 100%; width:40%; background-color:rgb(255, 255, 255); padding:5px; border-radius: 10px;
                            border: 2px solid #000000;">
                                <p style="font-size:15px"><strong>budget:</strong> {{$data->job_compensation}}</p>
                                <p style="font-size:15px"><strong>Deadline:</strong> {{date_format(date_create($data->job_deadline), 'd-M-Y')}}</p>
                                <p style="font-size:15px"><strong>City:</strong> {{$data->city}}</p>
                                <p style="font-size:15px"><strong>Status:</strong>
                                    @if ($data->job_status == 'finished')
                                        <strong style="color: rgb(0, 89, 198)">Finished</strong>
                                    @else
                                        <strong style="color: rgb(198, 23, 0)">Cancelled</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    <div class="modal fade" id="makeJobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employer Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" method="post" action="/makeJob">
                @csrf
                <div class="modal-body">
                    <div class="form-group mt-3">
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
                        <label for="job_type">Check the box if job is online</label>
                        <input type="checkbox" id="job_type" name="job_type">
                    </div>
                    <div class="form-group mt-3" id="address_field">
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
        $('#job_type').change(function(){
            if($(this).prop('checked')){
                $('#address_field').hide();
            } else {
                $('#address_field').show();
            }
        });
    });
</script>

<script>
    $('#customerLabelExportBrand').select2({
        dropdownParent: $('#makeJobModal'),
        placeholder: 'Pilih Kota'
    });
</script>

@endsection
