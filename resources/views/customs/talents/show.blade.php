<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
$experiences = [
    '6m' => '6 Months',
    '1y' => '1 Year',
    '2y' => '2 Years',
    '3y' => '3 Years',
    '4y' => '4 Years',
    '5y' => '5 Years',
];
?>
@extends('layouts.master')

@section('content')
    <!--<<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />-->
    <!--<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/plugin.css?ver=1.5.9' type='text/css' media='all' />-->

    <style>
        .col-md-3.jobsearch-typo-wrap, .col-md-3.jobsearch-typo-wrap {
            padding-left: 15px;
            padding-right: 15px;
        }

        .reset-button {
            padding: 5px !important;
            margin: 10px auto;
            color: #fff !important;
            font-size: 17px;
            text-transform: uppercase;
        }

        .reset-button:before, .jobsearch-fltbox-title a:before {
            content: "" !important;
        }

        .fa.fa-angle-down {
            float: right;
            color: #ccc;
        }

        .jobsearch-filter-responsive-wrap .btn-primary {
            margin-bottom: 10px;
        }

        .search-row-wrapper {
            background: #fff;
        }
    </style>
    <style>


        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        *:before, *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .clearfix {
            clear: both;
        }

        .text-center {
            text-align: center;
        }

        a {
            color: tomato;
            text-decoration: none;
        }

        a:hover {
            color: #2196f3;
        }

        pre {
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #F5F5F5;
            border: 1px solid #CCC;
            border-radius: 4px;
        }


        #a-footer {
            margin: 20px 0;
        }

        .new-react-version {
            padding: 20px 20px;
            border: 1px solid #eee;
            border-radius: 20px;
            box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);

            text-align: center;
            font-size: 14px;
            line-height: 1.7;
        }

        .new-react-version .react-svg-logo {
            text-align: center;
            max-width: 60px;
            margin: 20px auto;
            margin-top: 0;
        }


        .success-box {
            margin: 50px 0;
            padding: 10px 10px;
            border: 1px solid #eee;
            background: #f9f9f9;
        }

        .success-box img {
            margin-right: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .success-box > div {
            vertical-align: top;
            display: inline-block;
            color: #888;
        }


        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul > li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size: 1.5em; /* Change the size of the stars */
            color: #ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color: #FF912C;
        }

    </style>

    @php

        $connection_count = null;
        if (auth()->check() && auth()->user()->user_type_id == 1)
        {
            $connection_count=count($user->messagesConnectedApproved($user->id))?? null;

        }


    @endphp


    <div class="main-container">



        <div class="row">
            <div class="col-md-12 job-description" style="background: url({{url('images/bg.png')}})">

            </div>
            <div class="col-md-10 col-sm-12  offset-md-1 offset-0 brief card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="card rounded brief-details">
                                <div class="card-body text-center color-black">
                                    <div class="rounded-circle">
                                        @if (auth()->check() && in_array(auth()->user()->user_type_id, [1]))

                                            @if(!$show_details)
                                                <img class="img-responsive rounded-circle mx-auto" src="{{ url('/images/user.jpg') }}" style="max-width: 150px"/>
                                            @else
                                               
                                                <img class="img-responsive rounded-circle mx-auto" src="{{(!empty($user->avatar_url)?url('storage/'.$user->avatar_url):url('/images/user.jpg'))}}" style="max-width: 150px"/>
                                            @endif
                                        @endif
                                        @if (auth()->check() && in_array(auth()->user()->user_type_id, [2]))
                                            @if((auth()->check() && auth()->user()->id != $user->id))
                                                <img class="img-responsive rounded-circle mx-auto" src="{{ url('/images/user.jpg') }}" style="max-width: 150px"/>
                                            @else
                                                <img class="img-responsive rounded-circle mx-auto" src="{{(!empty($user->avatar_url)?url('storage/'.$user->avatar_url):url('/images/user.jpg'))}}" style="max-width: 150px"/>
                                            @endif
                                        @endif
                                    </div>

                                    @if (auth()->check() && in_array(auth()->user()->user_type_id, [1]))
                                        @if(!$show_details)
                                            <h2 class="color-black font-weight-bold mt-3">{{$user->firstname}}</h2>
                                        @else
                                            <h2 class="color-black font-weight-bold mt-3">{{$user->name}}</h2>
                                        @endif
                                    @else
                                        <h2 class="color-black font-weight-bold mt-3">{{$user->firstname}}</h2>

                                    @endif
                                    {!!  (!empty($user->sector))?"<h4>".$user->sector->name."</h4>":"" !!}
                                    <!--@if((!empty($user->social_links) && !empty($refereeData)) || (auth()->check() && auth()->user()->id == $user->id))-->
                                    <!--    <h5><i class="fa fa-phone mr-1 fa-flip-horizontal"></i> {{$user->phone}}</h5>-->
                                    <!--    <h5><i class="fa mr-1 fa-envelope"></i> {{$user->email}}</h5>-->
                                    <!--@endif-->
                                    @if (auth()->check() && in_array(auth()->user()->user_type_id, [1]) || auth()->check() && auth()->user()->hasRole('super-admin'))
                                        @if(!$show_details)
                                            @if((!empty($user->social_links) && !empty($refereeData)) || (auth()->check() && (auth()->user()->id == $user->id || auth()->user()->hasRole('super-admin'))))
                                                <h5><i class="fa fa-phone mr-1 fa-flip-horizontal"></i> {{$user->phone}}</h5>
                                                <h5><i class="fa mr-1 fa-envelope"></i> {{$user->email}}</h5>
                                            @endif
                                        @else
                                            <h5><i class="fa fa-phone mr-1 fa-flip-horizontal"></i> {{$user->phone}}</h5>
                                            <h5><i class="fa mr-1 fa-envelope"></i> {{$user->email}}</h5>
                                        @endif
                                    @endif
                                    <h5>Age :{{$user->age}}</h5>
                                    <h5>Salary : {{$user->salary}}</h5>
                                    <h5><i class="fa mr-1 fa-map-marker"></i> {{!empty($user->city_id)?$user->city->name:"Not Specified"}}</h5>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8 col-sm-12 job-details d-flex flex-column">
                            <div class="d-flex">
                                <div class="row w-100">

                                    <div class="col-md-9 col-sm-12">
                                        @if (auth()->check() && in_array(auth()->user()->user_type_id, [1]))
                                            @if(!$show_details)
                                                <h2 class="color-black font-weight-bold mt-2">About {{$user->firstname}}</h2>
                                            @else
                                                <h2 class="color-black font-weight-bold mt-2">About {{$user->name}}</h2>
                                            @endif
                                        @endif
                                        @if (auth()->check() && in_array(auth()->user()->user_type_id, [2]))
                                            @if((auth()->check() && auth()->user()->id != $user->id))
                                                <h2 class="color-black font-weight-bold mt-2">About {{$user->firstname}}</h2>
                                            @else
                                                <h2 class="color-black font-weight-bold mt-2">About {{$user->name}}</h2>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-12 d-inline-flex flex-row-mobile mt-1 mt-md-0 style="justify-content: flex-end;">
                                        @if (isset(auth()->user()->user_type_id))

                                            @if (auth()->user()->user_type_id==2 && auth()->user()->id != $user->id)
                                                <form method="post" action="{{url('/seeker/'.$user->id.'/endorse')}}">
                                                    <button type="submit" class="btn  float-md-right mb-3 mb-md-3 mt-2 btn-primary btn-block" >
                                                        <i class="fa fa-plus"></i> Endorse
                                                    </button>
                                                </form>
                                            @else
                                                {{--                                                            <div class="d-block px-3 py-2 border mb-3 mr-2" style="background: #092d5f; color: #fff;">({{$endorsementCount}}) Endorsed</div>--}}
                                            @endif


                                            @if (auth()->check() && in_array(auth()->user()->user_type_id, [1]))
                                                @if(!empty($jobs) && count($jobs)>0)

                                                    <a class="btn  float-md-right mb-3 mb-md-3 float-none btn-primary d-block btn-transparent color-blue" id="btnShowMsg" data-target="#myModalConnect" data-toggle="modal">
                                                        Connect
                                                    </a>
                                                @endif

                                            @endif

                                        @endif
                                        @if (!auth()->check())
                                                                                    <a   class="btn  float-md-right mb-3 mb-md-3 mr-3 color-white float-none btn-primary d-block  color-blue" type="Endorse"   data-target="#quickLogin" data-toggle="modal" class="btn  float-md-right mb-3 mb-md-3 mt-2 btn-primary btn-block" >
                                                        <i class="fa fa-plus"></i> Endorse
                                            </a>
                                            <a  class="btn  float-md-right mb-3 mb-md-3 float-none btn-primary d-block btn-transparent color-blue" id="btnShowMsg" data-target="#quickLogin" data-toggle="modal">
                                                Connect
                                            </a>

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  flex-grow-1 flex-column  align-items-end">

                                <div class="d-flex align-self-stretch align-items-center justify-content-between flex-grow-1 flex-row-mobile">

                                    <div class="job-box card">
                                        <div class="card-body">
                                            <div class="text-center img-responsive mb-3">
                                                <img class="img-responsive" src="{{url('/images/salary.png')}}"/>
                                            </div>
                                            <h5 class="text-truncate text-center d-block" >{{$user->salary}}</h5>
                                            <h3 class="color-black text-center d-block">Salary</h3>
                                        </div>
                                    </div>
                                    <div class="job-box card">
                                        <div class="card-body">
                                            <div class="text-center img-responsive mb-3">
                                                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>
                                            </div>
                                            <h5 class="text-truncate text-center d-block">

                                                {{!empty($user->sector)?$user->sector->name:""}}

                                            </h5>
                                            <h3 class="color-black text-center d-block">Industry</h3>
                                        </div>
                                    </div>

                                    <div class="job-box card">
                                        <div class="card-body">
                                            <div class="text-center img-responsive mb-3">
                                                <img class="img-responsive" src="{{url('/images/gender.png')}}"/>
                                            </div>
                                            <h5 class="text-truncate text-center d-block">@php
                                                    if (!empty($user->gender_id)) {
                                                @endphp
                                                {{($user->gender_id == 1)?"Male":"Female"}}
                                                @php
                                                    }
                                                @endphp
                                            </h5>
                                            <h3 class="color-black text-center d-block">Gender</h3>
                                        </div>
                                    </div>
                                    @if (auth()->check() && auth()->user()->user_type_id==1 && auth()->user()->id != $user->id)
                                        <div class="job-box card">
                                            <div class="card-body px-0">
                                                <div class="text-center img-responsive mb-3" style="padding: 17px;">
                                                    <h1 class="text-truncate text-center d-block px-0" style="font-size: 3rem;">({{$endorsementCount}})</h1>
                                                </div>
                                                <h3 class="color-black text-center d-block">Endorsed</h3>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->check() && auth()->user()->user_type_id==2 && auth()->user()->id != $user->id)
                                        <div class="job-box card">
                                            <div class="card-body px-0">
                                                <div class="text-center img-responsive mb-3" style="padding: 17px;">
                                                    <h1 class="text-truncate text-center d-block px-0" style="font-size: 3rem;">({{$endorsementCount}})</h1>
                                                </div>
                                                <h3 class="color-black text-center d-block">Endorsed</h3>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if((!empty($user->social_links) && !empty($refereeData)) || (auth()->check() && (auth()->user()->id == $user->id || auth()->user()->hasRole('super-admin'))))
                                    <div class="d-flex flex-shrink-1">
                                        @if((!empty($user->social_links) && !empty($refereeData)) || (auth()->check() && (auth()->user()->id == $user->id || auth()->user()->hasRole('super-admin'))))
                                            <div class="w-100 text-right social">
                                                @if(!empty($user->social_links['facebook']))<h4><a href="{{$user->social_links['facebook']}}"> <i class="fab fa-facebook mx-1"></i></a> </h4>@endif
                                                @if(!empty($user->social_links['twitter']))<h4><a href="{{$user->social_links['twitter']}}"><i class="fab fa-twitter mx-1"></i></a></h4>@endif
                                                @if(!empty($user->social_links['linkedin']))<h4><a href="{{$user->social_links['linkedin']}}"><i class="fab fa-linkedin mx-1"></i></a> </h4>@endif
                                                @if(!empty($user->social_links['instagram']))<h4><a href="{{$user->social_links['instagram']}}"><i class="fab fa-instagram mx-1"></i></a></h4>@endif

                                            </div>

                                        @endif
                                    </div>
                                @endif
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
            <div class="row">
                @if(!empty($user->about_me))
                    <h2 class="color-blue mt-5">About Me</h2>
                    <div class="col-md-12">
                        {{$user->about_me}}
                    </div>
                @endif

                @if(!empty($user->extra_educations) && !empty($user->extra_educations['title'][0]))
                    @php
                        $educations =$user->extra_educations;

                    if (count($educations['title']) > 0 && !empty($educations['title'][0]))
                    {
                    @endphp
                    <div class="col-md-6 px-2 col-sm-12 mt-5">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-row mt-3">
                                    <img src="{{url('images/education.png')}}"/>
                                    <h2 class="color-blue p-0 ml-2">Education </h2>
                                </div>
                                @for($e=0;$e< count($educations['title']); $e++)
                                    <div class="d-flex justify-content-start flex-wrap mt-3 cv-additional">
                                        <div class="d-inline-block cv-detail text-center small color-blue">
                                            {{ !empty($educations['start_date'][$e])?date('Y',strtotime($educations['start_date'][$e])): ""}} - {{(array_key_exists('current',$educations) && ($educations['current'][0] == $e+1))?'Current': (!empty($educations['end_date'][$e])?date('Y',strtotime($educations['end_date'][$e])): "")}}
                                        </div>
                                        <div class="d-inline-block px-1">
                                            <h5>{!!$educations['institue'][$e] ?? ""!!}</h5>
                                            <h4>{!!$educations['title'][$e] ?? ""!!}</h4>
                                            <p>
                                                {!!$educations['description'][$e] ?? ""!!}
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @php
                        }
                    @endphp
                @endif


                @if(!empty($user->extra_experiences) && !empty($user->extra_experiences['title'][0]))
                    @php
                        $experiences =$user->extra_experiences;

