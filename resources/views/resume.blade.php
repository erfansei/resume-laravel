@extends('layouts.resume')

@section('content')
<section class="grid lg:grid-cols-2 lg:space-x-10 border-b pb-3">
    <div class="flex gap-x-6">
        <img class="w-32 rounded-full border" src="{{'/storage' . $user->avatar}}" alt="{{$user->name}}" />
        <div class="self-center">
            <h1 class="font-semibold text-3xl">{{$user->name}}</h1>
            <span>IT Engineer</span>
        </div>
    </div>
    <div class="flex flex-col self-center lg:text-right p-0 m-0 lg:mt-0 mt-5">
        <span>{{$user->phone}}</span>
        <span>{{$user->email}}</span>
        <span>{{$user->address}}</span>
    </div>
</section>
<section class="grid lg:grid-cols-1 lg:space-x-10 text-justify mt-3">
    <div>
        <div>
            <h2 class="text-2xl font-semibold">About me:</h2>
        </div>
        <div class="bg-slate-200 rounded">
            <p class="text-light p-5  leading-6 text-sm mt-3">{{$user->bio}}</p>
        </div>        
    </div>
</section>
<section class="grid lg:space-x-10 text-justify mt-3">
        <div class="">
            <h2 class="text-2xl font-semibold">Experiences:</h2>
            @foreach($user->experiences as $experience)
                <h3 class="leading-6 mt-3">{{$experience->title}}</h3>
                <p class="leading-6 text-sm mt-3">{{$experience->description}}</p>
                <hr>
            @endforeach
        </div>
</section>
@endsection