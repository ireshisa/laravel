{{--
//
--}}
@extends('layouts.master')

@section('content')
@include('common.spacer')
<div class="main-container">
    <div class="container">
        <div class="row">


  

            @if (Session::has('flash_notification'))
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        @include('flash::message')
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-3 page-sidebar">
                @include('account.inc.sidebar')
            </div>
            <!--/.page-sidebar-->

            
            <!--<div class="col-md-9 page-content mt-5" >-->
            <!--<div><img src="{{url('images/comingsoon.png')}}" alt=""></div>-->
            <!--</div>-->

            

            <div class="col-md-9 page-content" >
                <div class="inner-box">
                    <h2 class="title-2">
                        <i class="icon-star"></i> {{ 'Job Alerts' }}
                    </h2>
                    <p class="mb-4">You Can create alerts for your preferred job in <a href="{{url('/latest-jobs')}}" class="font-weight-bold">Search Jobs</a> page. Once you have created it will be shown here.</p>
                    <div id="reloadBtn" class="mb30" style="display: none;">
                        <a href="" class="btn btn-primary" class="tooltipHere" title="" data-placement="{{ (config('lang.direction')=='rtl') ? 'left' : 'right' }}"
                           data-toggle="tooltip"
                           data-original-title="{{ t('Reload to see New Messages') }}"><i class="icon-arrows-cw"></i> {{ t('Reload') }}</a>
                        <br><br>
                    </div>

                    <div style="clear:both"></div>

                    <div class="table-responsive">
                        <form name="listForm" method="POST" action="{{ lurl('job-alerts') }}">
                            {!! csrf_field() !!}
                            <div class="table-action">
                                <label for="checkAll">
                                    <input type="checkbox" id="checkAll">
                                    {{ t('Select') }}: {{ t('All') }} |
                                    <button type="submit" class="btn btn-sm btn-default delete-action">
                                        <i class="fa fa-trash"></i> {{ t('Delete') }}
                                    </button>
                                </label>
                                <div class="table-search pull-right col-sm-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-5 control-label text-right">{{ t('Search') }} <br>
                                                <a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
                                            </label>
                                            <div class="col-sm-7 searchpan">
                                                <input type="text" class="form-control" id="filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                    <tr>
                                        <th style="width:2%" data-type="numeric" data-sort-initial="true"></th>
                                        <th style="width:88%" data-sort-ignore="true">{{ ('Reviews') }}</th>
                                        <th style="width:10%">{{ t('Option') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($alerts) && $alerts->count() > 0):
                                        foreach ($alerts as $key => $alert):
                                            ?>
                                            <tr>
                                                <td class="add-img-selector">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="entries[]" value="{{ $alert->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="word-break:break-all;">
                                                        <strong>Created at:</strong>
                                                        {{ $alert->created_at->formatLocalized(config('settings.app.default_datetime_format')) }}                                                        
                                                        <br>
                                                        <strong>Alert name:</strong>&nbsp;{{ $alert->name }} &nbsp;
                                                        <strong>Email at:</strong>&nbsp;{{ $alert->email }}<br>
                                                        @if($alert->period)
                                                        <span class="badge badge-primary">{{ $alert->period }}</span>
                                                        @endif
                                                        @if($alert->postedDate)
                                                        <span class="badge badge-primary mt-2">{{ $alert->postedDate-1 }} Days</span>
                                                        @endif
                                                        @if($alert->jobtypes)
                                                        @foreach(json_decode($alert->jobtypes) as $jobType)
                                                        <span class="badge badge-primary mt-2">{{ $jobType }}</span>
                                                        @endforeach
                                                        @endif
                                                        @if($alert->minSalary)
                                                        <span class="badge badge-primary mt-2">Salary Min: {{ $alert->minSalary }}</span>
                                                        @endif
                                                        @if($alert->maxSalary)
                                                        <span class="badge badge-primary mt-2">Salary Max: {{ $alert->maxSalary }}</span>
                                                        @endif
                                                        @if($alert->city_id)
                                                        <span class="badge badge-primary mt-2">{{ $alert->city->name }}</span>
                                                        @endif
                                                        @if($alert->category_id)
                                                        <span class="badge badge-primary mt-2">{{ $alert->category->name }}</span>
                                                        @endif
                                                        @if($alert->types)
                                                            <span class="badge badge-primary mt-2">{{ $alert->types }} Type</span>
                                                        @endif
                                                        @if($alert->categories)
                                                            <span class="badge badge-primary mt-2">{{ $alert->categories }} Sector</span>
                                                        @endif
                                                        @if($alert->age)
                                                            <span class="badge badge-primary mt-2">{{ $alert->age }} Age Range</span>
                                                        @endif
                                                        @if($alert->salary)
                                                            <span class="badge badge-primary mt-2">{{ $alert->salary }} LKR</span>
                                                        @endif
                                                        @if($alert->experience)
                                                            <span class="badge badge-primary mt-2">{{ $alert->experience }} Experience</span>
                                                        @endif
                                                        @if($alert->qualifications)
                                                            <span class="badge badge-primary mt-2">{{ $alert->qualifications }} Qualifications</span>
                                                        @endif
                                                        @if($alert->gender)
                                                            <span class="badge badge-primary mt-2">{{ $alert->genderID->name }} Gender</span>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td class="action-td">
                                                    <div>
{{--                                                        <p>--}}
{{--                                                            <a class="btn btn-default btn-sm" href="{{ $alert->url }}">--}}
{{--                                                                <i class="icon-eye"></i> {{ t('View') }}--}}
{{--                                                            </a>--}}
{{--                                                            --}}
{{--                                                        </p>--}}
                                                        <p class="text-center">
{{--                                                            <a class="btn btn-secondary btn-sm" href="{{ url('/latest-jobs/?alert-id='.$alert->id)}}">--}}
{{--                                                                <i class="fa fa-edit"></i> {{ t('Edit') }}--}}
{{--                                                            </a>--}}
                                                            <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#editjobalert-{{$alert->id}}" >
                                                                <i class="fa fa-edit"></i> {{ t('Edit') }}
                                                            </a>

                                                        </p>
                                                        <p class="text-center">
                                                            <a class="btn btn-danger btn-sm" href="{{ url('/account/alerts/'.$alert->id.'/delete')}}">
                                                                <i class="icon-trash"></i> {{ t('Delete') }}
                                                            </a>

                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                    <div class="modal fade" id="editjobalert-{{$alert->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Update job alert</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="color-black text-uppercase">E-mail me new jobs</h3>
                                                    <!--<p class="text-muted">*Use the filters on the left and create email alerts when matched jobs are posted </p>-->
                                                </div>

                                                <form method="POST" action="{{url('/job-alerts/')}}" id="create-alert-form" class="w-100">
                                                    <div class="d-flex flex-grow-1 px-4">
                                                        <div class="d-block w-100">
                                                            {{ csrf_field() }}
                                                            @if(isset($alert->id))
                                                                <input type="hidden" name="alert_id" value="{{$alert->id}}"/>
                                                            @endif
                                                            <div class="form-group">
                                                                <?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
                                                                <input type="text" class="form-control {{ $nameError }}" name="name"  value="{{$alert->name ?? ''}}" placeholder="Job Alert Name"/>


                                                            </div>
                                                            <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control {{ $emailError }}" name="email" value="{{$alert->email ?? ''}}" placeholder="Email Address"/>

                                                            </div>
                                                            <div class="row d-none">
                                                                <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                                                    <div class="d-flex  flex-wrap justify-content-around align-items-center align-self-center flex-grow-1">
                                                                        <div class="d-flex align-self-center align-items-center">
                                                                            <input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Daily" {{((isset($alert->period) && $alert->period=="Daily")?"checked":"")}}><label class="d-flex  mb-0 ml-2">Daily</label>
                                                                        </div>
                                                                        <div class="d-flex align-self-center align-items-center">
                                                                            <input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Weekly" {{((isset($alert->period) && $alert->period=="Weekly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Weekly</label>
                                                                        </div>
                                                                        <div class="d-flex align-self-center align-items-center">
                                                                            <input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Monthly" {{((isset($alert->period) && $alert->period=="Monthly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Monthly</label>
                                                                        </div>
                                                                        <div class="d-flex align-self-center align-items-center">
                                                                            <input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Annually" {{((isset($alert->period) && $alert->period=="Annually")?"checked":"")}}><label class="d-flex mb-0 ml-2">Annually</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Job Type</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="types">
                                                                                <option name="types"></option>
                                                                                @if($alert->types )
                                                                                    <option value="{{$alert->types }}" {{((isset($alert->types)) ? 'selected' : '')}}>{{$alert->types}}</option>
                                                                                @endif
                                                                                @foreach($post_types as $post_type)
                                                                                        <option value="{{$post_type->name}}">{{$post_type->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Categories</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="categories" >
                                                                                <option name="categories"></option>
                                                                                @if($alert->categories)
                                                                                <option value="{{$alert->categories}}" {{((isset($alert->categories)) ? 'selected' : '')}}>{{$alert->categories}}</option>
                                                                                @endif
                                                                                @foreach($categories as $category)
                                                                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Age</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="age">
                                                                                <option name="age" ></option>
                                                                                <option name="age" value="18-22" {{((isset($alert->age) && ($alert->age == '18-22')) ? 'selected' : '')}}>18-22 Years</option>
                                                                                <option name="age" value="23-27" {{((isset($alert->age) && ($alert->age == '23-27')) ? 'selected' : '')}}>23-27 Years</option>
                                                                                <option name="age" value="28-32" {{((isset($alert->age) && ($alert->age == '28-32')) ? 'selected' : '')}}>28-32 Years</option>
                                                                                <option name="age" value="33-37" {{((isset($alert->age) && ($alert->age == '33-37')) ? 'selected' : '')}}>33-37 Years</option>
                                                                                <option name="age" value="38-42" {{((isset($alert->age) && ($alert->age == '38-42')) ? 'selected' : '')}}>38-42 Years</option>
                                                                                <option name="age" value="43-47" {{((isset($alert->age) && ($alert->age == '43-47')) ? 'selected' : '')}}>43-47 Years</option>
                                                                                <option name="age" value="48-52" {{((isset($alert->age) && ($alert->age == '48-52')) ? 'selected' : '')}}>48-52 Years</option>
                                                                                <option name="age" value="53-57" {{((isset($alert->age) && ($alert->age == '53-57')) ? 'selected' : '')}}>53-57 Years</option>
                                                                                <option name="age" value="Above 57 Years" {{((isset($alert->age) && ($alert->age == 'Above 57 Years')) ? 'selected' : '')}}>Above 57 Years</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Salary Range</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="salary">
                                                                                <option name="salary"></option>
                                                                                <option name="salary" value="500-1000" {{((isset($alert->salary) && ($alert->salary == '500-1000')) ? 'selected' : '')}}>500LKR - 1000LKR</option>
                                                                                <option name="salary" value="1000-5000" {{((isset($alert->salary) && ($alert->salary == '1000-5000')) ? 'selected' : '')}}>1000LKR - 5000LKR</option>
                                                                                <option name="salary" value="5000-10000" {{((isset($alert->salary) && ($alert->salary == '5000-10000')) ? 'selected' : '')}}>5000LKR - 10,000LKR</option>
                                                                                <option name="salary" value="10000-20000" {{((isset($alert->salary) && ($alert->salary == '10000-20000')) ? 'selected' : '')}}>10,000LKR - 20,000LKR</option>
                                                                                <option name="salary" value="20000-30000" {{((isset($alert->salary) && ($alert->salary == '20000-30000')) ? 'selected' : '')}}>20,000LKR - 30,000LKR</option>
                                                                                <option name="salary" value="30000-50000" {{((isset($alert->salary) && ($alert->salary == '30000-50000')) ? 'selected' : '')}}>30,000LKR - 50,000LKR</option>
                                                                                <option name="salary" value="50000-100000" {{((isset($alert->salary) && ($alert->salary == '50000-100000')) ? 'selected' : '')}}>50,000LKR - 100,000LKR</option>
                                                                                <option name="salary" value="> 100000" {{((isset($alert->salary) && ($alert->salary == '> 100000')) ? 'selected' : '')}}>> 100,000LKR</option>
                                                                                <option name="salary" value="all" {{((isset($alert->salary) && ($alert->salary == 'all')) ? 'selected' : '')}}>All</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Experience</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="experience" >
                                                                                <option name="experience"></option>
                                                                                <option name="experience" value="6 months" {{((isset($alert->experience) && ($alert->experience == '6 months')) ? 'selected' : '')}}>6 Months</option>
                                                                                <option name="experience" value="1 years" {{((isset($alert->experience) && ($alert->experience == '1 years')) ? 'selected' : '')}}>1 Years</option>
                                                                                <option name="experience" value="2 years" {{((isset($alert->experience) && ($alert->experience == '2 years')) ? 'selected' : '')}}>2 Years</option>
                                                                                <option name="experience" value="3 years" {{((isset($alert->experience) && ($alert->experience == '3 years')) ? 'selected' : '')}}>3 Years</option>
                                                                                <option name="experience" value="4 years" {{((isset($alert->experience) && ($alert->experience == '4 years')) ? 'selected' : '')}}>4 Years</option>
                                                                                <option name="experience" value="5 years" {{((isset($alert->experience) && ($alert->experience == '5 years')) ? 'selected' : '')}}>5 Years</option>
                                                                                <option name="experience" value="more than 5 years" {{((isset($alert->experience) && ($alert->experience == 'more than 5 years')) ? 'selected' : '')}}>More than 5 Years</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 mt-2">
                                                                    <div class="jobsearch-filter-responsive-wrap filter-panel mb-0">
                                                                        <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                                                            <div class="jobsearch-fltbox-title filter-head ">
                                                                                <div class="d-inline-block ">
                                                                                    <h4>Qualifications</h4>
                                                                                </div>
                                                                                <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="filter-content py-3">
                                                                            <select class="form-control" name="qualifications">
                                                                                <option name="qualifications"></option>
                                                                                <option name="qualifications" value="Certificate" {{((isset($alert->qualifications) && ($alert->qualifications == 'Certificate')) ? 'selected' : '')}}>Certificate</option>
                                                                                <option name="qualifications" value="Bachelors" {{((isset($alert->qualifications) && ($alert->qualifications == 'Bachelors')) ? 'selected' : '')}}>Bachelors</option>
                                                                                <option name="qualifications" value="Masters" {{((isset($alert->qualifications) && ($alert->qualifications == 'Masters')) ? 'selected' : '')}}>Masters</option>
                                                                                <option name="qualifications" value="Phd" {{((isset($alert->qualifications) && ($alert->qualifications == 'Phd')) ? 'selected' : '')}}>Phd</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mt-2">
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
                                                                                <select class="form-control" name="province">
                                                                                    <option>Select Province</option>
                                                                                    @foreach($provinces as $province)
                                                                                        <option value="{{$province->code}}">{{$province->name}}</option>
                                                                                    @endforeach
                                                                                </select>

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="d-block">City
                                                                                </label>
                                                                                <select class="form-control" name="city" style="width: 200px">
                                                                                    @if($alert->city_id)
                                                                                        <option value="{{$alert->city_id}}" {{((isset($alert->city_id)) ? 'selected' : '')}}>{{$alert->city->name}}</option>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 mt-2">
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

                                                                            <select class="form-control" name="gender">
                                                                                <option name="gender"></option>
                                                                                <option name="gender" value="1" {{((isset($alert->gender) && ($alert->gender == '1')) ? 'selected' : '')}}>Male</option>
                                                                                <option name="gender" value="2" {{((isset($alert->gender) && ($alert->gender == '2')) ? 'selected' : '')}}>Female</option>
                                                                                <option name="gender" value="3" {{((isset($alert->gender) && ($alert->gender == '3')) ? 'selected' : '')}}>Any</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer mt-2">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"> Update Alert </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <nav class="" aria-label="">
                        {{ (isset($alerts)) ? $alerts->links() : '' }}
                    </nav>

                    <div style="clear:both"></div>

                </div>
            </div>
            <!--/.page-content-->

        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</div>
<!-- /.main-container -->

@endsection
<style>
    .simditor-body {
        max-height:250px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }
    span.select2-container.select2-container--default.select2-container--open {
        z-index: 9999;
    }

    input.select2-search__field {
        width: 200px;
    }

    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 200px !important;
    }

</style>

@section('after_scripts')
<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>

<script src="{{asset('assets/plugins/icheck/icheck.js')}}"></script>
<script src="{{asset('assets/js/formsubmit.js')}}"></script>

<script>
    $("select[name='city']").select2({
        placeholder: "Select City/Cities",
        allowClear: true
    });
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    for (p of urlParams) {
        var qName = p[0];

        if (p[0] != "province" && p[0] != "city") {


            $('input[name='+qName+'][value='+p[1]+']').iCheck('check');


        } else {

            if (p[0] == 'province') {
                $("select[name='province']").val(p[1]);

            } else if (p[0] == 'city') {
                if (urlParams.get('province') != null && urlParams.get('province') != '') {
                    $("select[name='city'] option").remove();
                    getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
                        // console.log(res[0]);
                        res.forEach(function (value, index) {
                            $("select[name='city']").append(new Option(value.text, value.id, false, false));
                            // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                        });

                        var splited = p[1].split(',');
                        $("select[name='city']").val(splited).trigger("change");

                    }, (res) => {

                    })

                }
            }


        }

    }

    $("select[name='province']").on('change', function () {
        var html = "";
        $("select[name='city'] option").remove();
        getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
            // console.log(res[0]);
            res.forEach(function (value, index) {
                $("select[name='city']").append(new Option(value.text, value.id, false, false)).trigger('change');
                // html += "<option value='"+value.id+"'>"+value.text+"</option>";
            });
            $("select[name='city']").append(html);
        }, (res) => {

        })
    })

