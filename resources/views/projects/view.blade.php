@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-green " style="border-top-width: 6px !important; border-top-color: #f5de0d !important;">
                <div class="card-body">
                    <div class="d-flex align-items-start flex-column">
                    <h2>{{ $project->title }}</h2>
                        <p class="text-gray">
                            Author : {{ $project->author }} <br> {{ $project->created }} <br>
                        </p>
                        <p class="text-gray">Status : {{ Str::ucfirst($project->status) }}</p>
                         <p><?=$project->content?></p>
                         <p>
                            <b>Keywords : </b>
                            @foreach (explode(',', $project->keywords) as $word)
                            <a href="/search?q=<?=urlencode($word)?>" style="font-style: unset">
                                <span style="font-size: 10px; padding: 5px; color: #FFF" class="badge badge-info">
                                    {{ $word }}
                                </span>
                            </a>
                            @endforeach
                         </p>
                         <p>Author email : <a href="mailto:{{ $project->author_email }}">{{ $project->author_email }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
