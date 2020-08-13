@extends('layouts.app')
@section('title', 'Home')

@section('content')

<div class="projects-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-capitalize text-center text-dark">What's your study degree ?</h2>
            <p class="lead text-center"><br>This site helps students to find an ESP by a simple search engine.<br><br></p>
        </div>
        <div class="row d-flex flex-row justify-content-around projects">

            <div class='card degree' style="max-width: 324px; margin-bottom: 32px">
                <a href="{{ route('/bachelor') }}" class="text-dark">
                <img class="card-img-top" src="{{asset('img/waiting-1047677_1920.jpg')}}">
                    <div class="card-body">
                        <div class="item">
                            <h3 class="name">Bachelor's degree</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class='card degree' style="max-width: 324px; margin-bottom: 32px">
            <a href="{{ route('/master') }}" class="text-dark">
                    <img class="card-img-top" src="{{ asset('img/desk.jpg')}}">
                    <div class="card-body">
                        <div class="item">
                            <h3 class="name">Masters degree</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