if (count($experiences['title']) > 0 && !empty($experiences['title'][0]))
                    {
                    @endphp
                    <div class="col-md-6 px-2 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-row mt-3">
                                    <img src="{{url('images/experience.png')}}"/>
                                    <h2 class="color-blue p-0 ml-2">Experience</h2>
                                </div>
                                @for($e=0;$e< count($experiences['title']); $e++)
                                    
                                    <div class="d-flex justify-content-start flex-wrap mt-3 cv-additional  ">

                                        <div class="d-inline-block cv-detail text-center small color-blue">
                                            {{ !empty($experiences['start_date'][$e])?date('Y',strtotime($experiences['start_date'][$e])): ""}} -  {{(array_key_exists('current',$experiences) && ($experiences['current'][0] == $e+1))?'Current': (!empty($experiences['end_date'][$e])?date('Y',strtotime($experiences['end_date'][$e])): "")}}
                                        </div>
                                        <div class="d-inline-block px-1">
                                            <h5>{!!$experiences['company'][$e] ?? ""!!}</h5>
                                            <h4>{!!$experiences['title'][$e] ?? ""!!}</h4>
                                            <p>
                                                {!!$experiences['description'][$e] ?? ""!!}
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @php
                        }
                    @endphp
                @endif

                @if(!empty($user->extra_skills) && !empty($user->extra_skills['title'][0]))
                    @php
                        $skills =$user->extra_skills;

