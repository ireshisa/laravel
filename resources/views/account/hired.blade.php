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
                        <i class="icon-users"></i> {{ 'Hired' }}
                    </h2>
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
                                <label for="checkAll">
                                    <input type="checkbox" id="checkAll">
                                    {{ t('Select') }}: {{ t('All') }} |
                                    <button type="submit" class="btn btn-sm btn-default delete-action">
                                        <i class="fa fa-trash"></i> {{ t('Delete') }}
                                    </button>
                                </label>
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
                                        <th style="width:60%" data-type="numeric" data-sort-initial="true">Applicants</th>
{{--                                        <th style="width:20%" data-sort-ignore="true">Cand. Name</th>--}}
{{--                                        <th style="width:15%" data-sort-ignore="true">Contact Details</th>--}}
                                        <th style="width:38%">{{ t('Option') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($applicants) && $applicants->count() > 0) :
                                        foreach ($applicants as $key => $applicant) :
                                            
                                              if (!empty($applicant->post->title) and !empty($applicant->candidate->email)) :
                                    ?>
                                    <tr>
                                        <!--<td class="add-img-selector">-->
                                        <!--    <div class="checkbox">-->
                                        <!--        <label><input type="checkbox" name="entries[]"-->
                                        <!--                value="{{ $applicant->id }}"></label>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td>
                                            <div class="d-inline-flex"><h5 class="ml-2 mr-2">Title: </h5>{{(!empty($applicant->post->title)) ? $applicant->post->title : ''}}</div><br>
                                            <div class="d-inline-flex"><h5 class="ml-2 mr-2">Name: </h5>{{(!empty($applicant->candidate->name)) ? $applicant->candidate->name : ''}}</div><br>
                                            <div class="d-inline-flex"><h5 class="ml-2 mr-2">Email: </h5>{{(!empty($applicant->post->email)) ? $applicant->candidate->email : ''}}</div><br>
                                            <div class="d-inline-flex"><h5 class="ml-2 mr-2">ContactNo: </h5>{!! (!empty($applicant->candidate->phone) ? $applicant->candidate->phone:'') !!}
                                            </div>
                                        </td>
{{--                                        <td>--}}
{{--                                            {{$applicant->candidate->name}}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                           <i class="fa fa-envelope"></i> {{$applicant->candidate->email}} <br>--}}

{{--                                            {!! (!empty($applicant->candidate->phone)?'<i class="fa fa-phone"></i>'.$applicant->candidate->phone:'') !!}--}}
{{--                                        </td>--}}
                                        <td class="action-td">
                                            <div>
                                                <p class="text-center">
                                                    <a class="btn btn-view btn-sm" style="width: 6rem;" href="{{url('/search-talent/seeker/'.$applicant->candidate_id)}}">
                                                        <i class="icon-eye"></i> {{ ('View') }}
                                                    </a>
                                                </p>

                                            </div>
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