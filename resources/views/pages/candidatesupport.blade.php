@extends('layouts.master')
<div class="container body-content">
    <div class="row">
         <div class="col"></div>
        <div class="col-md-6 mt-5 text-center">
            <h1>You can reach out to our support team
                any time you like by filling out
                the contact form below.</h1>
            <h4>We will reach out to you as soon as possible</h4>

        </div>
        <div class="col"></div>
    </div>
    @section('content')
        @include('common.spacer')
        <div class="main-container">
            <div class="container">
                <div class="row clearfix">

                    @if (isset($errors) and $errors->any())
                        <div class="col-xl-12">
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
                                <div class="col-xl-12">
                                    @include('flash::message')
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 grey-background">
                        <div class="contact-form">

                            <form class="form-horizontal" method="post" action="{{ lurl(trans('routes.contact')) }}">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $firstNameError = (isset($errors) and $errors->has('first_name')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <input id="first_name" name="first_name" type="text" placeholder="{{ t('First Name') }}"
                                                       class="form-control{{ $firstNameError }}" value="{{ old('first_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $lastNameError = (isset($errors) and $errors->has('last_name')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <input id="last_name" name="last_name" type="text" placeholder="{{ t('Last Name') }}"
                                                       class="form-control{{ $lastNameError }}" value="{{ old('last_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $PhonenumberError = (isset($errors) and $errors->has('PhoneNumber')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <input id="company_name" name="company_name" type="text" placeholder="<?php echo e(t('Phone Number')); ?>"
                                                       class="form-control<?php echo e($PhonenumberError); ?>" value="<?php echo e(old('PhoneNumber')); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <input id="email" name="email" type="text" placeholder="{{ t('Email Address') }}" class="form-control{{ $emailError }}"
                                                       value="{{ old('email') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <?php $typeError = (isset($errors) and $errors->has('type')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <label for="type" class="mr-3">Are you an? </label>
                                                    <div class="form-check form-check-inline mr-3">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="employercheck" value="option1" onclick="javascript:yesnoCheck();">
                                                        <label class="form-check-label" for="inlineRadio1">Employer</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="candidatecheck" value="option2" onclick="javascript:yesnoCheck();">
                                                        <label class="form-check-label" for="inlineRadio1">Candidate</label>
                                                    </div>
                                             </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group required" style="visibility:hidden;">
                                                <input id="ifemployer" name="ifemployer" type="text" placeholder="{{ t('Company Name') }}" class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                        <script>
                                            function yesnoCheck() {
                                                if (document.getElementById('employercheck').checked) {
                                                    document.getElementById('ifemployer').style.visibility = 'visible';
                                                }
                                                else document.getElementById('ifemployer').style.visibility = 'hidden';
                                            }
                                        </script>

                                        <div class="col-md-12">
                                            <?php $typeError = (isset($errors) and $errors->has('type')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <label for="usage" class="mr-3">Do you currently use Searchjobs? </label>
                                                <div class="form-check form-check-inline mr-3">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
                                                <label for="usage" class="mr-3">Subject</label>
                                                <select id="usage" class="form-control">
                                                    <option selected>Repoart a bug</option>
                                                    <option>Request a feature</option>
                                                    <option>I need support</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <?php $messageError = (isset($errors) and $errors->has('message')) ? ' is-invalid' : ''; ?>
                                            <div class="form-group required">
											<textarea class="form-control{{ $messageError }}" id="message" name="message" placeholder="{{ t('Message') }}"
                                                      rows="7">{{ old('message') }}</textarea>
                                            </div>

                                            @include('layouts.inc.tools.recaptcha', ['label' => true])

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg">{{ t('Submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
@section('before_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection