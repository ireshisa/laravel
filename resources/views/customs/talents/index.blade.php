<?php
$fullUrl = rawurldecode(url(request()->getRequestUri()));
$tmpExplode = explode('?', $fullUrl);
$fullUrlNoParams = current($tmpExplode);

$filters = [
    'salary_from',
    'salary_to',
    'age_from',
    'age_to',
    'gender',
    'experience',
    'sector_id',
    'qualifications',
    'skills',
    'city_id',
];

$experiences = [
    '6m' => '6 Months',
    '1y' => '1 Year',
    '2y' => '2 Years',
    '3y' => '3 Years',
    '4y' => '4 Years',
    '5y' => '5 Years',
    'None' => 'None',
];

?>
@extends('layouts.master')

{{--@section('search')--}}
{{--    @parent--}}
{{--    <div class="container bg-white body-content">--}}
{{--        <div style="background: #fff !important" class="search-row-wrapper">--}}
{{--            <div class="container">--}}
{{--                <form id="seach" name="search" action="/search-talent?{{httpBuildQuery(request()->all())}}"--}}
{{--                      method="GET">--}}

{{--                    @foreach($filters as $filter)--}}
{{--                        @if(request()->query($filter))--}}
{{--                            <input type="hidden" name="{{$filter}}" value="{{request()->query($filter)}}">--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

{{--                    <div class="row m-0">--}}
{{--                        <div class="col-xl-3 col-md-3 col-sm-12 col-xs-12">--}}
{{--                            <select name="sector_id" id="catSearch" class="form-control selecter">--}}
{{--                                <option value="">All Sectors</option>--}}
{{--                                @if (isset($cats) and $cats->count() > 0)--}}
{{--                                    @foreach ($cats->groupBy('parent_id')->get(0) as $itemCat)--}}
{{--                                        <option value="{{ $itemCat->tid }}" {{request()->sector_id == $itemCat->id ? 'selected' : ''}}> {{ $itemCat->name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-5 col-sm-12 col-xs-12 pr-2">--}}
{{--                            <input name="q" id="search" class="form-control keyword" type="text" value="{{request()->q}}"--}}
{{--                                   placeholder="Search by Name and Skills...">--}}
{{--                        </div>--}}

{{--                        <div class="col-md-5 col-sm-12 col-xs-12 search-col px-2 locationicon">--}}
{{--                            <i class="icon-location-2 icon-append"></i>--}}
{{--                            <input type="text" id="locSearch" name="location"--}}
{{--                                   class="form-control locinput input-rel searchtag-input has-icon tooltipHere"--}}
{{--                                   placeholder="{{ t('Where?') }}" value="{{request()->location}}" title=""--}}
{{--                                   data-placement="bottom">--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2 col-sm-12 col-xs-12">--}}
{{--                            <button style="border-color: #001289;background: #001289;"--}}
{{--                                    class="btn btn-block btn-primary find">--}}
{{--                                <i class="fa fa-search"></i> <strong>{{ t('Find') }}</strong>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        {!! csrf_field() !!}--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@section('content')
    <div class="main-container grey-background" style="padding-top: 60px">

        @include('search.inc.breadcrumbs')

        @include('common.spacer')

        <div class="container">

            <div class="row ">
                @if (Session::has('flash_notification'))
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                @include('flash::message')
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!--<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />-->
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

                /*.btn-primary {*/
                /*    background-color: #02979D;*/
                /*    border-color: #02979D;*/
                /*}*/
            </style>
            <div class="row">

                <!-- Sidebar -->

                <div class="col-md-3 pr-3 mr-5 ml-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap px-3"
                     id="filter-options">
{{--                    <div class="jobsearch-filter-responsive-wrap filter-panel">--}}
{{--                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">--}}
{{--                            <div class="jobsearch-fltbox-title filter-head ">--}}
{{--                                <div class="d-inline-block ">--}}
{{--                                    <h4>Posted</h4>--}}
{{--                                </div>--}}
{{--                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>--}}


{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="filter-content py-3">--}}


{{--                            <div class="form-check pl-0 mb-3" >--}}
{{--                                <input type="radio" name="date_posted" value="1h" class="form-check-input filled-in">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary">Last--}}
{{--                                    Hour</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check pl-0 mb-3" >--}}
{{--                                <input type="radio" name="date_posted" value="24h" class="form-check-input filled-in">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary">Last 24--}}
{{--                                    Hours</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check pl-0 mb-3" >--}}
{{--                                <input type="radio" name="date_posted" value="7d" class="form-check-input filled-in">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary">Last--}}
{{--                                    7 Days</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check pl-0 mb-3 pb-1" >--}}
{{--                                <input type="radio" name="date_posted" value="14d" class="form-check-input filled-in">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary">Last 14--}}
{{--                                    days</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check pl-0 mb-3 pb-1" >--}}
{{--                                <input type="radio" name="date_posted" value="30d" class="form-check-input filled-in">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary">Last 30--}}
{{--                                    days</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <div class="jobsearch-filter-responsive-wrap filter-panel">--}}
{{--                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">--}}
{{--                            <div class="jobsearch-fltbox-title filter-head ">--}}
{{--                                <div class="d-inline-block ">--}}
{{--                                    <h4>location</h4>--}}
{{--                                </div>--}}
{{--                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>--}}


{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="filter-content py-3">--}}

{{--                            @foreach($locations as $location)--}}
{{--                                @if(!empty($location->location))--}}
{{--                                <div class="form-check pl-0 mb-3" >--}}
{{--                                    <input type="radio" class="form-check-input filled-in" name="location" value="{{$location->location}}">--}}
{{--                                    <label class="form-check-label  text-capitalize card-link-secondary" >{{$location->location}}</label>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                            <div class="form-check pl-0 mb-3" >--}}
{{--                                <input type="radio" class="form-check-input filled-in" name="location" value="all">--}}
{{--                                <label class="form-check-label  text-capitalize card-link-secondary" >All</label>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Locations</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i>
                                </div>


                            </div>
                        </div>

                        <div class="py-3 filter-content px-2">
                            <div class="form-group">
                                <label>Province
                                </label>
                                <select class="form-control" name="province_search">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->code}}">{{$province->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>City
                                </label>
                                <select class="form-control" multiple="multiple" name="city_search">

                                </select>

                            </div>
                            <button type="button" class="btn find btn-block btn-primary m-auto"
                                    style="max-width: 200px">
                                Find
                            </button>
                        </div>
                    </div>


                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Age</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">


                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="18-22">
                                <label class="form-check-label small text-uppercase card-link-secondary" >18-22 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="23-27" >
                                <label class="form-check-label small text-uppercase card-link-secondary" >23-27 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="28-32">
                                <label class="form-check-label small text-uppercase card-link-secondary" >28-32 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="33-37">
                                <label class="form-check-label small text-uppercase card-link-secondary" >33-37 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="38-42">
                                <label class="form-check-label small text-uppercase card-link-secondary" >38-42 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age"value="43-47">
                                <label class="form-check-label small text-uppercase card-link-secondary" >43-47 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="age" value="48-52">
                                <label class="form-check-label small text-uppercase card-link-secondary" >48-52 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox"  class="form-check-input filled-in" name="age" value="53-57">
                                <label class="form-check-label small text-uppercase card-link-secondary" >53-57 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in"  name="age" value="57-200" >
                                <label class="form-check-label small text-uppercase card-link-secondary" >Above 57 Years</label>
                            </div>
                        </div>
                    </div>

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Job Type</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">

                            @foreach($post_types as $post_type)
                                <div class="form-check pl-0 mb-3" >
                                    <input type="checkbox" class="form-check-input filled-in" name="types" value="{{$post_type->id}}">
                                    <label class="form-check-label  text-capitalize card-link-secondary" >{{$post_type->name}}</label>
                                </div>
                            @endforeach
                            <div class="form-check pl-0 mb-3" >
                                <input type="radio" class="form-check-input filled-in" name="types" value="all">
                                <label class="form-check-label  text-capitalize card-link-secondary" >All</label>
                            </div>

                        </div>
                    </div>

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Categories</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">

                            @foreach($categories as $category)
                                <div class="form-check pl-0 mb-3" >
                                    <input type="checkbox" class="form-check-input filled-in" name="category_id" value="{{$category->id}}">
                                    <label class="form-check-label align-middle  text-truncate text-capitalize card-link-secondary" style="max-width: 90%" >{{$category->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Salary</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">

                            <p>
                                <label for="salary-amount">Salary range:</label>
                                <input type="text" id="salary-amount" readonly
                                       style="border:0; color:#f6931f; font-weight:bold;">
                                <input type="hidden" id="salary-filter" name="salary-amount" value="">
                            </p>

                            <div id="salary-range"></div>
                        </div>
                    </div>

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Experience</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">

                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="0">
                                <label class="form-check-label small text-uppercase card-link-secondary" >6 Months</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="1">
                                <label class="form-check-label small text-uppercase card-link-secondary" >1 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="2" >
                                <label class="form-check-label small text-uppercase card-link-secondary" >2 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="3">
                                <label class="form-check-label small text-uppercase card-link-secondary" >3 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="4">
                                <label class="form-check-label small text-uppercase card-link-secondary" >4 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience" value="5">
                                <label class="form-check-label small text-uppercase card-link-secondary" >5 Years</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience"value="6">
                                <label class="form-check-label small text-uppercase card-link-secondary" >More than 5 Years</label>
                            </div>

                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="experience"value="7">
                                <label class="form-check-label small text-uppercase card-link-secondary" >None</label>
                            </div>

                        </div>
                    </div>

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Qualifications</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">

                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="qualifications" value="Certificate">
                                <label class="form-check-label small text-uppercase card-link-secondary" >Certificate</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="qualifications" value="Bachelors">
                                <label class="form-check-label small text-uppercase card-link-secondary" >Bachelors</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="qualifications" value="Masters" >
                                <label class="form-check-label small text-uppercase card-link-secondary" >Masters</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="qualifications" value="Phd">
                                <label class="form-check-label small text-uppercase card-link-secondary" >Phd</label>
                            </div>

                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="qualifications" value="None">
                                <label class="form-check-label small text-uppercase card-link-secondary" >None</label>
                            </div>




{{--                            <div class="form-check pl-0 mb-3" >--}}
{{--                                <input type="radio" class="form-check-input filled-in" name="qualifications" value="all">--}}
{{--                                <label class="form-check-label small text-uppercase card-link-secondary" >All</label>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="jobsearch-filter-responsive-wrap filter-panel">
                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                            <div class="jobsearch-fltbox-title filter-head ">
                                <div class="d-inline-block ">
                                    <h4>Gender</h4>
                                </div>
                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                            </div>
                        </div>

                        <div class="filter-content py-3">


                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="gender" value="male" >
                                <label class="form-check-label small text-uppercase card-link-secondary"
                                       >Male</label>
                            </div>
                            <div class="form-check pl-0 mb-3" >
                                <input type="checkbox" class="form-check-input filled-in" name="gender" value="female">
                                <label class="form-check-label small text-uppercase card-link-secondary"  >Female</label>
                            </div>

                        </div>
                    </div>

                    <a  class="btn find btn-block btn-primary m-auto" href="{{ url('search-talent') }}"
                       style="max-width: 200px">
                        Reset
                    </a>
                   <br> 
                  <div   value="aasda" class="btn btn-block btn-danger m-auto closebuttone btnmf-none"" onclick="cloce()" style="max-width: 200px">
                        close
                    </div>


{{--                    <div class="jobsearch-filter-responsive-wrap">--}}
{{--                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">--}}
{{--                            <div class="jobsearch-fltbox-title px-3">--}}

{{--                                <a href="/search-talent" class="btn btn- btn-sm btn-block reset-button"--}}
{{--                                   style="background-color: #03989e">Reset filters</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {{-- <form action="/search-talent?{{httpBuildQuery(request()->all())}}" id="filter-form" style="padding:0;">
                        <input type="hidden" name="q" value="{{request()->q}}">
                        <input type="hidden" name="location" value="{{request()->location}}">
                        <input type="hidden" name="sector_id" value="{{request()->sector_id}}">
                        <div class="jobsearch-filter-responsive-wrap">
                            <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                <div class="jobsearch-fltbox-title">
                                     <a href="#MyClassified" data-toggle="collapse" class="pull-right">Salary <i class="fa fa-angle-down"></i></a>
                                </div>
                                <div class="panel-collapse collapse  jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified">
                                    <div class="filter-date filter-content">
                                        <div style="display: flex; justify-content: space-between; align-items:center;">
                                            <input type="number" step="1" min="10000" name="salary_from" value="{{request()->salary_from}}" class="form-control" style="margin-right: 10px;">
                                            <input type="number" step="1" min="10000" name="salary_to" value="{{request()->salary_to}}" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block mt-2">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobsearch-filter-responsive-wrap">
                            <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                <div class="jobsearch-fltbox-title">
                                     <a href="#MyClassified1" data-toggle="collapse" class="pull-right">age <i class="fa fa-angle-down"></i></a>
                                </div>
                                <div class="panel-collapse collapse jobsearch-checkbox-toggle jobsearch-remove-padding jobsearch-remove-padding" id="MyClassified1">
                                    <div class="filter-date filter-content">
                                        <div style="display: flex; justify-content: space-between; align-items:center;">
                                            <input type="number" step="1" min="18" name="age_from" value="{{request()->age_from}}" class="form-control" style="margin-right: 10px;">
                                            <input type="number" step="1" min="18" name="age_to" value="{{request()->age_to}}" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block mt-2">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobsearch-filter-responsive-wrap">
                            <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                <div class="jobsearch-fltbox-title">
                                     <a href="#MyClassified2" data-toggle="collapse" class="pull-right">Gender <i class="fa fa-angle-down"></i></a>
                                </div>
                                <div class="panel-collapse collapse jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified2">
                                    <div class="filter-date filter-content">
                                       <ul id="blocPostType" class="browse-list list-unstyled">
                                            <li>
                                                <input type="radio" name="gender" id="employment_1" value="" class="emp emp-type">
                                                <label for="employment_1">All</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="gender" id="employment_2" {{request()->input("gender") == 'male' ? 'checked' : ''}} value="male" class="emp emp-type">
                                                <label for="employment_2">Male</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="gender" id="employment_3" {{request()->input("gender") == 'female' ? 'checked' : ''}} value="female" class="emp emp-type">
                                                <label for="employment_3">Female</label>
                                            </li>
                                        </ul>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block mt-2">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobsearch-filter-responsive-wrap">
                            <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                <div class="jobsearch-fltbox-title">
                                     <a href="#MyClassified3" data-toggle="collapse" class="pull-right">Experience <i class="fa fa-angle-down"></i></a>
                                </div>
                                <div class="panel-collapse collapse  jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified3">
                                    <div class="filter-date filter-content">
                                        <div style="display: flex; justify-content: space-between; align-items:center;">
                                            <select name="experience" id="" class="form-control">
                                                <option value=""></option>
                                                <option value="6m" {{ request()->experience == '6m' ? 'selected' : ''}}>6 Months</option>
                                                <option value="1y" {{ request()->experience == '1y' ? 'selected' : ''}}>1 Year</option>
                                                <option value="2y" {{ request()->experience == '2y' ? 'selected' : ''}}>2 Year</option>
                                                <option value="3y" {{ request()->experience == '3y' ? 'selected' : ''}}>3 Year</option>
                                                <option value="4y" {{ request()->experience == '4y' ? 'selected' : ''}}>4 Year</option>
                                                <option value="5y" {{ request()->experience == '5y' ? 'selected' : ''}}>5 Year</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block mt-2">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}


                </div>


                <!-- Content -->



                <div class="col-md-8 page-content d-flex align-self-stretch col-thin-left jobsearch-typo-wrap search-talent pnonemobile" id="filter-content" style="padding-left: 25px">
                    <div class="row w-100">
                        
                          <div class="col-md-12">
                                                     <center>
                                                         <button type="button" class="btn btn-primary btn-block btnmf-none"  onclick="showfilter()" ><i class="fa fa-search mr-1"></i> Filter</button>
     
 </center>
                              <br><br>
                              </div>
                              
                             
  
                        <div class="col-md-12 pnonemobile">
                            <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">
                                <div class="sortfiltrs-contner">
                                    <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                                        <h2 class="jobsearch-fltcount-title color-black">
                                            {{ $users->total() }}&nbsp;Candidates Found

                                        </h2>
                                    </div>
                                </div>
                            </div>

                            <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content pnonemobile">

                                @foreach($users as $user)
                                    <div class="row person-info " style="margin-bottom: 45px">
                                        <div class="col-md-12 py-3 d-flex">

                                            {{-- <img src="http://placehold.it/300x200" alt="" class="img-rounded img-fluid" /> --}}

                                            {{-- <a href="search-talent/seeker/{{$user->id}}"> --}}
                                            <div class="d-inline-flex  align-items-center justify-content-center">
                            
                                                <!--<a href="search-talent/seeker/{{$user->id}}">-->
                                                <!--    <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}"-->
                                                <!--         class="img-rounded" alt="">-->
                                                <!--</a>-->
                                                <a href="search-talent/seeker/{{$user->id}}">
                                                    @if (in_array($user->id,$connected))
                                                <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}"
                                                         class="img-rounded" alt="">
                                                @else
                                                 <img src="{{ url('images/user.jpg')  }}"
                                                         class="img-rounded" alt="">
                                                @endif
                                                   
                                                </a>

                                            </div>
                                            <div class="d-inline-flex align-items-center flex-grow-1">
                                                <div class="w-100 d-flex flex-row-reverse">
                                                    <div class="d-inline-flex flex-shrink-0">
                                                        <div role="group" aria-label="Basic mixed styles example"
                                                             class="px-2">
                                                        @if(auth()->check() && auth()->user()->user_type_id == 1)
                                                             @if(!in_array($user->id,$saved))
                                                            <button type="button "
                                                                    style="background-color: #03989e; margin-right: 10px"
                                                                    class="btn btn-block side-button black-btn candidate_id " data-candidateid="{{$user->id}}"><i class="fa fa-save mr-2"></i> Save Candidate
                                                            </button>
                                                             @else
                                                                    <button type="button "
                                                                            style="background-color: #03989e; margin-right: 10px"
                                                                            class="btn btn-block side-button black-btn delete_candidate " data-candidateid="{{$user->id}}"><i class="fa fa-trash mr-2"></i> Unsave Candidate
                                                                    </button>
                                                            @endif
                                                        @endif
{{--                                                            <button type="button" class="btn btn-block side-button"--}}
{{--                                                                    style="background-color: #ECB338">--}}
{{--                                                                Add--}}
{{--                                                                Wishlist--}}
{{--                                                            </button>--}}
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-flex flex-grow-1 px-2">
                                                        <div class="d-block">
                                                            <h2 class="jobsearch-pst-title">
                                                                
                                                                    <a href="search-talent/seeker/{{$user->id}}">{{ $user->firstname}}</a>
                                                                
                                                                <i class="jobsearch-icon jobsearch-check-mark"
                                                                   style="color: #40d184;"></i>
                                                            </h2>
                                                            <div class="d-block">
                                                                <ul class="person-details">
                                                                    @if(!empty($user->skills))
                                                                        <li><a
                                                                                    class="">
                                                                                {{$user->skills}}                </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(!empty($user->city_id))
                                                                        <li>
                                                                            <i class="fa fa-map-marker"></i> @if($user->city_id){{$user->city->name}}@endif
                                                                        </li>
                                                                    @endif
                                                                    @if(!empty($user->sector))
                                                                        <li class="text-truncate"><i
                                                                                    class="fa fa-filter"></i>
                                                                                    <?php 
                                                                                    $cat=$user->sector ? $user->sector->name : '';
                                                                                    
                                                                                    echo (substr($cat, 0, 20)."..");
                                                                                    
                                                                                    
                                                                                    ?>
                                                                        </li>
                                                                    @endif
                                                                    @if (!empty($user->endorsements->count()))
                                                                        <div class="text-truncate d-block">
                                                                            {{($user->endorsements->count())}} Endorsements

                                                                        </div>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                           <div class="review mt-2" data-rating="{{ $user->getAverageReviewRate() }}">
                                                                <div class="review-stars">
                                                                    <div class='rating-stars list-rating text-center'>
                                                                        <ul style="display: flex">
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

                                                            {{--                                        <a href="javascript:void(0);"--}}
                                                            {{--                                           class="jobsearch-candidate-default-btn jobsearch-open-signin-tab candidate_id"--}}
                                                            {{--                                           data-candidateId="{{$user->id??''}}" style="margin-right: 10px">--}}
                                                            {{--                                            <i class="jobsearch-icon jobsearch-add-list"></i> Save Candidate </a>--}}

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                @endforeach
                            </div>


                            {{-- <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content"style="margin-top: 10px">
                                <div class="well well-sm border border-info">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-6 col-lg-4">
                                            <img src="http://placehold.it/300x200" alt="" class="img-rounded img-fluid" />
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-5">
                                            <h4>Abraham Lincoln</h4>
                                            <small><cite title="San Diego, USA">San Diego, USA <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                                            <p>
                                                <i class="glyphicon glyphicon-envelope"></i>lorem@random.net
                                                <br />
                                                <i class="glyphicon glyphicon-globe"></i><a href="https://www.prepbootstrap.com">www.prepbootstrap.com</a>
                                                <br />
                                                <i class="glyphicon glyphicon-gift"></i>January 19, 1993
                                            </p>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" style="background-color: #03989e; margin-right: 10px" class="btn btn-">Save Candidate</button>
                                                <button type="button" class="btn btn-" style="background-color: #ECB338">Add Wishlist</button>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <style>
                                .wrap {
                                    padding-top: 30px;
                                }

                                .glyphicon {
                                    margin-bottom: 10px;
                                    margin-right: 10px;
                                }

                                small {
                                    display: block;
                                    color: #888;
                                }

                                /* .well
                                {
                                    border: 1px solid blue;
                                } */
                            </style>
                            {{-- <div class="sortfiltrs-contner">
                                <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                                    <h2 class="jobsearch-fltcount-title">
                                        {{ $users->total() }}&nbsp;Candidates Found

                                    </h2>
                                </div>
                            </div> --}}
                            <div class="mt-2">
                                <nav class="" aria-label="">
                                    {{ (isset($users)) ? $users->links() : '' }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
{{--             </div>--}}
            {{-- <div class="col-md-9 page-content col-thin-left jobsearch-typo-wrap"> --}}
            {{-- <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">
                <div class="sortfiltrs-contner">
                    <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                        <h2 class="jobsearch-fltcount-title">
                            {{ $users->total() }}&nbsp;Candidates Found

                        </h2>
                    </div>
                </div>
            </div>
            <div class="jobsearch-candidate jobsearch-candidate-default">
                <ul class="jobsearch-row">
                    @foreach($users as $user)
                    <li class="jobsearch-column-12">
                        <div class="jobsearch-candidate-default-wrap">

                            <figure>
                                <a href="search-talent/seeker/{{$user->id}}">
                                <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}" alt="">
                            </a>
                            </figure>
                            <div class="jobsearch-candidate-default-text">
                            <div class="jobsearch-candidate-default-left">
                                <h2 class="jobsearch-pst-title">
                                    <a href="search-talent/seeker/{{$user->id}}">{{explode(' ',$user->name)[0] ?? $user->name}}</a>
                                    <i class="jobsearch-icon jobsearch-check-mark" style="color: #40d184;"></i>
                                </h2>
                                <ul>
                                    <li>{{$user->sector ? $user->sector->name : ''}}</li>
                                    <li>
                                        <i class="fa fa-map-marker"></i> @if($user->location){{$user->location}}@endif
                                    </li>
                                    <li><i class="jobsearch-icon jobsearch-filter-tool-black-shape"></i>                <a class="">
                                    {{$user->skills}}                </a>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" class="jobsearch-candidate-default-btn jobsearch-open-signin-tab candidate_id" data-candidateId="{{$user->id??''}}"><i class="jobsearch-icon jobsearch-add-list"></i> Save Candidate            </a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="category-list hide" >
                <div class="tab-box clearfix"> --}}

            <!-- Nav tabs -->
            {{-- <div class="col-xl-12 box-title no-border">
                <div class="inner">
                    <h2>
                        <small>{{ $users->total() }} Job seekers found</small>
                    </h2>
                </div>
            </div>
        </div>

   

        <div class="mt-4">{{$users->links()}}</div>

        </div>

        <div style="clear:both;"></div> --}}

            <!-- Advertising -->
                @include('layouts.inc.advertising.bottom')

            </div>

        </div>
    </div>
@endsection

@section('modal_location')
    @parent
    @include('layouts.inc.modal.location')
@endsection
@section('after_styles')
    <link href="{{asset('assets/plugins/icheck/skins/futurico/futurico.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

@endsection
@section('after_scripts')



   <script>
       
       function cloce()
       {
            var element=document.getElementById("filter-options");
            element.style.display = "none";
       }
             function showfilter()
       {
            var element=document.getElementById("filter-options");
            element.style.display = "block";
       }
       
   </script>




    <script src="{{asset('assets/plugins/icheck/icheck.js')}}"></script>
{{--    <script src="{{asset('assets/plugins/jqueryui/1.11.3/jquery-ui.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/formsubmit.js')}}"></script>
    <script>
        $("input[type='checkbox'],input[type='radio']").iCheck({checkboxClass: 'icheckbox_futurico',radioClass: 'icheckbox_futurico'});
        // const queryString = window.location.search;
        //
        // const urlParams = new URLSearchParams(queryString);
        // for (p of urlParams)
        // {
        //     var qName = p[0];
        //     if(p[0]!= "q" && p[0] != "location")
        //     {
        //
        //         if (p[1].includes(','))
        //         {
        //
        //             var arr = p[1].split(',');
        //             arr.forEach(function(value,index) {
        //
        //                 $('input[name='+qName+'][value='+value+']').iCheck('check');
        //             })
        //         }
        //         else {
        //             $('input[name='+qName+'][value='+p[1]+']').iCheck('check');
        //
        //         }
        //     }
        //
        // }
        //
        // $(".find").on('click',function () {
        //     var searchStr = window.location.search;
        //     var searchParams = new URLSearchParams(searchStr);
        //     searchParams.delete("q");
        //     searchParams.delete("location");
        //     if (searchStr != '' || searchStr != null)
        //     {
        //
        //
        //         var searchVal  = 0;
        //         if ($("#search").val() != null && $("#search").val() != '')
        //         {
        //             searchParams.append('q',$("#search").val())
        //             searchVal = 1;
        //
        //         }
        //         if ($("#locSearch").val() != null && $("#locSearch").val() != '')
        //         {
        //             searchParams.append('location',$("#locSearch").val());
        //             console.log("l");
        //            // (searchVal == 0)?"?location="+$("#locSearch").val():"&location="+$("#locSearch").val();
        //
        //         }
        //         // $(this).attr('href',searchStr);
        //     }
        //
        //     window.history.pushState("object or string", "Title", '?'+searchParams.toString());
        //      location.reload();
        // })


        $(".filter-head").on('click', function () {
            $(this).closest('.filter-panel').find('.filter-content').toggle('slow');
        });
        $(".filter-panel:nth-child(3) .filter-content").slideUp();
        $(".filter-panel:nth-child(4) .filter-content").slideUp();
        $(".filter-panel:nth-child(5) .filter-content").slideUp();
        $(".filter-panel:nth-child(6) .filter-content").slideUp();
        $("input[type='checkbox']").on('ifToggled', function (e) {
            e.preventDefault();
            var qString = generateQueryString();

            applySearchFilters(qString);
        });

        $("input[type='radio']").on('ifChecked', function (e) {


            var qString = generateQueryString();
            if (qString != null && qString != '')
            {
                applySearchFilters(qString);
            }


        });

        $("select[name='province']").on('change',function () {
            console.log("changed");
             var qString = generateQueryString();
             console.log(qString);
            if (qString != null && qString != '')
            {
                applySearchFilters(qString);
            }
        })

        $(".filter-content").each(function () {
            $(this).find('.form-check').each(function (index,value) {
                if (index >= 10)
                {
                    $(this).hide();
                }
            })

        });
        $(".filter-content").each(function () {
            if ($(this).children().length > 10)
            {
                $(this).append('<a class="expand"><i class="fa fa-plus"></i> Show More </a>');
                $(this).append('<a class="collapse"><i class="fa fa-minus"></i> Show Less </a>');
                $(this).find(".collapse").hide();
            }
        })

        $("body").on('click','.expand',function() {
            $(this).parent().find('.form-check').show();
            $(this).hide();
            $(this).parent().find(".collapse").show();
        });
        $("body").on('click','.collapse',function() {
            $(this).parent().find('.form-check').each(function (index,value) {
                if (index < 10)
                {
                    $(this).show();


                }
                else
                {
                    $(this).hide();
                }
            });

            $(this).hide();
            $(this).parent().find(".expand").show();
        })

        function generateQueryString() {
            var str = "";
            var field_name = '';
            var counter = 0;
            $("#filter-options input[type='checkbox']:checked,#filter-options input[type='radio']:checked").each(function () {

                if (field_name == "")
                {
                    field_name = $(this).attr('name');
                    str +="?"+field_name+'=';
                }
                else if ($(this).attr('name') != field_name)
                {
                    field_name = $(this).attr('name');
                    str += "&"+field_name+"=";
                    counter = 0;
                }

                str +=  ((counter > 0)?','+$(this).val():$(this).val());

                counter++;
            });
            var loc = "";
            //console.log($("select[name='province_search']").val());
            if ($("select[name='province_search']").val() != "") {
                if (str != "")
                {
                    str+="&";
                }
                else {
                    str+="?";
                }
                //$("select[name='province']").trigger('change');
                loc +="province="+$("select[name='province_search']").val();

                if ($("select[name='city_search']").val() != null)
                {
                    loc+="&city=";
                    $("select[name='city_search']").select2('data').forEach(function(item,index) {
                        loc += item.id+",";

                    });
                    loc= loc.substring(0,loc.length-1);
                }
                str +=loc;
            }



            window.history.pushState("object or string", "Title", str);
            return str;
        }


        function applySearchFilters(qStr) {

            $("#filter-content").html("<div class='d-flex align-self-stretch align-items-center w-100 justify-content-center'>" +
                "<div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>" +
                "</div>");
            getData("{{url('/search-talent-filter')}}"+qStr).then((res)=> {

                $("#filter-content").html(res);
            },(res)=> {
                console.log(res);
            })
        }


        $("#salary-range").slider({
            range: true,
            min: 0,
            max: 500000,
            values: [0, 200000],
            slide: function (event, ui) {
                $("#salary-amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#salary-filter").val(ui.values[0] + " - " + ui.values[1]);
                var qString = generateQueryString();
                applySearchFilters(qString);
            }
        });
        // $("#salary-amount").val($("#salary-range").slider("values", 0) +
        //     " - " + $("#salary-range").slider("values", 1));
        $('.candidate_id').click(function () {
            let candidateId = $(this).attr('data-candidateid');
            // alert(candidateId);
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


        $('.delete_candidate').click(function () {
            let candidateId = $(this).data('candidateid');
            // alert(candidateId);
            $.ajax({
                url: "{{route('delete.candidate')}}",
                type: 'post',
                data: {
                    candidateId: candidateId,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {


                        alert(data.message);


                }
            })

        });


        $(document).ready(function () {

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            console.log(urlParams);
            for (p of urlParams) {
                var qName = p[0];

                if (p[0] != "province" && p[0] != "city") {
                    if (p[1].includes(","))
                    {
                        var splitP1 = p[1].split(",");
                        splitP1.forEach(function(item,index) {
                            $('input[name='+qName+'][value='+item+']').iCheck('check');
                        })

                    }
                    else {
                        $('input[name='+qName+'][value='+p[1]+']').iCheck('check');
                    }

                } else {

                    if (p[0] == 'province') {
                        $("select[name='province_search']").val(p[1]);

                    } else if (p[0] == 'city') {
                        if (urlParams.get('province') != null && urlParams.get('province') != '') {
                            $("select[name='city_search'] option").remove();
                            getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
                                // console.log(res[0]);
                                res.forEach(function (value, index) {
                                    $("select[name='city_search']").append(new Option(value.text, value.id, false, false));
                                    // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                                });

                                var splited = p[1].split(',');
                                $("select[name='city_search']").val(splited).trigger("change");

                            }, (res) => {

                            })

                        }
                    }


                }

            }

            $('#postType a').click(function (e) {
                e.preventDefault();
                var goToUrl = $(this).attr('href');
                redirect(goToUrl);
            });
            $('#orderBy').change(function () {
                var goToUrl = $(this).val();
                redirect(goToUrl);
            });

            $("input[type='radio']").iCheck({checkboxClass: 'icheckbox_futurico', radioClass: 'icheckbox_futurico'});
            $("select[name='city']").select2({
                placeholder: "Select City/Cities",
                allowClear: true
            });


        });

        $("select[name='city_search']").select2({
            placeholder: "Select City/Cities",
            allowClear: true
        });


        $(".find").on('click', function () {
            var qs = generateQueryString();
            applySearchFilters(qs);
        })



        $("select[name='province_search']").on('change', function () {
            var html = "";
            $("select[name='city_search'] option").remove();
            getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
                // console.log(res[0]);
                res.forEach(function (value, index) {
                    $("select[name='city_search']").append(new Option(value.text, value.id, false, false)).trigger('change');
                    // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                });
                $("select[name='city_search']").append(html);
            }, (res) => {

            })
        })
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

@endsection