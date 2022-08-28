<?php
$userTypes = App\Models\UserType::all();
?>


<div class="modal fade" id="quickRegister" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" style="font-size: 1.5rem;"><i class="icon-user-add"></i> {{ t('Create your account, Its free') }} </h4>

                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{{ t('Close') }}</span>
                </button>
            </div>

                        @if (isset($errors) and $errors->any() && old('quickLoginForm') !== '1')
                            <div class="col-xl-12 mt-3">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
                                    <ul class="list list-check">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (Session::has('flash_notification'))
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('flash::message')
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12 page-content ">
                            <div class="inner-box border-info">
                                <h2 class="title-2 text-center">
                                     {{ ('Welcome to SearchJobs') }}</strong>
                                </h2>

                                <?php /*     @if (
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
                                                <a  class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-fb toggle-social" data-type="0"><i class="icon-facebook-rect"></i> {!! ('Login with Facebook') !!}</a>
                                            </div>
                                        @endif
                                        @if (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
                                                <a type="button" class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-danger toggle-social" data-type="1"><i class="icon-googleplus-rect"></i> {!! ('Login with Google') !!}</a>
                                            </div>
                                        @endif
                                    </div>
                                     <div class="row mb-3 d-flex justify-content-center pl-3 pr-3">
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
                                    </div>

                                    <div class="row d-flex justify-content-center loginOr">
                                        <div class="col-xl-12 mb-1">
                                            <hr class="hrOr">
                                            <span class="spanOr rounded">{{ t('or') }}</span>
                                        </div>
                                    </div>
                                @endif */ ?>

                                <div class="row mt-5">
                                    <div class="col-xl-12">
                                        <form id="signupForm" class="form-horizontal" method="POST" action="{{ lurl(trans('routes.register')) }}" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <fieldset>
                                            <?php
                                            /*
                                            <!-- gender_id -->
                                            <?php $genderIdError = (isset($errors) and $errors->has('gender_id')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group row required">
                                                <label class="col-md-3 col-form-label{{ $genderIdError }}">{{ t('Gender') }} <sup>*</sup></label>
                                                <div class="col-md-7">
                                                    <select name="gender_id" id="genderId" class="form-control selecter{{ $genderIdError }}">
                                                        <option value="0"
                                                                @if (old('gender_id')=='' or old('gender_id')==0)
                                                                    selected="selected"
                                                                @endif
                                                        > {{ t('Select') }} </option>
                                                        @foreach ($genders as $gender)
                                                            <option value="{{ $gender->tid }}"
                                                                    @if (old('gender_id')==$gender->tid)
                                                                        selected="selected"
                                                                    @endif
                                                            >
                                                                {{ $gender->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            */
                                            ?>
                                            
                                            <!-- Firstname -->
                                                <?php $FirstnameError = (isset($errors) and $errors->has('firstname')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required">
                                                    <label class="col-md-4 col-form-label">{{ ('First Name') }} <sup>*</sup></label>
                                                    <div class="col-md-6">
                                                        <input required name="firstname2" placeholder="{{ ('First Name') }}" class="form-control input-md{{ $FirstnameError }}" type="text" value="{{ old('firstname') }}" id="input1">
                                                    </div>
                                                </div>

                                            <!-- Lastname -->
                                                <?php $LastnameError = (isset($errors) and $errors->has('lastname')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required">
                                                    <label class="col-md-4 col-form-label">{{ ('Last Name') }} <sup>*</sup></label>
                                                    <div class="col-md-6">
                                                        <input required name="lastname" placeholder="{{ ('Last Name') }}" class="form-control input-md{{ $LastnameError }}" type="text" value="{{ old('lastname') }}" id="input2">
                                                    </div>
                                                </div>


<script>
            
		document.getElementById("input1").addEventListener("keypress", function(evt){

  // Get value of textbox and split into array where there is one or more continous spaces
  var words = this.value.split(/\s+/);
  var numWords = words.length;    // Get # of words in array
  var maxWords = 1;
  
  // If we are at the limit and the key pressed wasn't BACKSPACE or DELETE,
  // don't allow any more input
  if(numWords > maxWords){
    evt.preventDefault(); // Cancel event
  }
});


		document.getElementById("input2").addEventListener("keypress", function(evt){

  // Get value of textbox and split into array where there is one or more continous spaces
  var words = this.value.split(/\s+/);
  var numWords = words.length;    // Get # of words in array
  var maxWords = 1;
  
  // If we are at the limit and the key pressed wasn't BACKSPACE or DELETE,
  // don't allow any more input
  if(numWords > maxWords){
    evt.preventDefault(); // Cancel event
  }
});

</script>
                                            <!-- name -->
                                                <?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required">
                                                    <label class="col-md-4 col-form-label">{{ ('Full Name') }} <sup>*</sup></label>
                                                    <div class="col-md-6">
                                                        <input name="name" placeholder="{{ ('Full Name') }}" class="form-control input-md{{ $nameError }}" type="text" value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                

                                                <!-- user_type_id -->
                                                <?php $userTypeIdError = (isset($errors) and $errors->has('user_type_id')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required">
                                                    <label class="col-md-4 col-form-label">{{ t('You are a') }} <sup>*</sup></label>
                                                    <div class="col-md-6">
                                                        @foreach ($userTypes as $type)
                                                            <div class="form-check form-check-inline pt-2">
                                                                <input type="radio"
                                                                       name="user_type_id"
                                                                       id="userTypeId-{{ $type->id }}"
                                                                       class="form-check-input user-type{{ $userTypeIdError }}"
                                                                       value="{{ $type->id }}" {{ (old('user_type_id', request()->get('type'))==$type->id) ? 'checked="checked"' : '' }}
                                                                >
                                                                <label class="form-check-label" for="user_type_id-{{ $type->id }}">
                                                                    {{ t('' . $type->name) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <!-- country_code -->
                                                @if (empty(config('country.code')))
                                                    <?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
                                                    <div class="form-group row required">
                                                        <label class="col-md-4 col-form-label{{ $countryCodeError }}" for="country_code">{{ t('Your Country') }} <sup>*</sup></label>
                                                        <div class="col-md-6">
                                                            <select id="countryCode" name="country_code" class="form-control sselecter{{ $countryCodeError }}">
                                                                <option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>
                                                                @foreach ($countries as $code => $item)
                                                                    <option value="{{ $code }}" {{ (old('country_code', (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0)==$code) ? 'selected="selected"' : '' }}>
                                                                        {{ $item->get('name') }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input id="countryCode" name="country_code" type="hidden" value="{{ config('country.code') }}">
                                                @endif

                                                @if (isEnabledField('phone'))
                                                <!-- phone -->
                                                    <?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
                                                    <div class="form-group row required">
                                                        <label class="col-md-4 col-form-label">{{ t('Phone') }}
                                                            @if (!isEnabledField('email'))
                                                                <sup>*</sup>
                                                            @endif
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country', config('country.code'))) !!}</span>
                                                                </div>

                                                                <input name="phone"
                                                                       placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('Phone Number') }}"
                                                                       class="form-control input-md{{ $phoneError }}"
                                                                       type="text"
                                                                       value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}"
                                                                >

               <!--                                                 <div class="input-group-append tooltipHere" data-placement="top"-->
               <!--                                                      data-toggle="tooltip"-->
               <!--                                                      data-original-title="{{ t('Hide the phone number on the ads.') }}">-->
															<!--<span class="input-group-text">-->
															<!--	<input name="phone_hidden" id="phoneHidden" type="checkbox"-->
               <!--                                                        value="1" {{ (old('phone_hidden')=='1') ? 'checked="checked"' : '' }}>&nbsp;<small>{{ t('Hide') }}</small>-->
															<!--</span>-->
               <!--                                                 </div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (isEnabledField('email'))
                                                <!-- email -->
                                                    <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                                                    <div class="form-group row required">
                                                        <label class="col-md-4 col-form-label" for="email">{{ t('Email') }}
                                                            @if (!isEnabledField('phone'))
                                                                <sup>*</sup>
                                                            @endif
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="icon-mail"></i></span>
                                                                </div>
                                                                <input id="email"
                                                                       name="email"
                                                                       type="email"
                                                                       class="form-control{{ $emailError }}"
                                                                       placeholder="{{ t('Email') }}"
                                                                       value="{{ old('email') }}"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (isEnabledField('username'))
                                                <!-- username -->
                                                    <?php $usernameError = (isset($errors) and $errors->has('username')) ? ' is-invalid' : ''; ?>
                                                    <div class="form-group row required">
                                                        <label class="col-md-4 col-form-label" for="email">{{ t('Username') }}</label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                                                </div>
                                                                <input id="username"
                                                                       name="username"
                                                                       type="text"
                                                                       class="form-control{{ $usernameError }}"
                                                                       placeholder="{{ t('Username') }}"
                                                                       value="{{ old('username') }}"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            <!-- password -->
                                                <?php $passwordError = (isset($errors) and $errors->has('reg_password')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required">
                                                    <label class="col-md-4 col-form-label" for="password">{{ t('Password') }} <sup>*</sup></label>
                                                    <div class="col-md-6">
                                                        <input id="password" name="reg_password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('Password') }}">
                                                        <br>
                                                        <input id="password_confirmation" name="reg_password_confirmation" type="password" class="form-control{{ $passwordError }}"
                                                               placeholder="{{ t('Password Confirmation') }}">
                                                        <small id="" class="form-text text-muted">
                                                            {{ t('At least :num characters', ['num' => config('larapen.core.passwordLength.min', 6)]) }}
                                                        </small>
                                                    </div>
                                                </div>

                                                @if (config('larapen.core.register.showCompanyFields'))
                                                    <div id="companyBloc">
                                                        <div class="content-subheading">
                                                            <i class="icon-town-hall fa"></i>
                                                            <strong>{{ t('Company Information') }}</strong>
                                                        </div>

                                                        @include('account.company._form', ['originForm' => 'user'])
                                                    </div>
                                                @endif

                                                @if (config('larapen.core.register.showResumeFields'))
                                                    <div id="resumeBloc">
                                                        <div class="content-subheading">
                                                            <i class="icon-attach fa"></i>
                                                            <strong>{{ t('Resume') }}</strong>
                                                        </div>

                                                        @include('account.resume._form', ['originForm' => 'user'])
                                                    </div>
                                                @endif

                                                @include('layouts.inc.tools.recaptcha', ['colLeft' => 'col-md-4', 'colRight' => 'col-md-6'])

                                            <!-- term -->
                                                <?php $termError = (isset($errors) and $errors->has('term')) ? ' is-invalid' : ''; ?>
                                                <div class="form-group row required"
                                                     style="margin-top: -10px;">
                                                    <label class="col-md-4 col-form-label"></label>
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input name="term" id="term"
                                                                   class="form-check-input{{ $termError }}"
                                                                   value="1"
                                                                   type="checkbox" {{ (old('term')=='1') ? 'checked="checked"' : '' }}
                                                            >

                                                            <label class="form-check-label" for="term">
                                                                {!! t('I have read and agree to the <a :attributes>Terms & Conditions</a>', ['attributes' => getUrlPageByType('terms')]) !!}
                                                            </label>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                </div>

                                                <!-- Button  -->
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label"></label>
                                                    <div class="col-md-8">
                                                        <button id="signupBtn" class="btn btn-success btn-lg"> {{ t('Register') }} </button>
                                                    </div>
                                                </div>
<h3 class="text-center py-3">OR</h3>
					<div class="col-xl-12">
						<div class="row d-flex justify-content-center">
<div class="row mb-3 d-flex justify-content-center pl-3 pr-3">
    
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
											<a class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-fb toggle-social" style="font-size: 0.8rem;" data-type="0"><i class="icon-facebook-rect"></i> Login with Facebook</a>
										</div>
										
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">
											<a  class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-danger toggle-social" style="font-size: 0.8rem;" data-type="1"><i class="icon-googleplus-rect"></i> Login with Google</a>
										</div>
																	</div>
						</div>
					</div>
                                                <div style="margin-bottom: 30px;"></div>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

            <div class="modal fade" id="socialLoginModel" tabindex="-1" role="dialog" aria-labelledby="socialLoginModel" aria-hidden="true" style="text-align: -webkit-center; ">
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
                                <input class="form-check-input" type="radio" name="userType" id="userType" value="1" checked>
                                <label class="form-check-label radio-inline" for="flexRadioDefault1">Employer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="userType" id="userType" value="2">
                                <label class="form-check-label radio-inline" for="flexRadioDefault2">Employee</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="#socialLoginModel">Close</button>
                            <button id="social-login" type="button" class="btn btn-info">{!! ('Login') !!}</button>
                        </div>
                    </div>
                </div>
            </div>


@section('after_styles')
    <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    @if (config('lang.direction') == 'rtl')
        <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
    @endif
    <style>
        .krajee-default.file-preview-frame:hover:not(.file-preview-error) {
            box-shadow: 0 0 5px 0 #666666;
        }
    </style>
@endsection

@section('after_scripts')
    <script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
    @if (file_exists(public_path() . '/assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js'))
        <script src="{{ url('assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js') }}" type="text/javascript"></script>
    @endif

    <script >
        var userTypeId = '<?php echo old('user_type_id', request()->get('type')); ?>';

        $(document).ready(function ()
        {
            /* Set user type */
            setUserType(userTypeId);
            $('.user-type').click(function () {
                userTypeId = $(this).val();
                setUserType(userTypeId);
            });

            /* Submit Form */
            $("#signupBtn").click(function () {
                $("#signupForm").submit();
                return false;
            });


        });
        


        
    </script>
@endsection