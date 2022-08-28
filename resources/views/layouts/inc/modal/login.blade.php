<div class="modal fade" id="quickLogin" tabindex="-1" role="dialog">
	<div class="modal-dialog  modal-sm">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title"><i class="icon-login fa"></i> {{ t('Log In') }} </h4>
				
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">{{ t('Close') }}</span>
				</button>
			</div>
			
			<form role="form" method="POST" action="{{ lurl(trans('routes.login')) }}">
				{!! csrf_field() !!}
				<div class="modal-body px-4 py-2 login-modal">
					<h2 class="text-center my-2">Welcome to Search Jobs!</h2>

					@if (isset($errors) and $errors->any() and old('quickLoginForm') === '1')
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<ul class="list list-check">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<?php
					$loginValue = (session()->has('login')) ? session('login') : old('login');
					$loginField = getLoginField($loginValue);
					if ($loginField == 'phone') {
						$loginValue = phoneFormat($loginValue, old('country', config('country.code')));
					}
					?>
				<!-- login -->
					<?php $loginError = (isset($errors) and $errors->has('login')) ? ' is-invalid' : ''; ?>
					<div class="form-group">
						{{-- <label for="login" class="control-label">{{ t('Login') . ' (' . getLoginLabel() . ')' }}</label> --}}
						<div class="input-icon">
							<i class="icon-user fa"></i>
							<input required id="mLogin" name="login" type="text" placeholder="{{ getLoginLabel() }}" class="form-control{{ $loginError }}" value="{{ $loginValue }}">
						</div>
					</div>
					
					<!-- password -->
					<?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
					<div class="form-group">
						{{--<label for="password" class="control-label">{{ t('Password') }}</label>--}}
						<div class="input-icon">
							<i class="icon-lock fa"></i>
							<input required id="mPassword" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('Password') }}" autocomplete="off">
						</div>
					</div>
					<!-- remember -->
					
					
					<?php $rememberError = (isset($errors) and $errors->has('remember')) ? ' is-invalid' : ''; ?>
					<div class="form-group">
						<label class="checkbox form-check-label pull-left mt-2" style="font-weight: normal;">
							<input type="checkbox" value="1" name="remember" id="mRemember" class="{{ $rememberError }}"> {{ t('Keep me logged in') }}
						</label>
						<p class="pull-right mt-2">
							<a href="{{ lurl('password/reset') }}"> Forgot Password</a>
						</p>
						<div style=" clear:both"></div>
					</div>
					
					@include('layouts.inc.tools.recaptcha', ['label' => true])
					
					<input type="hidden" name="quickLoginForm" value="1">

						<div class="row">
							<div class="col-md-12 loginpopbuttone">
								<button type="submit" class="btn pull-right float-right login-btn login">{{ t('Log In') }}</button>
								<a href="{{url('register')}}" class="btn btn-black float-right login-btn mr-3">Create an Account</a>
							</div>
						</div>
						<h4 class="text-center mt-3 color-black">OR</h4>
						<div class="d-flex justify-content-center align-items-center mt-3">

								@if (
								config('settings.social_auth.social_login_activation')
								and (
									(config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
									or (config('settings.social_auth.linkedin_client_id') and config('settings.social_auth.linkedin_client_secret'))
									or (config('settings.social_auth.twitter_client_id') and config('settings.social_auth.twitter_client_secret'))
									or (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
									)
								)
								<div class="row mb-3 d-flex justify-content-center pl-3 pr-3">
									@if (config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
											<a  class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-fb toggle-social" style="font-size: 0.8rem;" data-type="0"><i class="icon-facebook-rect"></i> {!! ('Login with Facebook') !!}</a>
										</div>
									@endif
									@if (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
											<a  class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-danger toggle-social" style="font-size: 0.8rem;" data-type="1"><i class="icon-googleplus-rect"></i> {!! ('Login with Google') !!}</a>
										</div>
									@endif
								</div>
								<?php /*<div class="row mb-3 d-flex justify-content-center pl-3 pr-3">
                                        @if (config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-fb">
                                                    <a href="{{ lurl('auth/facebook/employee') }}" style="font-size: 0.8rem;" class=""><i class="icon-facebook-rect"></i> {!! ('Login with Facebook as Employee') !!}</a>
                                                </div>
                                            </div>
                                        @endif
                                        @if (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-danger">
                                                    <a href="{{ lurl('auth/google/employee') }}" style="font-size: 0.8rem;" class="btn-danger"><i class="icon-googleplus-rect"></i> {!! ('Login with Google as Employee') !!}</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div> */ ?>
							@endif
						</div>
				</div>

			</form>
		
		</div>
	</div>
</div>

                <div class="modal fade" id="socialLoginModel" tabindex="-1" role="dialog" aria-labelledby="socialLoginModel" aria-hidden="true" style="text-align: -webkit-center;  z-index: 9000000;">">
					<div class="modal-dialog modal-sm">
						<div class="modal-content modal-sm text-center">
							<div class="modal-header">
								<h4 class="modal-title" id="socialLoginModel">You are a</h4>
								<button type="button" class="close" data-dismiss="modal" data-target="#socialLoginModel" aria-label="Close"><span aria-hidden="true">×</span></button>
							</div>
							<div class="modal-body" style="display: flex;
    padding: 1rem;
    flex-direction: column;
    align-items: flex-start;
">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="userType" id="userType1" value="1" checked>
									<label class="form-check-label radio-inline" for="flexRadioDefault1">Company</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="userType" id="userType2" value="2">
									<label class="form-check-label radio-inline" for="flexRadioDefault2">Job seeker</label>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" data-target="#socialLoginModel">Close</button>
								<button id="social-login" type="button" class="btn btn-info">{!! ('Login') !!}</button>
							</div>
						</div>
					</div>
				</div>