</script>

<script type="text/javascript">
$(function () {
    $('#addManageTable').footable().bind('footable_filtering', function (e) {
        var selected = $('.filter-status').find(':selected').text();
        if (selected && selected.length > 0) {
            e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
            e.clear = !e.filter;
        }
    });

    $('.clear-filter').click(function (e) {
        e.preventDefault();
        $('.filter-status').val('');
        $('table.demo').trigger('footable_clear_filter');
    });

    $('#checkAll').click(function () {
        checkAll(this);
    });

    $('a.delete-action, button.delete-action').click(function (e)
    {
        e.preventDefault(); /* prevents the submit or reload */
        var confirmation = confirm("{{ t('confirm_this_action') }}");

        if (confirmation) {
            if ($(this).is('a')) {
                var url = $(this).attr('href');
                if (url !== 'undefined') {
                    redirect(url);
                }
            } else {
                $('form[name=listForm]').submit();
            }
        }

        return false;
    });
});
</script>
<!-- include custom script for ads table [select all checkbox]  -->
<script>
    function checkAll(bx) {
        var chkinput = document.getElementsByTagName('input');
        for (var i = 0; i < chkinput.length; i++) {
            if (chkinput[i].type == 'checkbox') {
                chkinput[i].checked = bx.checked;
            }
        }
    }
</script>
@endsection