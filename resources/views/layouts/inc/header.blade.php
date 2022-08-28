<?php
// Search parameters
$queryString = (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');

// Get the Default Language
$cacheExpiration = (isset($cacheExpiration)) ? $cacheExpiration : config('settings.optimization.cache_expiration', 86400);
$defaultLang = Cache::remember('language.default', $cacheExpiration, function () {
    $defaultLang = \App\Models\Language::where('default', 1)->first();
    return $defaultLang;
});

// Check if the Multi-Countries selection is enabled
$multiCountriesIsEnabled = false;
$multiCountriesLabel = '';
if (config('settings.geo_location.country_flag_activation')) {
	if (!empty(config('country.code'))) {
		if (\App\Models\Country::where('active', 1)->count() > 1) {
			$multiCountriesIsEnabled = true;
			$multiCountriesLabel = 'title="' . t('Select a Country') . '"';
		}
	}
}

// Logo Label
$logoLabel = '';
if (getSegment(1) != trans('routes.countries')) {
	$logoLabel = config('settings.app.app_name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">

	<!-- Container wrapper -->
{{--	<div class="container">--}}
		<!-- Navbar brand -->
        <a class="navbar-brand" href="{{url('/')}}"><img  src="{{url('images/logo.png')}}" /></a>

		<!-- Toggle button -->
		<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarSupportedContente"
				aria-controls="navbarSupportedContent"
				aria-expanded="true"
				aria-label="Toggle navigation"
		>
			<i class="fas fa-bars"></i>
		</button>

		<!-- Collapsible wrapper -->
		<div class="collapse d-lg-flex justify-content-start navbar-collapse" id="navbarSupportedContente">
			<!-- Left links -->

			<ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto navbarSupported d-lg-flex flex-lg-grow-1">
				<li class="nav-item navbarSupported">
					<a class="nav-link navbarSupported" aria-current="page" href="{{url('/latest-jobs')}}">Search Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/search-talent')}}">Search Talent</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/companies')}}">Find Employer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('pricing')}}">Pricing</a>
				</li>
				
				
				
				
				
				
				
				
				
				@if(auth()->check())
						@if  (auth()->user()->user_type_id == 1)
						
								<li  class="nav-item mx-6 mobile-show " style="display:none;">
									<a  data-toggle="collapse" href="#expand-employer3" role="button" aria-expanded="false" aria-controls="collapseExample">My Account<i class="fa fa-caret-down mx-1"></i> </a>
									<div class="collapse" id="expand-employer3">
										<ul class="navbar-nav expandable">

											<li class="nav-item"><a href="{{ lurl('account/companies') }}">{{ 'My dashboard' }} </a></li>
							

											<li class="nav-item"><a href="{{url('/logout')}}"></i>Logout</a></li>
										</ul>
									</div>
								</li>
						@else
						
							<li  class="nav-item mx-6  mobile-show" style="display:none;">
								<a  data-toggle="collapse" href="#expand3" role="button" aria-expanded="false" aria-controls="collapseExample">My Account<i class="fa fa-caret-down mx-1"></i> </a>
								<div class="collapse" id="expand3">
									<ul class="navbar-nav expandable">
							
							      		<li class="nav-item"><a href="{{ lurl('account/resumes') }}">{{ 'My dashboard' }} </a></li>

								
										<li class="nav-item"><a href="{{url('/logout')}}">Logout</a></li>
									</ul>
								</div>
							</li>
						@endif
						@endif
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</ul>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto d-lg-flex align-items-center nav2nd">
				@if(auth()->guest())
					<li class="nav-item mx-3">

						<a data-toggle="modal" href="#quickLogin"  class="btn btn-primary-upload"><i style="margin-right: 7px;" class="fa fa-user"></i>Login</a>
					</li>
					<li class="nav-item mx-6">
						<!--<a  href="{{ lurl(trans('routes.register')) }}" class="btn btn-primary-upload"><i style="margin-right: 7px;" class="fa fa-user-plus"></i>Register</a>-->
						<a data-toggle="modal" href="#quickRegister" class="btn btn-primary-upload"><i style="margin-right: 7px;" class="fa fa-user-plus"></i>Register</a>

					</li>
				@else
                    @if (auth()->user()->user_type_id == 1)
					<li class="nav-item mx-3  d-lg-block d-none">
						<a class="btn new-post" href="{{url('/posts/create')}}"><i style="margin-right: 7px;" class="fas fa-plus-circle"></i>Post a Job</a>
					</li>
                    @else
					<li class="nav-item mx-6 d-lg-block d-none">
						<a class="btn btn-primary-upload" href="{{url('/account/resumes')}}"><i style="margin-right: 7px;" class="fas fa-arrow-circle-up"></i>Create Your Resume</a>
					</li>
                    @endif


				<li class="dropdown nav-item ml-4 d-lg-block  d-none ">
					<a href="#" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown"  id="dropdownMenuButton1" role="button" aria-haspopup="true" aria-expanded="true">
					   <div class="profile-pic rounded-circle d-inline-flex" style="background:url('{{((auth()->user()->avatar_url !=null)?url('/storage/'.auth()->user()->avatar_url):url('/images/us1.png'))}}') center no-repeat">
					   
					   </div> 
					    <!--<img src="{{((auth()->user()->avatar_url !=null)?url('/storage/'.auth()->user()->avatar_url):url('/images/us1.png'))}}" alt="user" width="40" class="profile-pic img-circle rounded-circle">-->
					    </a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						@if (auth()->user()->user_type_id == 1)

							<li class="dropdown-item"><a href="{{ lurl('account/') }}" ><i class="fas fa-columns mr-1"></i> {{ 'Dashboard' }} </a></li>
{{--							<li class="dropdown-item"><a href="{{ lurl('account/companies') }}"><i class="icon-town-hall"></i> {{ t('My companies') }} </a></li>--}}
{{--							<li class="dropdown-item"><a href="{{ lurl('account/my-posts') }}"><i class="icon-th-thumb"></i> {{ t('My ads') }} </a></li>--}}

