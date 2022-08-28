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
];

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

@section('search')
	@parent
	<div class="container">
		<div class="search-row-wrapper">
			<div class="container">
				<form id="seach" name="search" action="/search-talent?{{httpBuildQuery(request()->all())}}" method="GET">

					@foreach($filters as $filter)
						@if(request()->query($filter))
							<input type="hidden" name="{{$filter}}" value="{{request()->query($filter)}}">
						@endif
					@endforeach

					<div class="row m-0">
						<div class="col-xl-3 col-md-3 col-sm-12 col-xs-12">
							<select name="sector_id" id="catSearch" class="form-control selecter">
								<option value="">All Sectors </option>
								@if (isset($cats) and $cats->count() > 0)
									@foreach ($cats->groupBy('parent_id')->get(0) as $itemCat)
										<option value="{{ $itemCat->tid }}" {{request()->sector_id == $itemCat->id ? 'selected' : ''}}> {{ $itemCat->name }} </option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="col-xl-4 col-md-4 col-sm-12 col-xs-12">
							<input name="q" class="form-control keyword" type="text" value="{{request()->q}}" placeholder="Search by Name, Qualifications and Skills...">
						</div>

						<div class="col-xl-3 col-md-3 col-sm-12 col-xs-12 search-col locationicon">
							<i class="icon-location-2 icon-append"></i>
							<input type="text" id="locSearch" name="location" class="form-control locinput input-rel searchtag-input has-icon tooltipHere"
								   placeholder="{{ t('Where?') }}" value="{{request()->location}}" title="" data-placement="bottom">
						</div>

						<div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
							<button class="btn btn-block btn-primary">
								<i class="fa fa-search"></i> <strong>{{ t('Find') }}</strong>
							</button>
						</div>
						{!! csrf_field() !!}
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="main-container">

		@include('search.inc.breadcrumbs')

		@include('common.spacer')

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
			</div>
			<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />
			<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/plugin.css?ver=1.5.9' type='text/css' media='all' />
			<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://careerfy.net/demo/wp-content/litespeed/cssjs/a4222.css?50301' type='text/css' media='all' />
			
			<style>
			.col-md-3.jobsearch-typo-wrap, .col-md-3.jobsearch-typo-wrap {
				padding-left: 15px;
				padding-right: 15px;
			}
			.reset-button{
				padding: 5px !important;
				margin: 10px auto;
				color: #fff !important;
				font-size: 17px;
				text-transform: uppercase;
			}
			.reset-button:before,.jobsearch-fltbox-title a:before{
				content: "" !important;
			}
			.fa.fa-angle-down{
				float: right;
    			color: #ccc;
			}
			.jobsearch-filter-responsive-wrap .btn-primary{
				margin-bottom: 10px;
			}
			.search-row-wrapper {
    			background: #fff;
			}
			.btn-primary {
				background-color: #02979D;
				border-color: #02979D;
			}
			</style>
			<div class="row">

				<!-- Sidebar -->
				<div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap">
					<div class="jobsearch-filter-responsive-wrap">
						<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
							<div class="jobsearch-fltbox-title">
								<a href="/search-talent" class="btn btn-success btn-sm btn-block reset-button">Reset filters</a>
							</div>
						</div>
					</div>
					<form action="/search-talent?{{httpBuildQuery(request()->all())}}" id="filter-form" style="padding:0;">
						<input type="hidden" name="q" value="{{request()->q}}">
						<input type="hidden" name="location" value="{{request()->location}}">
						<input type="hidden" name="sector_id" value="{{request()->sector_id}}">
						<div class="jobsearch-filter-responsive-wrap">
							<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
								<div class="jobsearch-fltbox-title">
									 <a href="#MyClassified" data-toggle="collapse" class="pull-right">Salary <i class="fa fa-angle-down"></i></a>
								</div>
								<div class="panel-collapse collapse show jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified">
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
									 <a href="#MyClassified1" data-toggle="collapse" class="pull-right">Age <i class="fa fa-angle-down"></i></a>
								</div>
								<div class="panel-collapse collapse show jobsearch-checkbox-toggle jobsearch-remove-padding jobsearch-remove-padding" id="MyClassified1">
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
								<div class="panel-collapse collapse show jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified2">
									<div class="filter-date filter-content">
										<div style="display: flex; justify-content: space-between; align-items:center;">
											<select name="gender" id="" class="form-control">
												<option value="">All</option>
												<option value="male" {{request()->male == 'male' ? 'selected' : ''}}>Male</option>
												<option value="female" {{request()->female == 'female' ? 'selected' : ''}}>Female</option>
											</select>
										</div>
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
								<div class="panel-collapse collapse show jobsearch-checkbox-toggle jobsearch-remove-padding" id="MyClassified3">
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
					</form>
				</div>

			
			<!-- Content -->
				<div class="col-md-9 page-content col-thin-left jobsearch-typo-wrap">
					<div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">
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
									<!-- <span class="promotepof-badge"><i class="fa fa-star" title="Featured"></i></span>
									<div class="urgntpkg-candv2"><span>urgent</span></div> -->
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
											@if($user->location)
												<li>
													<i class="fa fa-map-marker"></i> {{$user->location}}                                            
												</li>
											@endif
											<li><i class="jobsearch-icon jobsearch-filter-tool-black-shape"></i>                <a class="">
											{{$user->skills}}                </a>
											</li>
										</ul>
									</div> 
									<!-- <a href="javascript:void(0);" class="jobsearch-candidate-default-btn jobsearch-open-signin-tab" data-candidateid="{{$user->id}}"><i class="jobsearch-icon jobsearch-add-list"></i> Save Candidate            </a> -->
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="category-list hide" >
						<div class="tab-box clearfix">

							<!-- Nav tabs -->
							<div class="col-xl-12 box-title no-border">
								<div class="inner">
									<h2>
										<small>{{ $users->total() }} Job seekers found</small>
									</h2>
								</div>
							</div>
						</div>

						<div class="adds-wrapper jobs-list">

							@foreach($users as $user)

							<div class="item-list job-item">

									<div class="row">
										<div class="col-md-10 col-sm-10 add-desc-box">
											<div class="add-details jobs-item">
												<div class="row">
													<div class="col-lg-3">
														<a href="search-talent/seeker/{{$user->id}}">
															<img class="user-photo mr-2" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}" alt="">
														</a>
													</div>
													<div class="col-lg-5">
															<h4 class="job-title">
																<a href="search-talent/seeker/{{$user->id}}"><strong>{{explode(' ',$user->name)[0] ?? $user->name}}</strong></a>
																@if($user->location) <small class="text-muted">from {{$user->location}}</small> @endif
															</h4>
															<p style="margin-bottom: 15px;">{{$user->sector ? $user->sector->name : '-'}}</p>
														<div class="text-muted" style="margin-bottom: 15px;">
															<p style="margin-bottom: 5px;"><strong>Age</strong>: {{$user->age}}</p>
															<p style="margin-bottom: 5px;"><strong>Gender</strong>:
																{{ucfirst($user->gender)}}</p>
															<p style="margin-bottom: 5px;"><strong>Expected salary</strong>: LKR
																{{number_format( $user->salary ? (int)$user->salary : 0 )}}</p>
															<p style="margin-bottom: 5px;"><strong>Experience</strong>:
																{{ isset($experiences[$user->experience]) ? $experiences[$user->experience] : '-'  }}</p>
														</div>


                                                    @if (isset(auth()->user()->user_type_id))
                										@if (in_array(auth()->user()->user_type_id, [1]))
                                    			
                										@endif
                										@if (in_array(auth()->user()->user_type_id, [2]))
                										  		<p style="margin-bottom: 0;">Email: <a href="mailTo:{{$user->email}}">{{$user->email}}</a></p>
                										@endif
                									@endif

												
													</div>
													<div class="col-lg-4">
														<div>
															<p style="margin-bottom: 5px;"><strong>Qualifications</strong>:</p>
															<div style="margin-bottom: 15px;">{!! implode('<br>', explode(PHP_EOL, $user->qualifications)) !!}</div>
														</div>
														<div>
															<p><strong>Skills</strong>: {{$user->skills}}</p>
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


					<div class="mt-4">{{$users->links()}}</div>

				</div>

				<div style="clear:both;"></div>

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

@section('after_scripts')
	<script>
	    $('.jobsearch-open-signin-tab').click(function(){
	        let candidate_id=$(this).attr('data-candidateid');
	        
                     $.ajax({
                        method: 'POST',
                        url: '{{route('save.candidate')}}',
                        data: {
                        
                             candidateId:candidate_id,
                            _token: $('input[name=_token]').val()
                        }
                    }).done(function(data)
                	{
                      
                      if(data.logged ==1){
                          alert(data.message);
                          
                      }else{
                          
                            alert(data.message);
                      }
                      
                      //console.log(data)
                    });
	        
	    })
		$(document).ready(function () {
			$('#postType a').click(function (e) {
				e.preventDefault();
				var goToUrl = $(this).attr('href');
				redirect(goToUrl);
			});
			$('#orderBy').change(function () {
				var goToUrl = $(this).val();
				redirect(goToUrl);
			});
		});
	</script>
@endsection
