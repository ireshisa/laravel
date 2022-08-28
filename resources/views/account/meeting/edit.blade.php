{{--
 * JobClass - Job Board Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
// From Company's Form
$classLeftCol = 'col-md-3';
$classRightCol = 'col-md-9';

if (isset($originForm)) {
    // From User's Form
    if ($originForm == 'user') {
        $classLeftCol = 'col-md-3';
        $classRightCol = 'col-md-7';
    }

    // From Post's Form
    if ($originForm == 'post') {
        $classLeftCol = 'col-md-3';
        $classRightCol = 'col-md-8';
    }
}
?>
@extends('layouts.master')

@section('content')
    @include('common.spacer')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 page-sidebar">
                    @include('account.inc.sidebar')
                </div>
                <!--/.page-sidebar-->

                <div class="col-md-9 page-content">

                    @include('flash::message')

                    @if (isset($errors) and $errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
                            <ul class="list list-check">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-town-hall"></i> Edit Interview Meeting </h2>

                        <div style="clear: both;"></div>

                        <div class="panel-group" id="accordion">

                            <!-- COMPANY -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#companyPanel" data-toggle="collapse" data-parent="#accordion"> Interview Informations </a></h4>
                                </div>
                                <div class="panel-collapse collapse show" id="companyPanel">
                                    <div class="card-body">
                                        <form name="meeting" class="form-horizontal" role="form" method="POST" action="{{ url('account/meetings/'.$meeting->id.'/update') }}"  id="meeting_form" onsubmit="return validateMeetingform(this.id)" >
                                            {!! csrf_field() !!}
{{--                                            <input name="_method" type="hidden" value="PUT">--}}
                                            <input name="panel" type="hidden" value="resumePanel">
                                            <input name="meeting_id" type="hidden" value="{{ $meeting->id }}">

                                            @include('account.meeting.edit_form')

                                            <div class="form-group">
                                                <div class="offset-md-3 col-md-9"></div>
                                            </div>

                                            <!-- Button -->
                                            <div class="form-group">
                                                <div class="offset-md-3 col-md-9">
                                                    <button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/.row-box End-->

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
    .invalid{
        border-color: red ;
    }
</style>

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
@endsection



<script>


    function validateMeetingform(formid) {

        var isValid = true;

        var form = $("form#" + formid);




        form.find('select.required').each(function () {
            if ($(this).val() === null || $(this).val() === "") {
                // $(this).addClass('invalid');
                isValid = false;
            }


        });

        form.find('input.required').each(function () {


            if ($(this).val() === null || $(this).val() === "") {
                //   $(this).addClass('invalid');
                isValid = false;
            }


        });

        if( !isValid ) {

            alert("Please fill mandatory fields!");
            return false;
        } else {
            return true;
        }


    }


</script>
<script src="{{url('/assets/js/formsubmit.js')}}"></script>
<script>


    $(function () {
        $("#datepicker").datepicker();

    });

    $(document).ready(function () {
        console.log("dfksfksfk");
        $("#post_id").on('change',function() {
            console.log($(this).val());
            getData("{{url('account/candidates/')}}/"+$(this).val()).then((res)=>{
                $("select[name='candidate_id'] option").remove();
                $("select[name='candidate_id']").parent().find(".error").remove();


                var html = "<option>--Select Candidate--</option>";
                if (res.code=="success")
                {

                    res.data.forEach(function(item){
                        if (item.from_user.user_type_id == 2)
                        {
                            html += "<option value='"+item.from_user.id+"'>"+item.from_user.name+"</option>";
                        }
                        else {
                            html += "<option value='"+item.to_user.id+"'>"+item.to_user.name+"</option>";

                        }

                    })

                }
                else {
                    $("select[name='candidate_id']").parent().append("<label class='error'>There are no Candidates Found for this Job</label>")
                }
                $("select[name='candidate_id']").append(html);

            },(error)=> {
                $("select[name='candidate_id']").parent().append("<label class='error'>There was an Error Found. Please Try Again</label>")

            });
        });
    })
</script>
