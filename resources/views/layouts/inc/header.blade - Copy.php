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
	<div class="container">
		<!-- Navbar brand -->
		<img class="navbar-brand" src="Developer-assets/LOGO.png"href="#"></img>

		<!-- Toggle button -->
		<button
				class="navbar-toggler"
				type="button"
				data-mdb-toggle="collapse"
				data-mdb-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
		>
			<i class="fas fa-bars"></i>
		</button>

		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left links -->
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto navbarSupported">
				<li class="nav-item navbarSupported">
					<a class="nav-link navbarSupported" aria-current="page" href="#">Search Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Search Talent</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Find Employer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Pricing</a>
				</li>
			</ul>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
				@if(!auth()->check())
				<li class="nav-item mx-3">
					<a class="btn btn-outline-primary-upload"><i style="margin-right: 7px;" class="fas fa-plus-circle"></i>Post a Job</a>
				</li>
				<li class="nav-item mx-6">
					<a class="btn btn-primary-upload"><i style="margin-right: 7px;" class="fas fa-arrow-circle-up"></i>Upload Your Resume</a>
				</li>
				@else
					<li class="nav-item mx-3">

						<a data-toggle="modal" href="#quickLogin"  class="btn btn-outline-primary-upload"><i style="margin-right: 7px;" class="fas fa-plus-circle"></i>Post a Job</a>
					</li>
					<li class="nav-item mx-6">
						<a data-toggle="modal" href="{{ lurl(trans('routes.register')) }}" class="btn btn-primary-upload"><i style="margin-right: 7px;" class="fas fa-arrow-circle-up"></i>Upload Your Resume</a>
					</li>
				@endif
				<li class="dropdown nav-item ml-4">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"  id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="true"><img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" alt="user" width="40" class="profile-pic rounded-circle"></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#"><i style="margin-right: 8px;" class="fas fa-user-tie"></i>Employer</a>
						<a class="dropdown-item" href="#"><i style="margin-right: 8px;" class="fas fa-user"></i>Employee</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#"><i style="margin-right: 8px;" class="fas fa-sign-out-alt"></i>Log out</a>
					</ul>
				</li>
				<!-- Left links -->
		</div>
		<!-- Collapsible wrapper -->
	</div>
	<!-- Container wrapper -->
	<!-- Navbar -->
