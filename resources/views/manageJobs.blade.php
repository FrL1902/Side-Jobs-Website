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
                <a type="button" class="btn align-middle mt-3 btn-primary" href="/#" style="height:100%">Manage your jobs</a>
            @endif
            </div>
        </header>
    @endauth
    <div class="container">
        @auth
            @if (Auth::user()->role == 3)
            @else

            @endif
        @endauth
        {{-- <div class="d-flex justify-content-between"> --}}
        <div style="height:70vh">

        </div>

    </div>
</section>
@endsection
