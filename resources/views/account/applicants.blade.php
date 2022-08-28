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

            <div class="col-md-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2">
                        <i class="icon-users"></i> Pending Approval
                    </h2>
                    <p class="mb-4">These are the candidates who have shown interest in your job post and awaiting your approval to attend an interview
and the candidates who you have shown interest and waiting for their approval for your job posts.</p>
                    <div id="reloadBtn" class="mb30" style="display: none;">
                        <a href="" class="btn btn-primary" class="tooltipHere" title=""
                            data-placement="{{ (config('lang.direction')=='rtl') ? 'left' : 'right' }}"
                            data-toggle="tooltip" data-original-title="{{ t('Reload to see New Messages') }}"><i
                                class="icon-arrows-cw"></i> {{ t('Reload') }}</a>
                        <br><br>
                    </div>

                    <div style="clear:both"></div>

                    <div class="table-responsive">
                        <form name="listForm" method="POST" action="{{ lurl('account/'.$pagePath.'/delete') }}">
                            {!! csrf_field() !!}
                            <div class="table-action">
                                <!--<label for="checkAll">-->
                                <!--    <input type="checkbox" id="checkAll">-->
                                <!--    {{ t('Select') }}: {{ t('All') }} |-->
                                <!--    <button type="submit" class="btn btn-sm btn-default delete-action">-->
                                <!--        <i class="fa fa-trash"></i> {{ t('Delete') }}-->
                                <!--    </button>-->
                                <!--</label>-->
                                <div class="table-search pull-right col-sm-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-5 control-label text-right">{{ t('Search') }} <br>
                                                <a title="clear filter" class="clear-filter"
                                                    href="#clear">[{{ t('clear') }}]</a>
                                            </label>
                                            <div class="col-sm-7 searchpan">
                                                <input type="text" class="form-control" id="filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="addManageTable"
                                class="table table-striped table-bordered add-manage-table table demo"
                                data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                    <tr>
                                        <!--<th style="width:2%" data-type="numeric" data-sort-initial="true"></th>-->
                                        <th style="width:40%" data-sort-ignore="true">{{ ('Applicants') }}</th>
                                        <th style="width:14%" data-sort-ignore="true">Sent By</th>
                                        <th style="width:14%" data-sort-ignore="true">Status</th>
                                        <th style="width:26%">{{ t('Option') }}</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    if (isset($applicants) && $applicants->count() > 0) :
                                        foreach ($applicants as $key => $applicant) :
                                            
                                            if (!empty(\App\Models\User::find($applicant->from_user_id)->firstname  )):
                                            
                                    ?>
                                    <tr>
                                        <!--<td class="add-img-selector">-->
                                        <!--    <div class="checkbox">-->
                                        <!--        <label><input type="checkbox" name="entries[]"-->
                                        <!--                value="{{ $applicant->id }}"></label>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td>
                                            <div style="word-break:break-all;" class="min-tabale">
                                                <strong>Applied at:</strong>
                                                {{ $applicant->created_at->formatLocalized(config('settings.app.default_datetime_format')) }}

                                                <i class="icon-flag text-primary"></i><br>
                                                 @if(auth()->user()->id != $applicant->to_user_id)
                                                <strong>{{ ('Job') }}:</strong> {{$applicant->post->title}}</a><br>
                                                <strong>{{ ('Applicant Name') }}:</strong>&nbsp;{{ \App\Models\User::find($applicant->to_user_id)->firstname }}<br>
                                                <strong>{{ ('Company Name') }}:</strong>&nbsp;{{ $applicant->post->company_name }}
{{--                                                <strong>{{ t('Email') }}:</strong>&nbsp;{{ \App\Models\User::find($applicant->from_user_id)->email }}<br>--}}
                                                @else
                                                    <strong>{{ ('Job') }}:</strong> {{$applicant->post->title}}</a><br>
                                                    <strong>{{ ('Applicant Name') }}:</strong>&nbsp;{{ \App\Models\User::find($applicant->from_user_id)->firstname }}<br>
                                                    <strong>{{ ('Company           Name') }}:</strong>&nbsp;{{ $applicant->post->company_name }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                             @if($applicant->fromUser->user_type_id == 1)
                                            <div class="text-center">
                                                <span  style="display:block; border-radius: 10px;" class="p-2 btn-outline-primary conneted">{{ $applicant->post->company_name }}</button>
                                            </div>
                                            @else
                                                <div class="text-center">
                                                    <!--<a href="https://searchjobs.global/search-talent/seeker/{{ $applicant->from_user_id }}" target="_blank">-->
                                                        <span  style="display:block; border-radius: 10px;" class="p-2 btn-outline-primary conneted">{{ \App\Models\User::find($applicant->from_user_id)->firstname }}</span>
                                                        <!--</a>-->
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($applicant->is_approved == 0 && empty($applicant->deleted_by))
                                                <div class="text-center">
                                                    <span style="display:block; border-radius: 10px;" class="p-2 btn-outline-primary conneted text-center">Pending Approval</span>
                                                </div>
                                            @elseif (!empty($applicant->deleted_by))
                                                <div class="text-center">
                                                    <span class=" btn-outline-primary conneted text-center">Request Denied</span>
                                                </div>
                                            @endif
                                        </td>
                                       <td class="action-td text-center">
                                            @if ($applicant->from_user_id == auth()->user()->id && $applicant->deleted_by == null)


                                                <p class="text-center">
                                                    <a class="btn btn-danger btn-sm delete-action mt-3" style="width: 6rem;" href="{{ lurl('account/conversations/' . $applicant->id . '/deletePending') }}">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </p>
                                                <p class="text-center">
                                                    <a class="btn btn-view btn-sm" style="width: 6rem"
                                                       href="{{ url('search-talent/seeker/'. $applicant->to_user_id) }}">
                                                        <i class="fa fa-eye"></i> {{ t('View') }}</a>
                                                </p>
                                            @elseif($applicant->from_user_id == auth()->user()->id && $applicant->deleted_by != null)
                                               
                                                <a class="btn btn-danger btn-sm" style="width: 5rem;"
                                                   href="{{ lurl('account/conversations/' . $applicant->id . '/delete') }}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            @else
                                            <div>
                                                <p class="text-center">
                                                    @if($showApprove)
                                                    <a class="btn btn-view btn-sm" style="width: 7rem;"
                                                        href="{{ lurl('account/conversations/' . $applicant->id . '/approve') }}">
                                                        <i class="icon-check"></i> {{ ('Approve') }}
                                                    </a>
                                                        @else
                                                        <a class="btn btn-view btn-sm " style="width: 7rem;"
                                                           href="{{ lurl('account/package')}}">
                                                            <i class="icon-eye"></i> Buy Package
                                                        </a>
                                                    @endif
                                                </p>
                                                <p class="text-center">
                                                    <a class="btn btn-danger btn-sm delete-action" style="width: 7rem;"
                                                        href="{{ lurl('account/conversations/' . $applicant->id . '/delete') }}">
                                                        <i class="fa fa-trash"></i> Decline
                                                    </a>
                                                </p>
                                                <p class="text-center">
                                                    <a class="btn btn-primary btn-sm" style="width: 6rem"
                                                       href="{{ url('search-talent/seeker/'. $applicant->from_user_id) }}">
                                                        <i class="fa fa-eye"></i> {{ t('View') }}</a>
                                                </p>
                                            </div>
                                                @endif
                                        </td>
                                    </tr>
                                     <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <nav class="" aria-label="">

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

@section('after_scripts')
<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('#addManageTable').footable().bind('footable_filtering', function(e) {
        var selected = $('.filter-status').find(':selected').text();
        if (selected && selected.length > 0) {
            e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
            e.clear = !e.filter;
        }
    });

    $('.clear-filter').click(function(e) {
        e.preventDefault();
        $('.filter-status').val('');
        $('table.demo').trigger('footable_clear_filter');
    });

    $('#checkAll').click(function() {
        checkAll(this);
    });

    $('a.delete-action, button.delete-action').click(function(e) {
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