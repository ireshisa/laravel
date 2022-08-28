{{--
//
--}}
@extends('layouts.master')

@section('content')

	{!! csrf_field() !!}
	<input type="hidden" id="postId" name="post_id" value="{{ $post->id }}">


	<div class="main-container">
		
		<?php if (\App\Models\Advertising::where('slug', 'top')->count() > 0): ?>
			@include('layouts.inc.advertising.top', ['paddingTopExists' => (isset($paddingTopExists)) ? $paddingTopExists : false])
		<?php
			$paddingTopExists = false;
		endif;
		?>



			<div class="row">
				<div class="col-md-12 job-description" style="background: url({{url('/images/banner-job.png')}});">

				</div>
				<div class="col-md-10 col-sm-12 offset-1 brief card">
					<div class="card-body">
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="logo-details rounded">
								<img src="{{url('/storage/'.$post->company->logo)}}"/>
							</div>

						</div>

						<div class="col-md-9 col-sm-12 job-details">
							<div class="row mobile-text-center">
								<div class="col-md-9 col-sm-12">
									<h2 class="color-black font-weight-bold">{{$post->title}}</h2>
								</div>
								<div class="col-md-3 col-sm-12 ">
									@if (auth()->check())
										@if (auth()->user()->id == $post->user_id)
											<a class="btn  float-right btn-primary d-block btn-transparent color-blue" href="{{ \App\Helpers\UrlGen::editPost($post) }}">
												<i class="fa fa-pencil-square-o"></i> {{ t('Edit') }}
											</a>
										@else
											@if (in_array(auth()->user()->user_type_id, [2]))
												@if (isset($showConnect) and $showConnect)
													<form role="form" method="POST" action="{{ lurl('posts/' . $post->id . '/contact') }}">
														<input type="hidden" name="from_name" value="{{ auth()->user()->name }}"/>
														<input type="hidden" name="to_name" value="{{ $post->user->name }}">
														<input type="hidden" name="from_email" value="{{ auth()->user()->email }}">

														<input type="hidden" id="from_email" name="from_phone" value="{{auth()->user()->phone }}">

														<input type="hidden" name="post_id" value="{{ $post->id }}">
														<button type="submit" class="btn btn-primary float-right d-block btn-transparent color-blue">Connect</button>
													</form>
												@endif

											@endif
										@endif
									@endif
									 @if (!auth()->check())
                                        <a  class="btn  float-md-right mb-3 mb-md-3 float-none btn-primary d-block btn-transparent color-blue" id="btnShowMsg" data-target="#quickLogin" data-toggle="modal">
                                            Connect
                                        </a>
                                     @endif
								</div>
								<div class="col-md-12">
									<h5 class="">{{$post->category->name}}</h5>
								</div>
								<div class="col-md-12">
									<h5 class="color-blue"><i class="fa fa-map-marker mx-1"></i>{{$post->city->name}}</h5>
								</div>
								<div class="col-md-12">
									<h4 class="color-blue"><b>Company</b> - <a href="{{url('/company-detail/'.$post->company->id)}}" class="color-blue"><u> {{$post->company->name}}</u> </a></h4>
								</div>
								<div class="col-md-12 d-flex flex-row-reverse">

										<div class="d-flex align-items-center">
											@if(auth()->check() && auth()->user()->user_type_id == 2)
											@if(!in_array($post->id,$saved))
											<a class="btn btn-primary btn-transparent save  color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Save Job</a>
											@else
											<a class="btn btn-primary btn-transparent save color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Remove Job from Wishlist</a>
												@endif
												@endif
										</div>
									<div class="d-flex align-items-center flex-grow-1">
											<div class="p-2 px-3 mr-5 color-white bg-blue d-flex align-items-center text-capitalize d-flex">
												<i class="fa fa-briefcase color-white mr-1"></i> {{$post->salaryType->name}}
											</div>
											<h6 class="p-0"><i class="fa fa-clock"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>

									</div>
										</div>
									</div>
								</div>
							</div>


					</div>
					</div>
				</div>
			<div class="container">
				@if (Session::has('flash_notification'))
					@include('common.spacer')
					<?php $paddingTopExists = true; ?>
					<div class="container">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
					<?php Session::forget('flash_notification.message'); ?>
				@endif

					<div class="row my-5">
						<div class="col-md-12 px-3 d-flex justify-content-around">
							<div class="job-box card">
								<div class="card-body">
									{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
									<div class="text-center img-responsive mb-3">
										<i class="fa fa-building fa-6x img-responsive"></i>
									</div>
									<h5 class="text-truncate color-black" style="max-width: 180px">

										{{!empty($post->category)?$post->category->name:"Not Specified"}}

									</h5>
									<h3 class="color-black text-center">Sector</h3>
								</div>
							</div>


							<div class="job-box card">
								<div class="card-body">
									{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
									<div class="text-center img-responsive mb-3">
										<i class="fa fa-user-friends fa-6x img-responsive"></i>
									</div>
									<h5 class="text-truncate color-black" style="max-width: 180px">

										{{!empty($post->gender) ? $post->gender->name : "Not Specified"}}

									</h5>
									<h3 class="color-black text-center">Gender</h3>
								</div>
							</div>

							<div class="job-box card">
								<div class="card-body">
									{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
									<div class="text-center img-responsive mb-3">
										<i class="fa fa-calendar-check fa-6x img-responsive"></i>
									</div>
									<h5 class="text-truncate color-black" style="max-width: 180px">

										{{!empty($post->deadline) ? $post->deadline : "Not Specified"}}

									</h5>
									<h3 class="color-black text-center">Deadline</h3>
								</div>
							</div>

							<div class="job-box card">
								<div class="card-body">
									{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
									<div class="text-center img-responsive mb-3">
										<i class="fa fa-suitcase fa-6x img-responsive"></i>
									</div>
									<h5 class="color-black text-center" >

										{{$post->experience}}

									</h5>
									<h3 class="color-black text-center">Experience</h3>
								</div>
							</div>

							<div class="job-box card">
								<div class="card-body">
									{{--                <img class="img-responsive" src="{{url('/images/sector.png')}}"/>--}}
									<div class="text-center img-responsive mb-3">
										<i class="fa fa-certificate fa-6x img-responsive"></i>
									</div>
									<h5 class="color-black text-center" >

										{{$post->qualification}}

									</h5>
									<h3 class="color-black text-center">Qualification</h3>
								</div>
							</div>
						</div>
					</div>

				<div class="row">
				<div class="col-md-12 mt-4">
					<h3 class="font-weight-bold">Job Description</h3>
					<div class="p-2">
						{!! $post->description !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mt-4">
					<h3 class="font-weight-bold">Company Description</h3>
					<div class="p-2">
						{!! $post->company->description !!}
					</div>
				</div>
			</div>

			</div>
		</div>

@endsection

@section('modal_message')

{{--	@if (auth()->check() or config('settings.single.guests_can_contact_ads_authors')=='1')--}}
@if (auth()->check())
		@include('post.inc.compose-message')

		@else
	@include('post.inc.not-registered')
	@endif
@endsection

@section('after_styles')
@endsection

@section('after_scripts')
    @if (config('services.googlemaps.key'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key') }}" type="text/javascript"></script>
    @endif
	]
	<script>
		/* Favorites Translation */
        var lang = {
            labelSavePostSave: "{!! t('Save Job') !!}",
            labelSavePostRemove: "{{ t('Saved Job') }}",
            loginToSavePost: "{!! t('Please log in to save the Ads.') !!}",
            loginToSaveSearch: "{!! t('Please log in to save your search.') !!}",
            confirmationSavePost: "{!! t('Post saved in favorites successfully !') !!}",
            confirmationRemoveSavePost: "{!! t('Post deleted from favorites successfully !') !!}",
            confirmationSaveSearch: "{!! t('Search saved successfully !') !!}",
            confirmationRemoveSaveSearch: "{!! t('Search deleted successfully !') !!}"
        };

		$(document).ready(function () {
			@if (config('settings.single.show_post_on_googlemap'))
				/* Google Maps */
				getGoogleMaps(
				'{{ config('services.googlemaps.key') }}',
				'{{ (isset($post->city) and !empty($post->city)) ? addslashes($post->city->name) . ',' . config('country.name') : config('country.name') }}',
				'{{ config('app.locale') }}'
				);
			@endif
			$('a.save').click(function () {
				let postId = $(this).data('id');
				//alert(candidateId);
				$.ajax({
					url: "{{url('/ajax/save/post')}}",
					type: 'post',
					data: {
						postId: postId,
						_token: "{{csrf_token()}}",
					},
					success: function (data) {

						if (data.status == 1) {
							alert("Job is added to the Favorites");
						} else {

							alert("Job is removed from Favorites");
						}

					}
				})

			});
			// $("")
		})
	</script>
@endsection