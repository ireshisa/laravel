<!--<link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />-->
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
    @php

        $connection_count = null;
        if (auth()->check() && auth()->user()->user_type_id == 1)
        {
            $connection_count=count($user->messagesConnectedApproved($user->id))?? null;

        }


    @endphp


    <div class="h-spacer">
        <div class="main-container">
            <div class="h-spacer">
                <div class="container">
                    @if (Session::has('flash_notification'))

                        <div class="row">
                            <div class="col-xl-12">
                                @include('flash::message')
                            </div>
                        </div>

                    @endif
                        <div class="row">
                            <div class="col-md-12 job-description">

                            </div>
                            <div class="col-md-10 col-sm-12 offset-1 brief card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="card rounded">
                                                <div class="card-body">
                                                    <div class="rounded-circle">
                                                        <img class="img-responsive" src="{{(!empty($user->avatar_url)?$user->photo:url('/images/user.jpg'))}}"/>
                                                    </div>
 <h2 class="color-black font-weight-bold">{{explode(' ',$user->name)[0] ?? $user->name}}</h2>
                                                    <h4><i class="fa fa-phone mr-1 fa-flip-horizontal"></i> {{$user->phone}}</h4>
                                                    <h4><i class="fa mr-1 fa-envelope"></i> {{$user->email}}</h4>
                                                    <h4>Age :{{$user->age}}</h4>
                                                    <h4><i class="fa mr-1 fa-money"></i> {{$user->salary}}</h4>
                                                    <h4><i class="fa mr-1 fa-map-marker"></i> {{!empty($user->location)?$user->location:"Not Specified"}}</h4>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-9 col-sm-12 job-details">
                                            <div class="row">
                                                <div class="col-md-9 col-sm-12">
                                                    <h2 class="color-black font-weight-bold">About {{explode(' ',$user->name)[0] ?? $user->name}}</h2>
                                                </div>
                                                <div class="col-md-3 col-sm-12 ">
                                                    @if (isset(auth()->user()->user_type_id))



                                                        @if (in_array(auth()->user()->user_type_id, [1]))
                                                            @if(empty($refereeData) && !empty($jobs) && count($jobs)>0)

                                                            <a class="btn  float-right btn-primary d-block btn-transparent color-blue" id="btnShowMsg" data-target="#myModalConnect" data-toggle="modal">
                                                               Connect
                                                            </a>
                                                        @endif
                                                        @endif
                                                        @endif

                                                </div>
                                                <div class="col-md-12 d-flex justify-content-between">
                                                    <div class="candidate-box card">
                                                        <div class="card-body">
                                                            <img class="img-responsive" src="{{url('/images/salary.png')}}"/>
                                                            <h5>{{$user->salary}}</h5>
                                                            <h3>Salary</h3>
                                                        </div>
                                                    </div>
                                                    <div class="candidate-box card">
                                                        <div class="card-body">
                                                            <img class="img-responsive" src="{{url('/images/gender.png')}}"/>
                                                            <h5>@php
                                                                    if (!empty($user->gender_id)) {
                                                            @endphp
                                                            {{($user->gender_id == 1)?"Male":"Female"}}
                                                                @php
                                                                    }
                                                                    @endphp
                                                            </h5>
                                                            <h3 class="color-black">Gender</h3>
                                                        </div>
                                                    </div>

                                                    <div class="justify-content-end align-self-end">
                                                        fxjfnfd ddgnng
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    <div class="jobsearch-main-content page-content">
                        <div class="jobsearch-plugin-default-container">
                            <div class="row jobsearch-row">
                                <div class="col-lg-3 page-sidebar-right ">
                                    <aside class="jobsearch-typo-wrap">
                                        <div class="card sidebar-card card-contact-seller jobsearch_side_box jobsearch_box_candidate_info">
                                            <div class="card-content user-info jobsearch_candidate_info">
                                                <div class="card-body text-center">
                                                    <figure>
                                                        <img class="mb-3"
                                                             src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}"
                                                             alt="">
                                                    </figure>
                                                    <h2>
                                                        {{explode(' ',$user->name)[0] ?? $user->name}}
                                                    </h2>

                                                    @if (isset(auth()->user()->user_type_id))



                                                        @if (in_array(auth()->user()->user_type_id, [1]))
                                                            @if(empty($refereeData) && !empty($jobs) && count($jobs)>0)
                                                                <a href="#" class="btn btn-primary btn-block"
                                                                   id="btnShowMsg" data-toggle="modal"
                                                                   data-target="#myModalConnect">Connect</a>
                                                                <a href="javascript:void(0);"
                                                                   class="jobsearch-candidate-default-btn jobsearch-open-signin-tab candidate_id"
                                                                   data-candidateId="{{$user->id??''}}"><i
                                                                            class="jobsearch-icon jobsearch-add-list"></i> Save
                                                                    Candidate </a>

                                                            @endif
                                                            {{--                            <input type="button" id="btnShowMsg" value="connect" onClick='showMessage()'/>--}}
                                                        <!--
                            
                                                        <br>-->
                                                        @endif
                                                        @if((!empty($user->social_links) && !empty($refereeData)) || (auth()->user()->id == $user->id))
                                                            <div class="w-100 text-left social">
                                                                @if(!empty($user->social_links['facebook']))<h4><span><i class="fa fa-facebook mx-1"></i>{{$user->social_links['facebook']}} </span></h4>@endif
                                                                @if(!empty($user->social_links['twitter']))<h4><span><i class="fa fa-twitter mx-1"></i>{{$user->social_links['twitter']}} </span></h4>@endif
                                                                @if(!empty($user->social_links['linkedin']))<h4><span><i class="fa fa-linkedin mx-1"></i>{{$user->social_links['linkedin']}} </span></h4>@endif
                                                                @if(!empty($user->social_links['instagram']))<h4><span><i class="fa fa-instagram mx-1"></i>{{$user->social_links['instagram']}} </span></h4>@endif

                                                            </div>

                                                    @endif

                                                    @auth
                                                        @if (auth()->user()->id == $user->id || auth()->user()->user_type_id == 1)
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-primary w-100 text-center">
                                            <h4 class="head text-white">Reviews</h4>
                                        </div>
                                        <div class="card sidebar-card card-contact-seller jobsearch_side_box jobsearch_box_candidate_info">
                                            <div class="card-content user-info jobsearch_candidate_info">
                                                <div class="card-body text-center">

                                                    @foreach($reviews as $review)
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
                                                            <blockquote class="blockquote text-center">
                                                                <p class="mb-0">{{$review->comment}}</p>
                                                                @if ($review->reviewer)
                                                                    <footer class="blockquote-footer text-right">{{$review->reviewer->name}}</footer>
                                                                @endif
                                                            </blockquote>

                                                        </div>
                                                        <hr>
                                                    @endforeach



                                                        @if(auth()->user()->user_type_id == 1 && !empty($userReview))
                                                            <form method="POST"
                                                                  action="{{ lurl('seeker/' . $user->id . '/review') }}"
                                                                  id="reviewForm">
                                                        <textarea rows="3" cols="30" id="textInput" class="form-control"
                                                                  name="comment"> {{(count($userReview))?$userReview[0]->comment:''}}</textarea>
                                                                <input type="hidden" name="rating"
                                                                       value="{{(count($userReview))?$userReview[0]->rating:''}}">

                                                                <button type="submit" id="submitButton"
                                                                        class="btn btn-primary btn-block mt-1"> Review
                                                                </button>


                                                            </form>

                                                            <span id="guests">
                                {{$comment ?? ""}}
                            </span>
                                                            @if(isset($errors))
                                                                <div class="alert-danger">
                                                                    {{$errors->first('rating')}}
                                                                </div>
                                                            @endif
                                                            <br>


                                                            <div class="mb-4">
                                                                <!-- Rating Stars Box -->
                                                                <div class='rating-stars text-center'>
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
                                                            </div>


                                                            <div class='success-box'>
                                                                <div class='clearfix'></div>
                                                                <img alt='tick image' width='32'
                                                                     src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
                                                                <div class='text-message'></div>
                                                                <div class='clearfix'></div>
                                                            </div>
                                                        @endif
                                                    @endauth

                                                    @endif
                                                    @endif


                                                    <br>


                                                    @if(!empty($jobs) && empty($refereeData))
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



                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="col-lg-9 page-content col-thin-right jobsearch-typo-wrap jobsearch-typo-wrap">
                                    <div class="inner inner-box items-details-wrapper pb-0 container-wrapper container-wrapper-view1">
                                        <h2 class="enable-long-words">
                                            <strong>
                                                About {{$user->name ?? ""}}
                                            </strong>
                                        </h2>
                                        <span class="info-row">
                    <span class="category">{{$user->sector ? $user->sector->name : '-'}}</span> -&nbsp;
                    <span class="item-location"><i
                                class="fas fa-map-marker-alt mr-2"></i>{{$user->location ?? ""}}</span>
                </span>

                                        <div class="items-details">
                                            <div class="row pb-4">
                                                <div class="items-details-info jobs-details-info col-md-12 col-sm-12 col-xs-12 enable-long-words">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-4">
                                                                <h5 class="list-title"><strong>Qualifications</strong>
                                                                </h5>

                                                                <!-- Description -->
                                                                <div>
                                                                    {!! implode('<br>', explode(PHP_EOL, $user->qualifications)) !!}
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h5 class="list-title"><strong>Skills</strong></h5>

                                                                <!-- Description -->

                                                                <div>
                                                                    {{$user->skills ?? ""}}

                                                                    @if (auth()->check() && auth()->user()->user_type_id == 2 && auth()->user()->id != $user->id)
                                                                        <form method="POST"
                                                                              action="{{ lurl('seeker/' . $user->id . '/endorse') }}">
                                                                            <button class="btn btn-primary btn-block"
                                                                            >Endorse
                                                                            </button>
                                                                        </form>


                                                                        <p>Endorsement: <a
                                                                                    id="endorsements">{{$endorsementCount ?? ""}}</a>
                                                                        </p><br>
                                                                    @endif

                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h5 class="list-title"><strong>Description</strong></h5>

                                                                <!-- Description -->
                                                                <div>
                                                                    {{$user->about_me ?? ""}}
                                                                </div>
                                                            </div>


                                                        </div>



                                                        <div class="col-lg-6">
                                                            <ul class="list mt-4 seeker-details-list">

                                                                @if(!empty($refereeData) && !empty($user->referees) || (auth()->check() && auth()->user()->id == $user->id))

                                                                    <li>
                                                                        <h4>
                                                                            <span class="text-muted">Email</span>: {{$user->email ?? ""}}
                                                                        </h4>
                                                                    </li>
                                                                    <li>
                                                                        <h4>
                                                                            <span class="text-muted">Phone</span>: {{$user->phone ?? ""}}
                                                                        </h4>
                                                                    </li>
                                                                    <li>
                                                                        <h4>
                                                                            <span class="text-muted">Gender</span>: {{$user->gender ?? ""}}
                                                                        </h4>
                                                                    </li>
                                                                    <li>
                                                                        <h4>
                                                                            <span class="text-muted">Age</span>: {{$user->age ?? ""}}
                                                                        </h4>
                                                                    </li>
                                                                @endif

                                                                <li>
                                                                    <h4>
                                                                        <span class="text-muted">Expected salary</span>:
                                                                        LKR {{$user->salary ?? ""}}
                                                                    </h4>
                                                                </li>
                                                                <li>
                                                                    <h4>
                                                                        <span class="text-muted">Experience</span>: {{ isset($experiences[$user->experience]) ? $experiences[$user->experience] : '-'  }}
                                                                    </h4>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>




                                                    <div class="row">


                                                        @if(!empty($user->extra_educations) && !empty($user->extra_educations['title'][0]))
                                                            @php
                                                                $educations =$user->extra_educations;