if (count($skills['title']) > 0 && !empty($skills['title'][0]))
                    {
                    @endphp
                    <div class="col-md-6 px-2 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-row mt-3">
                                    <img src="{{url('images/education.png')}}"/>
                                    <h2 class="color-blue p-0 ml-2">Skills</h2>
                                </div>
                                @for($e=0;$e< count($skills['title']); $e++)
                                    <div class="d-flex justify-content-start flex-wrap mt-3 cv-additional">
                                        <div class="d-inline-block cv-detail text-center small color-blue">
                                            {{ !empty($skills['start_date'][$e])?date('Y',strtotime($skills['start_date'][$e])): ""}}  {{ !empty($skills['end_date'][$e])?date('Y',strtotime($skills['end_date'][$e])): ""}}
                                        </div>
                                        <div class="d-inline-block px-1">
                                            <h5>{!!$skills['company'][$e] ?? ""!!}</h5>
                                            <h4>{!!$skills['title'][$e] ?? ""!!}</h4>
                                            <p>
                                                {!!$skills['description'][$e] ?? ""!!}
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @php
                        }
                    @endphp
                @endif


                @if(!empty($user->acheivements) && !empty($user->acheivements['title'][0]))
                    @php
                        $acheivements =$user->acheivements;

if (count($acheivements['title']) > 0 && !empty($acheivements['title'][0]))
                    {
                    @endphp
                    <div class="col-md-6 px-2 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-row mt-3">
                                    <img src="{{url('images/acheivements.png')}}"/>
                                    <h2 class="color-blue p-0 ml-2">Achievements</h2>
                                </div>
                                @for($e=0;$e< count($acheivements['title']); $e++)
                                    <div class="d-flex justify-content-start flex-wrap mt-3 cv-additional">
                                        <div class="d-inline-block cv-detail text-center small color-blue">
                                            {{ !empty($acheivements['start_date'][$e])?date('Y',strtotime($acheivements['start_date'][$e])): ""}}  {{ !empty($acheivements['end_date'][$e])?date('Y',strtotime($acheivements['end_date'][$e])): ""}}
                                        </div>
                                        <div class="d-inline-block px-1">
                                            <h4>{!!$acheivements['title'][$e] ?? ""!!}</h4>
                                            <p>
                                                {!!$acheivements['description'][$e] ?? ""!!}
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @php
                        }
                    @endphp
                @endif


            </div>
            @if(!empty($refereeData) && $show_details || (auth()->check() && ($user->id == auth()->user()->id || auth()->user()->hasRole('super-admin'))))
                @php
                    $referees = $user->referees;
                if (count($referees['name'])>0 && count($referees['email']) > 0 && !empty($referees['name'][0]) && !empty($referees['email'][0]))
                {
                @endphp
                <div class="row mt-5">
                    @for($i=0;$i< count($referees['name']); $i++)

                        <div class="col-md-6 col-sm-12">
                            <div class="card referee-details">
                                <div class="card-header">Referee {{str_pad($i+1,2,'0',STR_PAD_LEFT)}}</div>
                                <div class="card-body">
                                    <table class="w-100">

                                        <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><span class="name" data-name="{{$referees['name'][$i]}}"> {{$referees['name'][$i]}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><span class="email" data-email="{{$referees['email'][$i]}}">{{$referees['email'][$i]}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Company</td>
                                            <td><span class="company" data-company="{{$referees['company'][$i]}}">{{$referees['company'][$i]}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td><span class="position" data-position="{{$referees['position'][$i]}}">{{$referees['position'][$i]}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><span class="phone" data-phone="{{$referees['phone'][$i]}}">{{$referees['phone'][$i]}}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                @if (auth()->user()->id != $user->id)
                                                    <a href="#" class="btn btn-primary m-auto d-block email-form my-2">Send Reference Check </a>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endfor
                    @php
                        }

                    @endphp
                </div>
            @endif



            {{--                        @if(auth()->user()->user_type_id == 1 && !empty($userReview))--}}





            <div class="row mt-5">
                <div class="col-md-12">

                    <div class="card">
                        <h2 class="color-blue font-weight-bold my-3">Reviews</h2>
                        <div class="card-body">
                            @if(auth()->check() && (auth()->user()->user_type_id == 1 || auth()->user()->hasRole('super-admin')))
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-start mb-4">
                                        <div class="d-inline-flex px-2 align-self-start">
                                            @php
                                                $reviewer = App\Models\User::with('myCompanies')->findOrFail(auth()->user()->id);
                                             
                                            @endphp
                                            <img src="{{!empty($reviewer->myCompanies[0]->logo)?url('/storage/'.$reviewer->myCompanies[0]->logo):url('/images/user.jpg')}}" class="profile-pic rounded-circle review-pic border-0" />
                                        </div>

                                        <div class="d-inline-flex flex-grow-1  px-2">
                                            <form method="POST"
                                                  action="{{ lurl('seeker/' . $user->id . '/review') }}"
                                                  id="reviewForm" class="w-100">
                                                @if(isset($errors))
                                                    <div class="alert-danger">
                                                        {{$errors->first('rating')}}
                                                    </div>
                                                @endif

                                                <textarea class="form-control" name="comment" rows="8" value=""></textarea>

                                                <input type="hidden" name="rating"
                                                       value="{{(!empty($userReview)  && count($userReview)>0)?$userReview[0]->rating:''}}">
                                                <div class='rating-stars text-center my-2'>
                                                    <ul id='stars'>
                                                        <li class='star' title='Poor' data-value='1'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Fair' data-value='2'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Good' data-value='3'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Excellent' data-value='4'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='WOW!!!' data-value='5'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <button type="submit" id="submitButton"
                                                        class="btn btn-primary btn-block mt-1"> Review
                                                </button>

                                            </form>
                                        </div>

                                    </div>
                                    @endif

                                    @foreach($reviews as $review)
                                        @if(!empty($review->reviewer) && $review->status == 0)

                                            <div class="col-md-12 d-flex justify-content-start border-bottom mb-3">
                                                <div class="d-inline-flex flex-grow-1">
                                                    <div class="d-inline-flex px-2 align-items-start">
                                                        <img src="{{!empty($review->reviewer->avatar_url)?url('/storage/'.$review->reviewer->avatar_url):url('/images/user.jpg')}}" class="profile-pic review-pic p-0 border-0 rounded-circle" />
                                                    </div>
                                                    <div class="d-inline-flex flex-grow-1">
                                                        <div class="d-block">
                                                            <h3 class="color-black font-weight-bold">{{((count($review->reviewer->myCompanies) > 0)?$review->reviewer->myCompanies[0]->name:$review->reviewer->name)}}</h3>
                                                            <p>
                                                                {{$review->comment}}
                                                                <span>
                                                            <div class="review" data-rating="{{$review->rating}}">
                                <div class="review-stars">
                                    <div class='rating-stars list-rating text-center'>
                                        <ul>
                                            <li class='star' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent'
                                                data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                                            </div>
                                                        </span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->check() && auth()->user()->id == $user->id)
                                                    <div class="d-inline-flex flex-shrink-1 align-items-center">


                                                        @if ($review->report == null)

                                                            <a class="btn btn-primary report" data-id="{{$review->id}}">
                                                                Report Review
                                                            </a>
                                                        @else
                                                            @php
                                                                $class = ["","badge-primary","badge-success","badge-danger"];
                                                            @endphp
                                                            <span class="badge p-2 {{$class[$review->report->status->id]}}">{{$review->report->status->review_status}}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                                @endif
                                         
                                                @endforeach
                                            
                                </div>
                        </div>
                    </div>
                </div>

                {{--@endif--}}
            </div>

        </div>
    </div>
    </div>

    @if(!empty($reviews) )

        <div class="modal" id="report-reivew">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Report a Reivew</h4>
                        <button type="button" class="close"
                                data-dismiss="modal">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">


                        <form action="{{ lurl('report_review') }}"
                              method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Your Comments</label>
                                        <textarea class="form-control" name="comments" required minlength="40" maxlength="200"></textarea>
                                        <input type="hidden" name="review_id" value="" id="review-id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn-primary float-right btn mt-1">Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                                data-dismiss="modal">Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if(!empty($jobs) )

        <div class="modal" id="myModalConnect">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Connects</h4>
                        <button type="button" class="close"
                                data-dismiss="modal">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>Whichjob you want to connect with him for</p>

                        <form action="{{ lurl('search-talent/seeker/' . $user->id . '/connexion') }}"
                              method="get">
                            @csrf
                            <select class="form-control" name="job_id[]" id="jobs-dropdown" multiple="multiple">
                                @if(!empty($jobs))
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->title ?? ""}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="submit"
                                    class="btn-primary btn mt-1">Connect
                            </button>
                        </form>


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                                data-dismiss="modal">Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
    @if(!empty($refereeData))
        <div class="modal" id="modal-send-email">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close"
                                data-dismiss="modal">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">


                        <form action="{{ lurl('account/connected/referee_check/send') }}" id="ref-form"
                              method="post">
                            @csrf
                            <input type="hidden" name="email" value=""/>
                            <input type="hidden" name="subject" value="{{'Employee verification of '.$user->name}}"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message :</label>
                                    </div>
                                    <textarea name="message" name="message" class="form-control" id="referee-message">

                                                                    </textarea>
                                </div>
                                <div class="col-md-12">

                                    <button type="submit"
                                            class="btn-primary btn d-block mx-auto mt-2" >Send Email
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                                data-dismiss="modal">Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif


@endsection

@section('after_styles')
    @include('layouts.inc.tools.wysiwyg.css')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />

    <style>
        .simditor-body {
            max-height:250px !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        .simditor .simditor-toolbar > ul > li > .toolbar-item {
            vertical-align: top;
        }

        .select2-container {
            z-index: 100000;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }
    </style>
@endsection

@section('after_scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simditor/scripts/mobilecheck.js') }}"></script>
    <script src="{{ asset('assets/plugins/simditor/scripts/module.js') }}"></script>
    <script src="{{ asset('assets/plugins/simditor/scripts/uploader.js') }}"></script>
    <script src="{{ asset('assets/plugins/simditor/scripts/hotkeys.js') }}"></script>
    <script src="{{ asset('assets/plugins/simditor/scripts/simditor.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#jobs-dropdown').select2({width:'100%',placeholder: "Select a Job",
                allowClear: true});
            var  toolbar = ['bold','italic','underline','alignment','|','ul','ol','link'];
            var applicant_name = "{{(!empty($refereeData)?$refereeData->applicant:'')}}";
            // var position = "{{(!empty($refereeData)?$user->job_title:'')}}";
            var position = "";
            var employer = "{{(!empty($refereeData)?$refereeData->employer:'')}}";
            var html_txt = ' <p>\n' +
                '        Hi Mr. *Name*,\n' +
                '        </p>\n' +
                '<p>\n' +
                '    *Applicant* has applied for the position of *Position* and mentioned you as one of his\n' +
                '        references in his resume. The experiences and qualifications detailed on his resume suggest that he would\n' +
                '        expertly perform the requirements of the *Position* position.\n' +
                '</p>\n' +
                '        <p>\n' +
                '            However, in addition to considering the applicant\'s documented experiences and credentials, in the process of\n' +
                '            finalizing our decision, we are contacting all of the references listed on his resume. Since you are one of the\n' +
                '            applicant\'s primary professional references, I am writing today to request your personal insight into *Applicant*\'s abilities and qualifications. At a time convenient to you, I would appreciate the opportunity to\n' +
                '            speak with you about the applicant over a quick call. Our contact information is listed below. I thank you in\n' +
                '            advance for your cooperation, and I look forward to hearing from you.\n' +
                '        </p>\n' +
                '        \n' +
                '        <p>\n' +
                '            Sincerely,<br>\n' +
                '            *Employer*\n' +
                '        </p>';
            var $preview, editor, mobileToolbar, toolbar, allowedTags;
            Simditor.locale = '{{ config('app.locale') }}';

            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br','span','a','img','b','strong','i','alignment','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
            editor = null;
            if (document.getElementById('referee-message'))
            {
                editor = new Simditor({
                    textarea: $('#referee-message'),
                    placeholder: 'Enter Reference Message...',
                    toolbar: toolbar,
                    pasteImage: false,
                    defaultImage: '{{ asset('assets/plugins/simditor/images/image.png') }}',
                    upload: false,
                    allowedTags: allowedTags
                });

            }

            $(".report").on('click',function () {
                $("#report-reivew").modal("show");
                $("#review-id").val($(this).data('id'));

            })

            $(".email-form").on('click',function() {

                $("#modal-send-email .modal-title").html("Send Reference Check Email to "+ $(this).closest("table").find('span.name').data('name'));
                $("#ref-form").find("input[name='email']").val($(this).closest("table").find('span.email').data('email'));
                var temp = html_txt.replace(/\*Name\*/gi,$(this).closest("table").find('span.name').data('name'));
                temp = temp.replace(/\*Position\*/gi,position);
                temp = temp.replace(/\*Applicant\*/gi,applicant_name);
                temp = temp.replace(/\*Employer\*/gi,employer);
                editor.setValue(temp);
                $("#modal-send-email").modal('show');

            });

            $('.jobsearch-candidate-default-btn').click(function () {
                let candidateId = $(this).attr('data-candidateid');
                //alert(candidateId);
                $.ajax({
                    url: "{{route('save.candidate')}}",
                    type: 'post',
                    data: {
                        candidateId: candidateId,
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {

                        if (data.logged >= 1) {
                            alert(data.message);
                        } else {

                            alert(data.message);
                        }

                    }
                })

            });
        });
    </script>
    <script>

        $(document).ready(function () {

            var current_rating = "{{(!empty($userReview) && count($userReview) > 0)?$userReview[0]->rating:0}}";
            console.log(current_rating);
            if (parseInt(current_rating) > 0) {
                var stars = $("#stars").children('li.star');
                for (i = 0; i < parseInt(current_rating); i++) {
                    $(stars[i]).addClass('selected');
                }
            }

            $(".review").each(function () {
                var stars = $(this).find(".rating-stars ul").children('li.star');
                var review_rating = $(this).data('rating');
                for (i = 0; i < parseInt(review_rating); i++) {
                    $(stars[i]).addClass('selected');
                }
            })

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');
                $("input[name=rating]").val(onStar);
                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
    </script>
    <script>

        $(document).ready(function () {
            $("#submitButton").on("click", function (e) {
                e.preventDefault();
                var input = $("#textInput").val()
                $("#guests").html(input);
                $('#reviewForm').submit();
            })
        });

    </script>
    <script type="text/javascript">
        var clicks = 0;

        function onClick() {
            clicks += 1;
            document.getElementById("clicks").innerHTML = clicks;
        }
        ;
    </script>

    <!--<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=sYPib-4HG3Kq22t0_eSgUV3OGPLyv4oFBAvLFJagLrSfgPj4UR5rWAhK9oREN54S1BQhSM-Cga3VSBq1CJAi8ChUeHCls9MOcfEl7FMn9tcHC8zO0SVvooFmsf-7QvlgA8eSksLLrzeLnFGMgG-Ht9YtE4O4nKGL8Vz-9Tr0Ze4" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly93d3cuanF3aWRnZXRzLmNvbS9qcXVlcnktd2lkZ2V0cy1kb2N1bWVudGF0aW9uL2RvY3VtZW50YXRpb24vanF4cmF0aW5nL2pxdWVyeS1yYXRpbmdfc2FtcGxlNC5odG0"/><script type="text/javascript" src="../../scripts/jquery-1.11.1.min.js"></script>-->
    <!--<script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>-->

    <script type="text/javascript">
        $(document).ready(function () {
            // Create jqxRating.
            $("#jqxRating").jqxRating({width: 350, height: 35});
            // bind to jqxRating 'change' event.
            $("#jqxRating").bind('change', function (event) {
                $("#rate").html('<span>' + event.value + '</span');
            });
        });
    </script>
    <script type="text/javascript">
        function showMessage() {
            alert("Request already sent.");
        }
    </script>
@endsection