</nav>
				    
				    
				    
				  
				   
				    <!--EOF custom links-->
				    
					@if (!auth()->check())
						<li class="nav-item">
							@if (config('settings.security.login_open_in_modal'))
								<a href="#quickLogin" class="nav-link" data-toggle="modal" style="font-size:0.9rem"><i class="icon-user fa"></i> {{ t('Log In') }}</a>
							@else
								<a href="{{ lurl(trans('routes.login')) }}" class="nav-link" style="font-size:0.9rem"><i class="icon-user fa"></i> {{ t('Log In') }}</a>
							@endif
						</li>
						<li class="nav-item">
							<a href="{{ lurl(trans('routes.register')) }}" class="nav-link" style="font-size:0.9rem"><i class="icon-user-add fa"></i> {{ t('Register') }}</a>
						</li>
					@else
					
						<li class="nav-item dropdown no-arrow">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<i class="icon-user fa hidden-sm"></i>
								<span>{{ auth()->user()->name }}</span>
								<span class="badge badge-pill badge-important count-conversations-with-new-messages hidden-sm">0</span>
								<i class="icon-down-open-big fa hidden-sm"></i>
							</a>
							<ul id="userMenuDropdown" class="dropdown-menu user-menu dropdown-menu-right shadow-sm">
								<li class="dropdown-item active"><a href="{{ lurl('account') }}" style="font-size:0.9rem"><i class="icon-home"></i> {{ t('Personal Home') }}</a></li>
									
								@if (in_array(auth()->user()->user_type_id, [1]))
									<li class="dropdown-item"><a href="{{ lurl('account/companies') }}" style="font-size:0.9rem"><i class="icon-town-hall"></i> {{ t('My companies') }} </a></li>
									<li class="dropdown-item"><a href="{{ lurl('account/my-posts') }}" style="font-size:0.9rem"><i class="icon-th-thumb"></i> {{ t('My ads') }} </a></li>
									
									<li class="dropdown-item">
										<a href="{{ lurl('account/conversations') }}" style="font-size:0.9rem">
											<i class="icon-mail-1"></i> {{ t('Conversations') }}
											<span class="badge badge-pill badge-important count-conversations-with-new-messages">0</span>
										</a>
									</li>
									<li class="dropdown-item"><a href="{{ lurl('account/transactions') }}"><i class="icon-money"></i> {{ t('Transactions') }}</a></li>
									<li class="dropdown-item active" style="color:blue;">
							@if (app('impersonate')->isImpersonating())
								<a href="{{ route('impersonate.leave') }}" class="nav-link">
									<i class="icon-logout hidden-sm"></i> {{ t('Leave') }}
								</a>
							@else
								<a href="{{ lurl(trans('routes.logout')) }}" class="nav-link" style="font-size:0.9rem">
									<i class="icon-logout hidden-sm"></i> {{ t('Log Out') }}
								</a>
							@endif
						</li>
								@endif
								@if (in_array(auth()->user()->user_type_id, [2]))
									<li class="dropdown-item"><a href="{{ lurl('account/resumes') }}" style="font-size:0.9rem"><i class="icon-attach"></i> {{ t('My resumes') }} </a></li>
									<li class="dropdown-item"><a href="{{ lurl('account/favourite') }}" style="font-size:0.9rem"><i class="icon-heart"></i> {{ t('Favourite jobs') }} </a></li>
					
									<li class="dropdown-item">
										<a href="{{ lurl('account/conversations') }}" style="font-size:0.9rem">
											<i class="icon-mail-1"></i> {{ t('Conversations') }}
											<span class="badge badge-pill badge-important count-conversations-with-new-messages">0</span>
										</a>
									</li>
									<li class="dropdown-item active" style="color:blue;">
							@if (app('impersonate')->isImpersonating())
								<a href="{{ route('impersonate.leave') }}" class="nav-link">
									<i class="icon-logout hidden-sm"></i> {{ t('Leave') }}
								</a>
							@else
								<a href="{{ lurl(trans('routes.logout')) }}" class="nav-link" style="font-size:0.9rem">
									<i class="icon-logout hidden-sm"></i> {{ t('Log Out') }}
								</a>
							@endif
						</li>
								@endif
							</ul>
						</li>
					@endif
					
					@if (!auth()->check())
						<li class="nav-item postadd">
							@if (config('settings.single.guests_can_post_ads') != '1')
								<a style="color: #fff !important; font-size:0.8rem" class="btn btn-block btn-post btn-add-listing" href="#quickLogin" data-toggle="modal" >
									<i class="fa fa-plus-circle" style="color: #fff;"></i> {{ t('Create a Job ad') }}
								</a>
							@else
								<a style="color: #fff !important; font-size:0.8rem" class="btn btn-block btn-post btn-add-listing" href="{{ \App\Helpers\UrlGen::addPost() }}">
									<i class="fa fa-plus-circle" style="color: #fff;"></i> {{ t('Create a Job ad') }}
								</a>
							@endif
						</li>
						<li class="nav-item postadd">
							@if (config('settings.single.guests_can_post_ads') != '0')
								<a style="color: #fff !important; font-size:0.8rem" class="btn btn-block btn-post btn-add-listing" href="#quickLogin" data-toggle="modal" >
									<i class="fa fa-plus-circle" style="color: #fff;"></i> Upload Your Resume
								</a>
							@endif
						</li>
					@else
						@if (in_array(auth()->user()->user_type_id, [1]))
							<li class="nav-item postadd">
								<a  style="color: #fff !important; font-size:0.8rem" class="btn btn-block btn-post btn-add-listing" href="{{ \App\Helpers\UrlGen::addPost() }}">
									<i class="fa fa-plus-circle" style="color: #fff;"></i> {{ t('Create a Job ad') }}
								</a>
							</li>
						@endif
					@endif
					
					@include('layouts.inc.menu.select-language')
					
				</ul>
			</div>
		</div>
	</nav>
</div>
