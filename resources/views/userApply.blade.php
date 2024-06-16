@extends('layout.layout')

@section('content')

<section style="background-color: rgb(234, 234, 234)">
    <header class="py-3 mb-4">
        <div class="container d-flex flex-wrap justify-content-between mt-4">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <h2>Your job applicants
                </h2>

            </a>
        </div>
    </header>
    <div class="container" style="min-height:100vh">
        <div class="container d-flex flex-wrap justify-content-center" style="min-height: 80vh">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row2" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20%">apply time</th>
                                <th class="text-center" style="width: 10%">name</th>
                                <th class="text-center">description</th>
                                <th class="text-center" style="width: 10%">Job</th>
                                <th class="text-center" style="width: 7%">Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center" style="width: 20%">apply time</th>
                                <th class="text-center" style="width: 10%">name</th>
                                <th class="text-center">description</th>
                                <th class="text-center" style="width: 10%">Job</th>
                                <th class="text-center" style="width: 7%">Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($appliers as $data)
                                <tr>
                                    <td class="text-center align-middle">{{date_format(date_create($data->created_at), 'D H:i:s d-M-Y')}}</td>
                                    <td class="text-start align-middle">{{App\Models\User::seeWorker($data->worker_id)}}</td>
                                    <td class="text-start align-middle">{{$data->apply_description}}</td>
                                    <td class="text-start align-middle">
                                        @if ($data->status == 'applying')
                                            <a class="btn btn-primary" href="/viewJob/{{$data->job_id}}">See Job</a>
                                        @else
                                            <a class="btn btn-secondary" href="">See Job</a>
                                        @endif
                                        {{-- <a type="button" class="btn align-middle mt-3 btn-primary" style="color:white;" href="/viewJob/{{$data->id}}">View Job</a> --}}
                                    </td>
                                    {{-- unlocked no, applied yes ||normal --}}
                                    {{-- unlocked yes, applied no ||ga normal || kalo udah unlocked emang harus udah apply dulu, jadi case ini harusnya ga ada --}}
                                    {{-- @if ($jobInfo->job_status == 'opened') --}}
                                        @if ($data->status == 'applying')
                                            <td class="text-center align-middle" style="font-weight:bold;">applying</td>
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
    </div>
</section>

@endsection

@section('script')
<script>
    $('#addBankInfo').select2({
        dropdownParent: $('#endJobModal'),
        // placeholder: 'Pilih Kota'
    });
</script>
@endsection
