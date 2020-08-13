@extends('layouts.app')

@section('title', 'View')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                        </div>
                    @endif
                    <div class="d-flex align-items-start flex-column">
                         <h2>{{ $project->title }}</h2>
                        <p class="text-gray">
                            Author : {{ $project->author }} <br> {{ $project->created }} <br>

                        </p>
                        <p class="text-gray">Status : {{ Str::ucfirst($project->status) }}</p>
                         <p><?=$project->content?></p>
                         <p>
                            <?php
                                $keywords = [];
                                $keywords = explode(',', $project->keywords);
                            ?>
                                <b>Keywords : </b>
                                @foreach ($keywords as $word)
                                <span style="font-size: 10px; padding: 5px; color: #FFF" class="badge badge-info">
                                    {{ $word }}
                                </span>
                                @endforeach
                         </p>
                         <p>Author email : {{ $project->author_email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
