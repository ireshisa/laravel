{{--//--}}
@extends('layouts.master')
@section('content')
    @include('common.spacer')
<div class="main-container">
    <div class="container">
        <div class="row">
            @if (Session::has('flash_notification'))
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">@include('flash::message')</div>
                    </div>
                </div>
            @endif
            <div class="col-md-3 page-sidebar">@include('account.inc.sidebar')</div>
            <!--/.page-sidebar-->
            <div class="col-md-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="icon-star"></i> {{ 'Reviews' }}</h2>
                    <div id="reloadBtn" class="mb30" style="display: none">
                        <a
                                href=""
                                class="btn btn-primary"
                                class="tooltipHere"
                                title=""
                                data-placement="{{ (config('lang.direction')=='rtl') ? 'left' : 'right' }}"
                                data-toggle="tooltip"
                                data-original-title="{{ t('Reload to see New Messages') }}"
                        ><i class="icon-arrows-cw"></i> {{ t('Reload') }}</a
                        >
                        <br /><br />
                    </div>
                    <div style="clear: both"></div>
                    <div class="table-responsive">
                        <form
                                name="listForm"
                                method="POST"
                                action="{{ lurl('account/'.$pagePath.'/destroy') }}"
                        >
                            {!! csrf_field() !!}
                            <div class="table-action">
{{--                                <label for="checkAll">--}}
{{--                                    <input type="checkbox" id="checkAll" /> {{ t('Select') }}: {{ t('All') }} |--}}
{{--                                    <a href="{{ url('account/reviews/delete') }}"><button--}}
{{--                                            type="submit"--}}
{{--                                            class="btn btn-sm btn-default delete-action"--}}
{{--                                    ><i class="fa fa-trash"></i> {{ t('Delete') }}--}}
{{--                                    </button></a>--}}
{{--                                </label>--}}
                                <div class="table-search pull-right col-sm-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-5 control-label text-right"
                                            >{{ t('Search') }} <br />
                                                <a
                                                        title="clear filter"
                                                        class="clear-filter"
                                                        href="#clear"
                                                >[{{ t('clear') }}]</a
                                                >
                                            </label>
                                            <div class="col-sm-7 searchpan">
                                                <input type="text" class="form-control" id="filter" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table
                                    id="addManageTable"
                                    class="
                  table table-striped table-bordered
                  add-manage-table
                  table
                  demo
                "
                                    data-filter="#filter"
                                    data-filter-text-only="true"
                            >
                                <thead>
                                <tr>
{{--                                    <th--}}
{{--                                            style="width: 2%"--}}
{{--                                            data-type="numeric"--}}
{{--                                            data-sort-initial="true"--}}
{{--                                    ></th>--}}
                                    <th style="width: 38%" data-sort-ignore="true">
                                        {{ ('Reviews') }}
                                    </th>
                                    <th style="width: 25%" data-sort-ignore="true">
                                        {{ ('Reviewed By') }}
                                    </th>
                                    <th style="width: 25%" data-sort-ignore="true">
                                        {{ ('Date & Time') }}
                                    </th>
                                    <th style="width: 10%">{{ t('Option') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php                                                                        if (isset($reviews) && $reviews->count()
                                > 0): foreach ($reviews as $key => $review): ?>
                                <tr>
{{--                                    <td class="add-img-selector">--}}
{{--                                        <div class="checkbox">--}}
{{--                                            <label--}}
{{--                                            ><input--}}
{{--                                                        type="checkbox"--}}
{{--                                                        name="entries[]"--}}
{{--                                                        value="{{ $review->id }}"--}}
{{--                                                /></label>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                    <td>
                                        <div style="word-break: break-all"  class="min-tabale">
                                            <strong>Reviewed at:</strong> {{
                        $review->created_at->formatLocalized(config('settings.app.default_datetime_format'))
                        }} <br />{{-- <strong>Reviewed by:</strong>&nbsp;{{
                        $review->reviewer->name }}<br />--}}
                                            <strong>Comment:</strong>&nbsp;{{ $review->comment
                        }}&nbsp;
                                        </div>
                                    </td>
                                    <td>{{ $review->reviewer->name }}</td>
                                    <td>{{ $review->created_at }}&nbsp;</td>
                                    <td class="action-td">
                                        <div>
                                          @if(auth()->user()->user_type_id ==1 )
                                                <p class="text-center">
                                                    <a
                                                            class="btn btn-view btn-sm" style="width: 7rem;"
                                                            href="{{ lurl('search-talent/seeker/' . $review->user_id) }}"
                                                    >
                                                        <i class="icon-eye"></i> {{ t('View') }}
                                                    </a>
                                                </p>
                                                @else
                                            <p class="text-center">
                                                <a
                                                        class="btn btn-view btn-sm" style="width: 7rem;"
                                                        href="{{ lurl('company-detail/' . $review->reviewer_id) }}"
                                                >
                                                    <i class="icon-eye"></i> {{ t('View') }}
                                                </a>
                                            </p>
                                            @endif
                                            @if (auth()->user()->user_type_id == 2)
                                            <p class="text-center">
                                                <a class="btn btn-warning btn-sm" href = "{{url('candidate-support')}}" style="width: 7rem">
                                                    <i class="fas fa-exclamation-circle"></i> {{ ('Report') }}
                                                </a>
                                            </p>
                                            @endif
                                            <p class="text-center">

                                              <a
                                                class="btn btn-danger btn-sm delete-action"

                                                href="{{ lurl('account/reviews/' . $review->id . '/delete') }}" style="width: 7rem"
                                                ><i class="fa fa-trash"></i> {{ t('Delete') }}</a
                                              >
                                            </p>

                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <nav class="" aria-label="">
                        {{ (isset($reviews)) ? $reviews->links() : '' }}
                    </nav>
                    <div style="clear: both"></div>
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
    <script
            src="{{ url('assets/js/footable.js?v=2-0-1') }}"
            type="text/javascript"
    ></script>
    <script
            src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}"
            type="text/javascript"
    ></script>
    <script type="text/javascript">
        $(function () {
            $("#addManageTable")
                .footable()
                .bind("footable_filtering", function (e) {
                    var selected = $(".filter-status").find(":selected").text();
                    if (selected && selected.length > 0) {
                        e.filter +=
                            e.filter && e.filter.length > 0 ? " " + selected : selected;
                        e.clear = !e.filter;
                    }
                });
            $(".clear-filter").click(function (e) {
                e.preventDefault();
                $(".filter-status").val("");
                $("table.demo").trigger("footable_clear_filter");
            });
            $("#checkAll").click(function () {
                checkAll(this);
            });
            $("a.delete-action, button.delete-action").click(function (e) {
                e.preventDefault();
                /* prevents the submit or reload */ var confirmation = confirm(
                    "{{ t('confirm_this_action') }}"
                );
                if (confirmation) {
                    if ($(this).is("a")) {
                        var url = $(this).attr("href");
                        if (url !== "undefined") {
                            redirect(url);
                        }
                    } else {
                        $("form[name=listForm]").submit();
                    }
                }
                return false;
            });
        });
    </script>
    <!-- include custom script for ads table [select all checkbox]  -->
    <script>
        function checkAll(bx) {
            var chkinput = document.getElementsByTagName("input");
            for (var i = 0; i < chkinput.length; i++) {
                if (chkinput[i].type == "checkbox") {
                    chkinput[i].checked = bx.checked;
                }
            }
        }
    </script>
@endsection
