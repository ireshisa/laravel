@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 job-description" style="background: url({{url('images/job.png')}})">

    </div>
    <div class="col-md-10 col-sm-12 offset-1 brief card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-12">

                <div class="rounded logo-details">
                    <img class="img-responsive mx-auto" src="{{(!empty($company->logo)?url('storage/'.$company->logo):url('/images/user.jpg'))}}" style="max-width: 150px"/>
                </div>

                </div>


                <div class="col-md-9 col-sm-12 flex-row-reverse job-details d-flex">
                    <div class="d-flex flex-shrink-1">
                        <div class="d-block">
                            @if(auth()->check() && auth()->user()->user_type_id == 2)
                                @if ($showFollow)
                        <a class="btn btn-primary d-block mt-1" href="{{url('/companies/'.$company->id.'/follow')}}">
                            <i class="fa fa-user-plus mr-2"></i> Follow
                        </a>
                                    @else
                                    <a class="btn btn-primary d-block mt-1" href="{{url('/companies/'.$company->id.'/unfollow')}}">
                                        <i class="fa fa-user-plus mr-2"></i>Unfollow
                                    </a>

                                    @endif
                            @endif
                        <a class="btn btn-primary btn-transparent color-blue d-block  mt-3">
                           {{$company->posts_count}} Vacancies
                        </a>
                        </div>
                    </div>
                    <div class="d-flex flex-grow-1">
                            <div class="row">
                                <div class="col-md-12 new-aligencenter">

                                 <h1 class="color-black font-weight-bold mt-2">{{$company->name}}</h1>

                                  <h4 style="display: block;"> {!! !empty($company->sector) ? $company->sector->name :""!!}</h4>

{{--                                    {!! !empty($company->sector)?"<h3>".$company->sector->name."</h3>":""!!}--}}
{{--                                    {!! !empty($company->city)?"<h4 class='color-blue'><i class='fa fa-map-marker mr-1'></i>".$company->city->name."</h4>":""!!}--}}
                                  <i class="fa fa-map-marker fa-lg mr-2"> {!! !empty($company->address)?"<h2>".$company->address."</h2>":""!!} </i>
                                  <h3 class="d-block color-black font-weight-bold mt-2"><i class="fa fa-phone fa-md mr-2"></i>{{$company->phone}}</h3>


                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 flex-row-reverse job-details d-flex new-aligencenter">
                    <div class="social my-2">
                        @if(!empty($company->website))<h4><a href="{{$company->website}}"><i class="fa fa-globe fa-2x mx-2"></i></a> </h4>@endif
                        @if(!empty($company->facebook))<h4><a href="{{$company->facebook}}"> <i class="fab fa-facebook fa-2x mx-2"></i></a> </h4>@endif
                        @if(!empty($company->twitter))<h4><a href="{{$company->twitter}}"><i class="fab fa-twitter fa-2x mx-2"></i></a></h4>@endif
                        @if(!empty($company->linkedin))<h4><a href="{{$company->linkedin}}"><i class="fab fa-linkedin fa-2x mx-2"></i></a> </h4>@endif
                        {{--            @if(!empty($company->pinterest))<h4><a href="{{$company->pinterest}}"><i class="fab fa-pinterest mx-1"></i></a></h4>@endif--}}
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<div class="container">
    @if (Session::has('flash_notification'))

        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')
            </div>
        </div>

    @endif
<div class="row my-5">
    <div class="col-md-12 px-3 d-flex justify-content-around">
        <div class="job-box card">
            <div class="card-body">
{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
                <div class="text-center img-responsive mb-3">
                    <i class="fa fa-suitcase fa-6x img-responsive"></i>
                </div>
                <h5 class="text-truncate color-black" style="max-width: 180px">

                    {{!empty($company->sector)?$company->sector->name:"Not Specified"}}

                </h5>
                <h3 class="color-black text-center">Sector</h3>
            </div>
        </div>


        <div class="job-box card">
            <div class="card-body">
{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
                <div class="text-center img-responsive mb-3">
                    <i class="fa fa-calendar-check fa-6x img-responsive"></i>
                </div>
                <h5 class="text-truncate color-black" style="max-width: 180px">

                    {{!empty($company->yearfound) ? $company->yearfound : "Not Specified"}}

                </h5>
                <h3 class="color-black text-center">Founded Since</h3>
            </div>
        </div>

        <div class="job-box card">
            <div class="card-body">
{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
                <div class="text-center img-responsive mb-3">
                <i class="fa fa-address-card fa-6x img-responsive"></i>
                </div>
                <h5 class="color-black text-center" >

                    {{$company->posts_count}}

                </h5>
                <h3 class="color-black text-center">Posted Jobs</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <h2 class="font-weight-bold mt-5 pb-1">Company Description</h2>
       <p> {!! $company->description !!}</p>
    </div>
    
    <div class="col-md-12 mb-3">
        <h2 class="font-weight-bold mt-5 pb-1">Posted Jobs ({{$company->posts_count}})</h2>
        @foreach($company->posts as $post)
            <div class="row border person-info mt-4" style="margin-bottom: 45px">
                <div class="col-md-12 py-3 d-flex ">

                    <div class="d-flex logo-container p-4  flex-shrink-1 align-items-center justify-content-center">

                        <a href="">
                            <img src="{{ $post->logo ? asset('storage/' . $post->logo) : url('images/user.jpg')  }}"
                                 alt="">
                        </a>

                    </div>
                    <div class="d-flex align-items-center flex-grow-1 job-details ">
                        <div class="w-100 px-3 d-block new-aligencenter">

                            <div class="col-md-12">
                                <h2 class="font-weight-bold"><a href="{{url('/post/'.$post->id)}}">{{$post->title}}</a></h2>
                            </div>
                            <div class="col-md-12">

                                <div class="w-100 d-flex flex-row-reverse">

                                    <div class="d-inline-flex flex-shrink-0 px-2 align-items-center">
                                        <h5 class="city"><i class="fa fa-map-marker"></i> {{$post->city->name}}</h5>

                                    </div>
                                    <div class="d-inline-flex flex-grow-1">
                                        <div class="w-100 d-block">
                                            <h5 class="company">{{$post->company->name}}</h5>
                                            <h5>{{$post->category->name}}</h5>
                                            <h6><i class="fa fa-clock"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="float-left p-2 px-3 color-white bg-blue text-capitalize buttonecenter" style="border-radius: 5px;">
                                            <i class="fa fa-briefcase color-white mr-1"></i> {{$post->postType->name}}
                                        </div>
                                     <?php /*  <!--@if(auth()->check() && auth()->user()->user_type_id == 2)-->
                                        <!--    @if(!in_array($post->id,$saved))-->
                                        <!--        <a id="like" class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Save Job</a>-->
                                        <!--    @else-->
                                        <!--        <a id="unlike" class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Remove Job from Wishlist</a>-->

                                        <!--    @endif-->
                                        <!--@endif--> */?>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                @endforeach
    </div>
</div>
</div>
    @endsection