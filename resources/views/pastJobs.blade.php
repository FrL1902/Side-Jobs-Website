@extends('layout.layout')

@section('content')


<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
        <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <h2>Past Jobs Page</h2>
        </a>
        </div>
    </header>
    <div class="container d-flex justify-content-center" style="min-height:50vh; width:100%">
        <div style="width:70%; padding-bottom: 20px;">
            <div class="d-flex flex-column" style="height: 100%; padding:10px">
                <div class="p-2 mb-5 text-center" style="height: 8%;">
                    <h3>your past jobs</h3>
                </div>
                @if (count($pastJobs)>0)
                    @foreach ($pastJobs as $data)
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
                                        @if ($data->job_status == 'finished')
                                            <strong style="color: rgb(0, 89, 198)">Finished</strong>
                                        @else
                                            <strong style="color: rgb(198, 23, 0)">Cancelled</strong>
                                        @endif
                                    </p>
                                </div>
                                <div class="d-flex align-items-center" style="height: 100%; width:30%;">
                                    <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white;" href="/viewJob/{{$data->id}}">View Job</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-2 mb-1 text-center" style="height: 8%;">
                        <p>no data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-4">
        {{$pastJobs->links()}}
    </div>
</section>

@endsection