if (count($educations['title']) > 0 && !empty($educations['title'][0]))
                                                            {
                                                            @endphp
                                                            <div class="col-lg-10">
                                                                <div class="mb-4">

                                                                    <h5 class="list-title">
                                                                        <strong>Educations</strong></h5>

                                                                    <table class="table ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Title</th>
                                                                            <th scope="col">Academic Year</th>
                                                                            <th scope="col">
                                                                                college/Campus/University
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @for($e=0;$e< count($educations['title']); $e++)
                                                                            <tr>
                                                                                <th scope="row">{{$e+1 ?? ""}}</th>
                                                                                <td>{{$educations['title'][$e] ?? ""}}</td>
                                                                                <td>{!!$educations['start_date'][$e] ?? ""!!}
                                                                                    - {!!$educations['end_date'][$e] ?? ""!!}</td>
                                                                                <td>{!!$educations['description'][$e] ?? ""!!}</td>
                                                                            </tr>
                                                                        @endfor
                                                                        </tbody>
                                                                    </table>


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
                                                         //   dd(count($acheivements['title']))
                                                            @endphp
                                                            <div class="col-lg-10">
                                                                <div class="mb-4">
                                                                    <h5 class="list-title">
                                                                        <strong>Acheivements</strong></h5>

                                                                    <table class="table ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Title</th>
                                                                            <th scope="col">Year</th>
                                                                            <th scope="col">Description</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @for($ex=0;$ex< count($acheivements['title']); $ex++)
                                                                            <tr>
                                                                                <th scope="row">{{$ex+1 ?? ""}}</th>
                                                                                <td>{{$acheivements['title'][$ex] ?? ""}}</td>

                                                                                <td>{!!$acheivements['start_date'][$ex] ?? ""!!}
                                                                                    - {!!$acheivements['end_date'][$ex] ?? ""!!}</td>
                                                                                @if(!empty($acheivements['description'][$ex]))
                                                                                    @php
                                                                                        $experiences_descs=  array_filter(explode("\r\n", $acheivements['description'][$ex]));
                                                                                       // dd($experiences_descs);
                                                                                    @endphp
                                                                                    <td>
                                                                                        <ul>
                                                                                            @foreach($experiences_descs as $exp_desc)
                                                                                                <li>
                                                                                                    {!! $exp_desc ?? ""!!}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>

                                                                                    </td>

                                                                                @endif
                                                                            </tr>
                                                                        @endfor
                                                                        </tbody>
                                                                    </table>

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
                                                            <div class="col-lg-10">
                                                                <div class="mb-4">
                                                                    <h5 class="list-title">
                                                                        <strong>Experiences</strong></h5>

                                                                    <table class="table ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Title</th>
                                                                            <th scope="col">Company</th>
                                                                            <th scope="col">Year</th>
                                                                            <th scope="col">Description</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @for($ex=0;$ex< count($experiences['title']); $ex++)
                                                                            <tr>
                                                                                <th scope="row">{{$ex+1 ?? ""}}</th>
                                                                                <td>{{$experiences['title'][$ex] ?? ""}}</td>
                                                                                <td>{{$experiences['company'][$ex] ?? ""}}</td>
                                                                                <td>{!!$experiences['start_date'][$ex] ?? ""!!}
                                                                                    - {!!$experiences['end_date'][$ex] ?? ""!!}</td>
                                                                                @if(!empty($experiences['description'][$ex]))
                                                                                    @php
                                                                                        $experiences_descs=  array_filter(explode("\r\n", $experiences['description'][$ex]));
                                                                                       // dd($experiences_descs);
                                                                                    @endphp
                                                                                    <td>
                                                                                        <ul>
                                                                                            @foreach($experiences_descs as $exp_desc)
                                                                                                <li>
                                                                                                    {!! $exp_desc ?? ""!!}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>

                                                                                    </td>

                                                                                @endif
                                                                            </tr>
                                                                        @endfor
                                                                        </tbody>
                                                                    </table>

                                                                </div>

                                                            </div>
                                                            @php
                                                                }
                                                            @endphp
                                                        @endif


                                                        @if(!empty($user->extra_skills))

                                                            @php
                                                                $skills =$user->extra_skills;
                                                            if (count($skills['title']) > 0 && !empty($skills['title'][0]))
                                                            {
                                                            @endphp
                                                            <div class="col-lg-10">
                                                                <div class="mb-4">
                                                                    <h5 class="list-title"><strong>Skills</strong>
                                                                    </h5>


                                                                    <table class="table ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Title</th>
                                                                            <th scope="col">Training Year</th>
                                                                            <th scope="col">
                                                                                College/Campus/University/Institues
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @for($s=0;$s< count($skills['title']); $s++)
                                                                            <tr>
                                                                                <th scope="row">{{$s+1 ?? ""}}</th>
                                                                                <td>{{$skills['title'][$s] ?? ""}}</td>
                                                                                <td>{!!$skills['start_date'][$s] ?? ""!!}
                                                                                    - {!!$skills['end_date'][$s] ?? ""!!}</td>
                                                                                @if(!empty($skills['description'][$s]))
                                                                                    @php
                                                                                        $skill_descs=  array_filter(explode("\r\n", $skills['description'][$s]));
                                                                                       // dd($skill_descs);
                                                                                    @endphp
                                                                                    <td>
                                                                                        <ul>
                                                                                            @foreach($skill_descs as $skill_desc)
                                                                                                <li>
                                                                                                    {!! $skill_desc ?? ""!!}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endfor
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            @php
                                                                }
                                                            @endphp
                                                        @endif


                                                    </div>




                                                </div>

                                            </div>


                                        </div>

                                        @if(!empty($refereeData) && !empty($user->referees) || (auth()->check() && $user->id == auth()->user()->id))
                                            @php
                                                $referees = $user->referees;
                                            if (count($referees['name'])>0 && count($referees['email']) > 0 && !empty($referees['name'][0]) && !empty($referees['email'][0]))
                                            {
                                            @endphp

                                            <div class="row">
                                                <div class="col-sm-12 mb-4">
                                                    <div class="mb-4 referees">
                                                        <h5 class="list-title"><strong>Referess</strong>
                                                        </h5>
                                                        <div class="row">
                                                            @for($i=0;$i< count($referees['name']); $i++)
                                                                <div class="col-md-6 col-sm-12">
                                                                    <h6><strong>Name:</strong> <span class="name" data-name="{{$referees['name'][$i]}}">{{$referees['name'][$i]}}</span></h6>
                                                                    <h6><strong>Position:</strong> <span  data-name="{{$referees['position'][$i]}}">{{$referees['position'][$i]}}</span></h6>
                                                                    <h6><strong>Company:</strong> {{$referees['company'][$i]}}</h6>
                                                                    <h6><strong>Phone:</strong> {{$referees['phone'][$i]}}</h6>
                                                                    <h6><strong>Email:</strong>  <span class="email" data-email="{{$referees['email'][$i]}}">{{$referees['email'][$i]}}</span></h6>
                                                                    @if (auth()->user()->id != $user->id)
                                                                        <a href="#" class="btn btn-primary m-auto d-block email-form my-2">Send Reference Check </a>
                                                                    @endif
                                                                </div>

                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if (auth()->user()->id != $user->id)
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
                                                                    <input type="hidden" name="subject" value="{{'Employee verification of '.$refereeData->applicant}}"/>
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
                                            @php
                                                }
                                            @endphp
                                        @endif

                                    </div>

                                </div>
                                <!--/.items-details-wrapper-->
                            </div>
                        </div>
                        <!--/.page-content-->


                    </div>

                </div>

            </div>
        </div>
    </div>

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
    <script src="{{ asset('assets/plugins/select2/css/select2.min.js') }}"></script>
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
            var position = "{{(!empty($refereeData)?$refereeData->job_title:'')}}";
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

            $(".email-form").on('click',function() {

                $("#modal-send-email .modal-title").html("Send Reference Check Email to "+ $(this).parent().find('span.name').data('name'));
                $("#ref-form").find("input[name='email']").val($(this).parent().find('span.email').data('email'));
                var temp = html_txt.replace(/\*Name\*/gi,$(this).parent().find('span.name').data('name'));
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
    <!--<script type="text/javascript" src="../../jqwidgets/jqxrating.js"></script>-->
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

