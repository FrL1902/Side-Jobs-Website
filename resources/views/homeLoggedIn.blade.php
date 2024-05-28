@extends('layout.layout')
@section('homeButton', 'active')

@section('content')

<section style="background-color: rgb(226, 226, 226)">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h3 class="mt-3">Here are some newly posted jobs!</h3>
                <h3 class="mt-3">{{auth()->user()->name}}</h3>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn" style="color:white; background-color: rgb(256,212,76)">Search more jobs</button>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="d-flex row flex-wrap mt-2 justify-content-start mb-4">
                {{-- @foreach ($data as $d) --}}
                <div class="col-3">
                    <a href="xxx" style="text-decoration: none;">
                        <div class="card my-1" style="width: 18rem; height: 30rem">
                            <img src="https://cdn.discordapp.com/attachments/1211571942965125160/1244616830744530944/image.png?ex=66566c00&is=66551a80&hm=b5df70e02b873174ec84debad2d0d360c34217178046057ce80232cd0c2721d3&"
                                style="width: 100%; height: 200px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="my-2">name</h6>
                                <p class="card-text text-black">deadline</p>
                                <h6 class="text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet sequi sit voluptate</h6>
                            </div>
                            <div class="card-footer bg-transparent flex-row d-flex justify-content-between">
                                <div class="text-secondary">Pay: Rp 25000000</div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
</section>

@endsection

