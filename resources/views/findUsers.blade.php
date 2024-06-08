@extends('layout.layout')

@section('content')

<p>ini bage buat cari user</p>

@foreach ($users as $data)
<p>{{$data->email}}</p>


@endforeach
{{$users->links()}}
@endsection
