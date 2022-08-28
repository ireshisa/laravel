{{--
//
--}}
<?php
$fullUrl = rawurldecode(url(request()->getRequestUri()));
$tmpExplode = explode('?', $fullUrl);
$fullUrlNoParams = current($tmpExplode);
?>
@extends('layouts.master')

{{--@section('search')--}}
{{-- @parent--}}
{{-- @include('search.inc.form')--}}
{{--@endsection--}}

@section('content')
<div class="main-container" style="margin-top: 14px">
	<div class="row">
		<!--<div class="col-md-12 d-flex justify-content-center align-items-center jobs-banner">-->
		<!--    <div class="col"></div>-->
		<!--             <div class="col-md-10 text-center">-->
		<!--             <h1 class="mb-3 banner-title">Finding Your Dream Job Just Got Easier!</h1></div>-->
		<!--             <div class="col"></div>-->
		<!--	<div>-->
		<!--		<form action="{{url('/latest-jobs')}}" method="get">-->
		<!--			<div class="input-group mx-auto" style="max-width: 400px">-->
		<!--				<input class="form-control" name="search" placeholder="Search Jobs"/>-->
		<!--				<button type="submit" class="btn btn-blue rounded"><i class="fa fa-search mr-1"></i> Search</button>-->
		<!--			</div>-->
		<!--		</form>-->
		<!--	</div>-->
		<!--</div>-->
		<div class="col-md-12 d-flex justify-content-center align-items-center jobs-banner">
			<div class="row">
				<div class="col"></div>
				<div class="col-md-10 text-center">
					<h1 class="mb-3 banner-title">
						Finding Your Dream Job Just Got Easier!</h1>
				</div>
				<div class="col"></div>
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center align-items-center jobs-banner-search">
						<div class="col"></div>
						<div class="col-md-6">
							<form action="{{url('/latest-jobs')}}" method="get">
								<div class="input-group searchbar" style="height: 50px">
									<input class="form-control" name="search" placeholder="Search Jobs" style="height: 50px;" />
									<button type="submit" class="btn btn-blue rounded"><i class="fa fa-search mr-1"></i> Search
									</button>
								</div>
							</form>
						</div>
						<div class="col"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('search.inc.breadcrumbs')
	{{-- @include('search.inc.categories')--}}
	<?php if (\App\Models\Advertising::where('slug', 'top')->count() > 0) : ?>
		@include('layouts.inc.advertising.top', ['paddingTopExists' => true])
	<?php
		$paddingTopExists = false;
	else :
		if (isset($paddingTopExists) and $paddingTopExists) {
			$paddingTopExists = false;
		}
	endif;
	?>
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

		<div class="row">
			<div class="col-md-12 px-4 py-1 mb-2">
				@if(auth()->check() && auth()->user()->user_type_id == 2)
				<button class="btn btn-block btn-primary ml-3 mr-0 " style="max-width: 200px" data-toggle="modal" data-target="#jobalert">
					Create job alert
				</button>
				@endif
				<?php /*<div class="card person-info">
     
    <div class="card-body">
        <h3 class="color-black text-uppercase">E-mail Me New Jobs</h3>
      	<p class="text-muted">*Use the filters on the left and create email alerts when matched jobs are posted </p>

    <form method="POST" action="#" id="create-alert-form" class="w-100">
        <div class="d-flex flex-row-reverse">
    <div class="d-flex flex-shrink-1 align-items-center">

        	<button type="submit"  id="create-alert-btn" class="btn find btn-block btn-primary ml-3 mr-0 "
							style="max-width: 200px" data-toggle="modal" data-target="#jobalert">
						{{((isset($alert_id))?"Update Alert":"Create Alert")}}
					</button>
        </div>
      <div class="d-flex flex-grow-1">
				       <div class="d-block w-100">

					{{ csrf_field() }}
					@if(isset($alert_id))
						<input type="hidden" name="alert_id" value="{{$alert_id}}"/>
					@endif
					<div class="form-group">
						<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
						<input type="text" class="form-control {{ $nameError }}" name="name"  value="{{$alertName ?? ''}}" placeholder="Job Alert Name"/>


					</div>
					<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
					<div class="form-group">
						<input type="email" class="form-control {{ $emailError }}" name="email" value="{{$alertEmail ?? ''}}" placeholder="Email Address"/>

					</div>
					<div class="row">
					    <div class="col-md-12  col-lg-10 d-flex align-items-center">
					    <div class="d-flex  flex-wrap justify-content-around align-items-center align-self-center flex-grow-1">
					<div class="d-flex align-self-center align-items-center">
							<input name="frequency" class="radio-frequency" maxlength="75" type="checkbox" value="Daily" {{((isset($notifyType) && $notifyType=="Daily")?"checked":"")}}><label class="d-flex  mb-0 ml-2">Daily</label>
						</div>
						<div class="d-flex align-self-center align-items-center">
							<input name="frequency" class="radio-frequency" maxlength="75" type="checkbox" value="Weekly" {{((isset($notifyType) && $notifyType=="Weekly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Weekly</label>
						</div>
						<div class="d-flex align-self-center align-items-center">
							<input name="frequency" class="radio-frequency" maxlength="75" type="checkbox" value="Monthly" {{((isset($notifyType) && $notifyType=="Monthly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Monthly</label>
					</div>
						<div class="d-flex align-self-center align-items-center">
							<input name="frequency" class="radio-frequency" maxlength="75" type="checkbox" value="Annually" {{((isset($notifyType) && $notifyType=="Annually")?"checked":"")}}><label class="d-flex mb-0 ml-2">Annually</label>
				</div>
					</div>
					</div>

					</div>
			</div>

				    </div>
	</div>

				</form>
			</div>
</div> */ ?>

				<div class="modal fade" id="jobalert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Create job alert</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h3 class="color-black">E-mail me new jobs</h3>
								<!--<p class="text-muted">*Use the filters on the left and create email alerts when matched jobs are posted </p>-->
							</div>
							<form method="POST" action="{{url('/job-alerts')}}" id="create-alert-form" class="w-100">
								<div class="d-flex flex-grow-1 px-4">
									<div class="d-block w-100">

										{{ csrf_field() }}
										@if(isset($alert_id))
										<input type="hidden" name="alert_id" value="{{$alert_id}}" />
										@endif
										<div class="form-group">
											<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
											<input type="text" class="form-control {{ $nameError }}" name="name" value="{{$alertName ?? ''}}" placeholder="Job Alert Name" />


										</div>
										<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
										<div class="form-group">
											<input type="email" class="form-control {{ $emailError }}" name="email" value="{{$alertEmail ?? ''}}" placeholder="Email Address" />

										</div>
										<!--<div class="row">-->
										<!--	<div class="col-md-12 col-lg-12 d-flex align-items-center">-->
										<!--		<div class="d-flex  flex-wrap justify-content-around align-items-center align-self-center flex-grow-1">-->
										<!--			<div class="d-flex align-self-center align-items-center">-->
										<!--				<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Daily" {{((isset($notifyType) && $notifyType=="Daily")?"checked":"")}}><label class="d-flex  mb-0 ml-2">Daily</label>-->
										<!--			</div>-->
										<!--			<div class="d-flex align-self-center align-items-center">-->
										<!--				<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Weekly" {{((isset($notifyType) && $notifyType=="Weekly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Weekly</label>-->
										<!--			</div>-->
										<!--			<div class="d-flex align-self-center align-items-center">-->
										<!--				<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Monthly" {{((isset($notifyType) && $notifyType=="Monthly")?"checked":"")}}><label class="d-flex mb-0 ml-2">Monthly</label>-->
										<!--			</div>-->
										<!--			<div class="d-flex align-self-center align-items-center">-->
										<!--				<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Annually" {{((isset($notifyType) && $notifyType=="Annually")?"checked":"")}}><label class="d-flex mb-0 ml-2">Annually</label>-->
										<!--			</div>-->
										<!--		</div>-->
										<!--	</div>-->
										<!--</div>-->
										
																				<div class="row">
									
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
														<select class="form-control" name="categories">
															<option name="categories"></option>
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
															<option name="age"></option>
															<option value="18-22" name="age">18-22 Years</option>
															<option name="age" value="23-27">23-27 Years</option>
															<option name="age" value="28-32">28-32 Years</option>
															<option name="age" value="33-37">33-37 Years</option>
															<option name="age" value="38-42">38-42 Years</option>
															<option name="age" value="43-47">43-47 Years</option>
															<option name="age" value="48-52">48-52 Years</option>
															<option name="age" value="53-57">53-57 Years</option>
															<option name="age" value="57-200">Above 57 Years</option>
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
															<option name="salary" value="500-1000" >500LKR - 1000LKR</option>
															<option name="salary" value="1000-5000" >1000LKR - 5000LKR</option>
															<option name="salary" value="5000-10000" >5000LKR - 10,000LKR</option>
															<option name="salary" value="10000-20000" >10,000LKR - 20,000LKR</option>
															<option name="salary" value="20000-30000" >20,000LKR - 30,000LKR</option>
															<option name="salary" value="30000-50000" >30,000LKR - 50,000LKR</option>
															<option name="salary" value="50000-100000" >50,000LKR - 100,000LKR</option>
															<option name="salary" value="> 100000" > 100,000LKR</option>
															<option name="salary" value="all">All</option>
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
														<select class="form-control" name="experience">
															<option value="none">None</option>
															<option value="6 months">6 Months</option>
															<option  value="1 years">1 Years</option>
															<option  value="2 years">2 Years</option>
															<option  value="3 years">3 Years</option>
															<option  value="4 years">4 Years</option>
															<option  value="5 years">5 Years</option>
															<option  value="more than 5 years">More than 5 Years</option>
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
															<option  value="none">None</option>
															<option  value="Certificate">Certificate</option>
															<option  value="Bachelors">Bachelors</option>
															<option  value="Masters">Masters</option>
															<option  value="Phd">Phd</option>
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
															<option name="gender" value="1">Male</option>
															<option name="gender" value="2">Female</option>
															<option name="gender" value="3">Any</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="modal-footer mt-2">
									<button type="button" class="btn btn-secondary btnmf-none" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">{{((isset($alert_id))?"Update Alert":"Create Alert")}}</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			@include('search.inc.sidebar')
			<div class="col-md-8 col-sm-12 page-content col-thin-left d-flex align-self-stretch pl-4" id="filter-content">


				<div class="w-100 d-block">

					<div class="col-md-12">
						<center>
							<button type="button" class="btn btn-primary btn-block mobile-show" onclick="showfilter()"><i class="fa fa-search mr-1"></i> Filter</button>

						</center>
						<br><br>
					</div>


					<div class="sortfiltrs-contner with-rssfeed-enable">
						<div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
							<h2 class="jobsearch-fltcount-title">
								{{ $results->total() }} Jobs Found
							</h2>
						</div>
					</div>

					@foreach($results as $key => $post)
					<div class="row border person-info" style="margin-bottom: 45px">
						<div class="col-md-12 py-3 d-flex ">



							<div class="d-flex logo-container align-items-center justify-content-center">

								<a href="{{url('/post/'.$post->id)}}">
									<img src="{{ $post->logo ? asset('storage/' . $post->logo) : url('images/user.jpg')  }}" alt="">
								</a>

							</div>
							<div class="d-flex align-items-center flex-grow-1 job-details ">
								<div class="w-100 px-3 d-block align-center-mobile">

									{{-- <div class="col-md-12">--}}
									<h2 class="font-weight-bold" style="text-align: center;"><a href="{{url('/post/'.$post->id)}}">{{$post->title}}</a></h2>
									{{-- </div>--}}
									{{-- <div class="col-md-12">--}}

									<div class="w-100 d-flex flex-row-reverse">

										<div class="d-inline-flex flex-shrink-0 px-2 align-items-center">
											<h5 class="city"><i class="fa fa-map-marker"></i> {{$post->city->name}}</h5>

										</div>
										<div class="d-inline-flex flex-grow-1">
											<div class="w-100 d-block" >
												<h5 class="company">{{$post->company->name}}</h5>
												<h5>{{$post->category->name}}</h5>
												<h6><i class="fa fa-clock"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">

											<div class="float-left p-2 px-3 color-white bg-blue text-capitalize" style="border-radius: 5px;">
												<i class="fa fa-briefcase color-white mr-1"></i> {{$post->postType->name}}
											</div>
											@if(auth()->check() && auth()->user()->user_type_id == 2)
											@if(!in_array($post->id,$saved))
											<a id="like" class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Save Job</a>
											@else
											<a id="unlike" class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Remove Job from Wishlist</a>

											@endif
											@endif


										</div>
									</div>
								</div>

								{{-- </div>--}}
							</div>
						</div>
					</div>
					@endforeach

					<style>
						@media screen and (max-width: 500px) {

							.float-left,
							.pull-left {
								float: none !important;
								text-align: center;
							}

							.float-left {
								float: none !important;
							}

.align-center-mobile
{
	text-align: center !important;
}
						}
					</style>

					<div class="row">
						<div class="col-md-12 mb-3">
							<nav class="search-talent">{{$results->links()}}</nav>

						</div>
					</div>

				</div>
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
	<link rel="stylesheet" href="{{asset('css/loading.css')}}">

	<style>
		.simditor-body {
			max-height: 250px !important;
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

	@endsection


	@section('after_scripts')


	<script>
		function cloce() {
			var element = document.getElementById("filter-options");
			element.style.display = "none";
		}

		function showfilter() {
			var element = document.getElementById("filter-options");
			element.style.display = "block";
		}
	</script>


	<script src="{{asset('assets/plugins/icheck/icheck.js')}}"></script>
	<script src="{{asset('assets/js/formsubmit.js')}}"></script>

	<script>
		$(document).ready(function() {
			$("select[name='city_search']").select2();
			$("input[type='checkbox'],input[type='radio']").iCheck({
				checkboxClass: 'icheckbox_futurico',
				radioClass: 'icheckbox_futurico'
			});

			$(".filter-head").on('click', function() {
				$(this).closest('.filter-panel').find('.filter-content').toggle('slow');
			});
			$(".filter-panel:nth-child(3) .filter-content").slideUp();
			$(".filter-panel:nth-child(4) .filter-content").slideUp();
			$(".filter-panel:nth-child(5) .filter-content").slideUp();
			$(".filter-panel:nth-child(6) .filter-content").slideUp();


			$(".filter-content").each(function() {
				$(this).find('.form-check').each(function(index, value) {
					if (index >= 10) {

						$(this).hide();
					}
				})

			});
			$(".filter-content").each(function() {
				if ($(this).children().length > 10) {
					$(this).append('<a class="expand"><i class="fa fa-plus"></i> Show More </a>');
					$(this).append('<a class="collapse"><i class="fa fa-minus"></i> Show Less </a>');
					$(this).find(".collapse").hide();
				}
			})

			$("body").on('click', '.expand', function() {
				$(this).parent().find('.form-check').show();
				$(this).hide();
				$(this).parent().find(".collapse").show();
			});
			$("body").on('click', '.collapse', function() {
				$(this).parent().find('.form-check').each(function(index, value) {
					if (index < 10) {
						$(this).show();


					} else {
						$(this).hide();
					}
				});

				$(this).hide();
				$(this).parent().find(".expand").show();
			})
			$('#postType a').click(function(e) {
				e.preventDefault();
				var goToUrl = $(this).attr('href');
				redirect(goToUrl);
			});
			$('#orderBy').change(function() {
				var goToUrl = $(this).val();
				redirect(goToUrl);
			});
			// const queryString = window.location.search;
			// const urlParams = new URLSearchParams(queryString);
			// for (p of urlParams) {
			// 	var qName = p[0];
			// 	if (p[0] != "q" && p[0] != "location") {
			//
			// 		if (p[1].includes(',')) {
			//
			// 			var arr = p[1].split(',');
			// 			arr.forEach(function (value, index) {
			//
			// 				$('input[name=' + qName + '][value=' + value + ']').iCheck('check');
			// 			})
			// 		} else {
			// 			$('input[name=' + qName + '][value=' + p[1] + ']').iCheck('check');
			//
			// 		}
			// 	}
			// }

			// $(".find").on('click',function () {
			// 	var searchStr = window.location.search;
			// 	var searchParams = new URLSearchParams(searchStr);
			// 	searchParams.delete("q");
			// 	searchParams.delete("location");
			// 	if (searchStr != '' || searchStr != null)
			// 	{
			//
			//
			// 		var searchVal  = 0;
			// 		if ($("#search").val() != null && $("#search").val() != '')
			// 		{
			// 			searchParams.append('q',$("#search").val())
			// 			searchVal = 1;
			//
			// 		}
			// 		if ($("#locSearch").val() != null && $("#locSearch").val() != '')
			// 		{
			// 			searchParams.append('location',$("#locSearch").val());
			// 			console.log("l");
			// 			// (searchVal == 0)?"?location="+$("#locSearch").val():"&location="+$("#locSearch").val();
			//
			// 		}
			// 		// $(this).attr('href',searchStr);
			// 	}
			//
			// 	window.history.pushState("object or string", "Title", '?'+searchParams.toString());
			// 	location.reload();
			// });

			$("#filter-options input[type='checkbox']").on('ifToggled', function(e) {
				e.preventDefault();
				var qString = generateQueryString();

				applySearchFilters(qString);
			});

			$("#filter-options input[type='radio']").on('ifChecked', function(e) {


				var qString = generateQueryString();
				if (qString != null && qString != '') {
					applySearchFilters(qString);
				}


			});
		});


		// $('#create-alert-btn').click(function (e) {
		//     e.preventDefault();
		//     var currentUrl = location.href;
		//     $('#current-url-input').val(currentUrl);
		//     $('#create-alert-form').submit();
		// });


		function generateQueryString() {
			var str = "";
			var field_name = '';
			var counter = 0;
			$("#filter-options input[type='checkbox']:checked,#filter-options input[type='radio']:checked").each(function() {

				if (field_name == "") {
					field_name = $(this).attr('name');
					str += "?" + field_name + '=';
				} else if ($(this).attr('name') != field_name) {
					field_name = $(this).attr('name');
					str += "&" + field_name + "=";
					counter = 0;
				}

				str += ((counter > 0) ? ',' + $(this).val() : $(this).val());

				counter++;
			});
			var loc = "";
			//console.log($("select[name='province_search']").val());
			if ($("select[name='province_search']").val() != "Select Province") {
				if (str != "") {
					str += "&";
				} else {
					str += "?";
				}
				//$("select[name='province']").trigger('change');
				loc += "province=" + $("select[name='province_search']").val();

				if ($("select[name='city_search']").val() != null) {
					loc += "&city=";
					$("select[name='city_search']").select2('data').forEach(function(item, index) {
						loc += item.id + ",";

					});
					loc = loc.substring(0, loc.length - 1);
				}
				str += loc;
			}



			window.history.pushState("object or string", "Title", str);
			return str;
		}

		$(".find").on('click', function() {
			var qs = generateQueryString();
			applySearchFilters(qs);
		})
		$('a.save-job').click(function() {
			let postId = $(this).data('id');
			//alert(candidateId);
			$.ajax({
				url: "{{url('/ajax/save/post')}}",
				type: 'post',
				data: {
					postId: postId,
					_token: "{{csrf_token()}}",
				},
				success: function(data) {

					if (data.status == 1) {
						alert("Job is added to the Favorites");
						$('#like').hide();
						location.reload();
					} else {

						alert("Job is removed from Favorites");
						$('#unlike').hide();
						location.reload();
					}

				}
			})

		});

		function applySearchFilters(qStr) {
			// console.log(qStr);
			// return;
			$("#filter-content").html("<div class='d-flex align-self-stretch align-items-center w-100 justify-content-center'>" +
				"<div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>" +
				"</div>");
			getData("{{url('/latest-jobs-ajax')}}" + qStr).then((res) => {

				$("#filter-content").html(res);
			}, (res) => {
				console.log(res);
			})
		}
	</script>

	<script>
		$("input[type='radio']").iCheck({
			checkboxClass: 'icheckbox_futurico',
			radioClass: 'icheckbox_futurico'
		});
		$("select[name='city']").select2({
			placeholder: "Select City/Cities",
			allowClear: true
		});
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		for (p of urlParams) {
			var qName = p[0];

			if (p[0] != "province" && p[0] != "city") {
				if (p[1].includes(",")) {
					var splitP1 = p[1].split(",");
					splitP1.forEach(function(item, index) {
						$('input[name=' + qName + '][value=' + item + ']').iCheck('check');
					})

				} else {
					$('input[name=' + qName + '][value=' + p[1] + ']').iCheck('check');
				}

			} else {

				if (p[0] == 'province') {
					$("select[name='province_search']").val(p[1]);

				} else if (p[0] == 'city') {
					if (urlParams.get('province') != null && urlParams.get('province') != '') {
						$("select[name='city_search'] option").remove();
						getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
							// console.log(res[0]);
							res.forEach(function(value, index) {
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

		$("select[name='province_search']").on('change', function() {
			var html = "";
			$("select[name='city'] option").remove();
			getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
				// console.log(res[0]);
				res.forEach(function(value, index) {
					$("select[name='city_search']").append(new Option(value.text, value.id, false, false)).trigger('change');
					// html += "<option value='"+value.id+"'>"+value.text+"</option>";
				});
				$("select[name='city_search']").append(html);
			}, (res) => {

			})
		})
	</script>
		<script>

		$("select[name='city']").select2({
			placeholder: "Select City/Cities",
			allowClear: true
		});
	
		for (p of urlParams) {
			var qName = p[0];

			if (p[0] != "province" && p[0] != "city") {
				if (p[1].includes(",")) {
					var splitP1 = p[1].split(",");
					splitP1.forEach(function(item, index) {
						$('input[name=' + qName + '][value=' + item + ']').iCheck('check');
					})

				} else {
					$('input[name=' + qName + '][value=' + p[1] + ']').iCheck('check');
				}

			} else {

				if (p[0] == 'province') {
					$("select[name='province']").val(p[1]);

				} else if (p[0] == 'city') {
					if (urlParams.get('province') != null && urlParams.get('province') != '') {
						$("select[name='city'] option").remove();
						getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
							// console.log(res[0]);
							res.forEach(function(value, index) {
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

		$("select[name='province']").on('change', function() {
			var html = "";
			$("select[name='city'] option").remove();
			getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
				// console.log(res[0]);
				res.forEach(function(value, index) {
					$("select[name='city']").append(new Option(value.text, value.id, false, false)).trigger('change');
					// html += "<option value='"+value.id+"'>"+value.text+"</option>";
				});
				$("select[name='city']").append(html);
			}, (res) => {

			})
		})
	</script>
	@endsection