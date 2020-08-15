@extends('layouts.app')
@section('title', 'Master\'s Degree')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Search</h1>
      <p class="lead">

      </p>
    </div>
  </div>
<div class="container">
    <div class="row">
        {{-- <div class="col-md-12"> --}}
                @foreach ($projects as $project)
                <div class="col-md-12">
                    <div class="card" style="margin-bottom: 24px">
                        <div class="card-header">
                            {{$project->title}}
                            <span style="padding: 5px; font-size: 14px; border-radius: 3px;" class="bagde badge-<?=($project->status == 'open' ? 'success' : 'danger')?>  float-right">
                                {{ Str::ucfirst($project->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <?=(Str::length($project->content) > 200 ? Str::substr($project->content, 0, 280).'...'  : $project->content )?>
                            <div style="margin-top: 24px">
                                <?php
                                    $keywords = [];
                                    $keywords = explode(',', $project->keywords);
                                ?>
                                <b>Keywords : </b>
                                @foreach ($keywords as $word)
                                <a href="/search?q=<?=urlencode($word)?>" style="font-style: unset">
                                    <?php
                                        if(strcmp(urldecode($_GET['q']) , $word) == 0) { ?>
                                            <span style="font-size: 10px; padding: 5px; color: #FFF" class="badge badge-success">
                                                {{ $word }}
                                            </span>
                                        <?php }else {?>
                                        <span style="font-size: 10px; padding: 5px; color: #FFF" class="badge badge-info">
                                            {{ $word }}
                                        </span>
                                    <?php } ?>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="">
                                <span>
                                    {{$project->created}} <br>
                                    Author : {{$project->author}}
                                </span>
                                <a href="/project/{{$project->id}}" class="btn btn-info btn-sm float-right">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
@endsection