{{--							<li class="dropdown-item">--}}
{{--								<a href="{{ lurl('account/conversations') }}">--}}
{{--									<i class="icon-mail-1"></i> {{ t('Conversations') }}--}}
{{--									<span class="badge badge-pill badge-important count-conversations-with-new-messages">{{$unread}}</span>--}}
{{--								</a>--}}
{{--							</li>--}}
{{--							<li class="dropdown-item"><a href="{{ lurl('account/transactions') }}"><i class="icon-money"></i> {{ t('Transactions') }}</a></li>--}}

						@else
							<li class="dropdown-item"><a href="{{ lurl('account/') }}" ><i class="fas fa-columns mr-1"></i> {{ 'Dashboard' }} </a></li>
{{--							<li class="dropdown-item"><a href="{{ lurl('account/resumes') }}" ><i class="icon-attach"></i> {{ t('My resumes') }} </a></li>--}}
{{--							<li class="dropdown-item"><a href="{{ lurl('account/favourite') }}"><i class="icon-heart"></i> {{ t('Favourite jobs') }} </a></li>--}}

{{--							<li class="dropdown-item">--}}
{{--								<a href="{{ lurl('account/conversations') }}">--}}
{{--									<i class="icon-mail-1"></i> {{ t('Conversations') }}--}}
{{--									<span class="badge badge-pill badge-important count-conversations-with-new-messages">{{$unread}}</span>--}}
{{--								</a>--}}
{{--							</li>--}}
							@endif
						<div class="dropdown-divider"></div>
							<li class="dropdown-item">
								@if (app('impersonate')->isImpersonating())
									<a href="{{ route('impersonate.leave') }}">
										<i class="icon-logout hidden-sm"></i> {{ t('Leave') }}
									</a>
								@else
						<a href="{{url('/logout')}}"><i style="margin-right: 8px;" class="fas fa-sign-out-alt"></i>Logout</a>
									@endif
							</li>
					</ul>
				</li>
					@if(auth()->check())
						@if  (auth()->user()->user_type_id == 1)
							<li class="nav-item mx-3 d-lg-none d-md-block">
								<a class="btn btn-outline-primary-upload d-block mx-auto" style="max-width: 200px" href="{{url('/posts/create')}}"><i style="margin-right: 7px;" class="fas fa-plus-circle"></i>Post a Job</a>
							</li>
								<!--<li  class="nav-item mx-6  ">-->
								<!--	<a  data-toggle="collapse" href="#expand-employer" role="button" aria-expanded="false" aria-controls="collapseExample">My Account<i class="fa fa-caret-down mx-1"></i> </a>-->
								<!--	<div class="collapse" id="expand-employer">-->
								<!--		<ul class="navbar-nav expandable">-->

								<!--			<li class="nav-item"><a href="{{ lurl('account/companies') }}"><i class="icon-town-hall"></i> {{ t('My companies') }} </a></li>-->
								<!--			<li class="nav-item"><a href="{{ lurl('account/my-posts') }}"><i class="icon-th-thumb"></i> {{ t('My ads') }} </a></li>-->

								<!--			<li class="nav-item">-->
								<!--				<a href="{{ lurl('account/conversations') }}">-->
								<!--					<i class="icon-mail-1"></i> {{ t('Conversations') }}-->
								<!--					<span class="badge badge-pill badge-important count-conversations-with-new-messages">{{$unread}}</span>-->
								<!--				</a>-->
								<!--			</li>-->
								<!--			<li class="nav-item"><a href="{{ lurl('account/transactions') }}"><i class="icon-money"></i> {{ t('Transactions') }}</a></li>-->

								<!--			<li class="nav-item"><a href="{{url('/logout')}}"><i style="margin-right: 8px;" class="fas fa-sign-out-alt"></i>Log out</a></li>-->
								<!--		</ul>-->
								<!--	</div>-->
								<!--</li>-->
						@else
							<li class="nav-item mx-6 d-lg-none d-md-block">
								<a class="btn btn-primary-upload d-block mx-auto" style="max-width: 200px"  href="{{url('/account/resumes')}}"><i style="margin-left: 7px" class="fas fa-arrow-circle-up"></i>Create Your Resume</a>
							</li>
							<!--<li  class="nav-item mx-6  ">-->
							<!--	<a href="#expand" data-toggle="collapse" href="#expand" role="button" aria-expanded="false" aria-controls="collapseExample">My Account<i class="fa fa-caret-down mx-1"></i> </a>-->
							<!--	<div class="collapse" id="expand">-->
							<!--		<ul class="navbar-nav expandable">-->
							<!--			<li class="nav-item"><a href="{{ lurl('account/resumes') }}" ><i class="icon-attach"></i> {{ t('My resumes') }} </a></li>-->
							<!--			<li class="nav-item"><a href="{{ lurl('account/favourite') }}"><i class="icon-heart"></i> {{ t('Favourite jobs') }} </a></li>-->

							<!--			<li class="nav-item">-->
							<!--				<a href="{{ lurl('account/conversations') }}">-->
							<!--					<i class="icon-mail-1"></i> {{ t('Conversations') }}-->
							<!--					<span class="badge badge-pill badge-important count-conversations-with-new-messages">{{$unread}}</span>-->
							<!--				</a>-->
							<!--			</li>-->
							<!--			<li class="nav-item"><a href="{{url('/logout')}}"><i style="margin-right: 8px;" class="fas fa-sign-out-alt"></i>Log out</a></li>-->
							<!--		</ul>-->
							<!--	</div>-->
							<!--</li>-->
						@endif
						@endif
			@endif
			</ul>	<!-- Left links -->
		</div>
		<!-- Collapsible wrapper -->
{{--	</div>--}}
	<!-- Container wrapper -->
	<!-- Navbar -->
</nav>
