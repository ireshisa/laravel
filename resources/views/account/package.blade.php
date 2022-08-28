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
                @if (isset($package))
                <div class="inner-box">
                    <h2 class="title-2">
                        <i class="icon-users"></i> {{ 'Current Package' }}
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
                        <table id="package-table"
                               class="table table-striped table-bordered add-manage-table table demo">
                            <thead>
                            <tr>
                                <th>Current Package</th>
                                <th>Available Connects</th>
                                <th>Expiry Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="{{($package->pivot->expiry_date > date('Y-m-d H:i:s') && $package->pivot->available_connects >0 ?'bg-success':'bg-danger')}} ">
                                    <td>{{$package->short_name}}</td>
                                    <td>{{$package->pivot->available_connects}}</td>
                                    <td>{{$package->pivot->expiry_date}}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>


                    <nav class="" aria-label="">

                    </nav>

                    <div style="clear:both"></div>

                </div>
                @endif
                <div class="inner-box mt-5">
                    <h2 class="title-2">
                        <i class="icon-users"></i> {{ 'Buy/Upgrade Package' }}
                    </h2>
                    @include('post.createOrEdit.multiSteps.package_mid')
                <style>
                    a#skipBtn {
                        display: none;
                    }
                </style>
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