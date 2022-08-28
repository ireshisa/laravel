{{--//--}}
@extends('layouts.master')
@section('content')
    @include('common.spacer')
    <link
            rel="stylesheet"
            href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
    />
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <div class="main-container">
        <div class="container">
            <div class="row">
                <!-- @if (Session::has('flash_notification'))
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">@include('flash::message')</div>
                        </div>
                    </div>
                @endif -->
                <div class="col-md-3 page-sidebar">@include('account.inc.sidebar')</div>
                <!--/.page-sidebar-->
                <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-users"></i> {{ 'Interview' }}</h2>
                        @if(auth()->user()->user_type_id == 1)
							<p class="mb-4">You can schedule interviews with connected applicants here.</p>
						@endif
                        <!--<p>You can schedule interviews with connected applicants here.</p>-->
                        @if(auth()->user()->user_type_id ==1)
                            <div class="">
                                <a
                                        href="{{ lurl('account/meetings/new') }}"
                                        class="btn btn-primary float-left m-2"
                                ><i class="icon-plus"></i> Schedule Interview</a
                                >
                            </div>
                        @endif
                             <div style="clear: both"></div>
                          <div class="">
                                <a onclick="viewtable('complete')"
                                        href="#" 
                                        class="btn btn-danger float-left m-2"
                                ><i class="icon-ok"></i> Complete Interviews</a
                                >
                            </div>
                            
                              <div class="">
                                <a onclick="viewtable('pending')"
                                        href="#"
                                        class="btn btn-danger float-left m-2"
                                ><i class="icon-cog"></i> Pending Interviews</a
                                >
                            </div>
                            
                            
                            
                            
                        <div style="clear: both"></div>
      
                        <form name="listForm" method="post" action="{{url('/account/meetings/delete')}}">
                            <div class="table-responsive">
                                <div class="table-action mt-2">
                                    @if(auth()->user()->user_type_id ==1)
                                        <label for="checkAll">
                                            <input type="checkbox" id="checkAll" /> {{ t('Select') }}: {{ t('All') }} |
                                            <button
                                                    type="submit"
                                                    class="btn btn-sm btn-default delete-action">
                                                <i class="fa fa-trash"></i> {{ t('Delete') }}
                                            </button>
                                        </label>
                                    @endif
                                    <div class="table-search pull-right col-sm-7">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-5 control-label text-right">{{ t('Search') }} <br />
                                                    <a
                                                            title="clear filter"
                                                            class="clear-filter"
                                                            href="#clear"
                                                    >[{{ t('clear') }}]</a>
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
                                        class="table table-striped table-bordered add-manage-table table demo "
                                        data-filter="#filter"
                                        data-filter-text-only="true"
                                >
                                    <thead>
                                    <tr>
                                        @if(auth()->user()->user_type_id ==1 )
                                        <th

                                                data-type="numeric"
                                                data-sort-initial="true"
                                        ></th>@endif
                                        <th style="width: 25%" data-sort-ignore="true">
                                            {{ ('Title') }}
                                        </th>
                                        <th style="width: 15%" data-sort-ignore="true">
                                            {{ ('Employer') }}
                                        </th>
                                        @if(auth()->user()->user_type_id ==1)
                                            <th style="width: 15%" data-sort-ignore="true">
                                                {{ ('Candidate') }}
                                            </th>
                                        @endif
                                        <th data-sort-ignore="true">
                                            {{ ('Time,Date,Location ') }}
                                        </th>
                                        @if(auth()->user()->user_type_id ==1 )
                                            <th style="width: 15%">Report Status</th>
                                                <th style="width: 15px"></th>
                                        @endif
                                        @if(auth()->user()->user_type_id ==2 )
                                            <th style="width: 15px"></th>
                                        @endif
                                    </tr>
                                    </thead>
                                    

                                    
                                    
                                    <tbody id="pending">
                                    <?php
                                    if(isset($meetings) && $meetings->count() > 0) : foreach ($meetings as $key => $meeting) : ?>
                                        <?php 
                                      $date2 = date('Y-m-d');
                                      if($meeting->m_date <= $date2 )
                                    {
                                   
                                   ?>
                                    
                                    <tr>
                                        @if(auth()->user()->user_type_id ==1 )
                                        <td class="add-img-selector">
                                          
                                            <div class="checkbox">
                                                <label
                                                ><input
                                                            type="checkbox"
                                                            name="entries[]"
                                                            value="{{ $meeting->id }}"
                                                    /></label>
                                            </div>
                                        </td>@endif
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ $meeting->employer->name }}</td>
                                        @if(auth()->user()->user_type_id ==1)
                                            <td>@isset ($meeting->candidate->name){{ $meeting->candidate->name }}@endempty</td>
                                        @endif
                                        <td>
                                            <div class="text-center">
                                                {{ $meeting->m_from }} - {{ $meeting->m_to }}
                                                <div class="text-center">{{$meeting->m_date }}</div>
                                                <div class="text-center">{{$meeting->m_location }}</div>
                                            </div>
                                        </td>
                                        @if(auth()->user()->user_type_id ==1)
                                            @if(!empty($meeting->report))
                                                @php $statuses = [["text"=>"Requested","class"=>"border-primary"],
                                                ["text"=>"Approved","class"=>"border-success"],
                                                ["text"=>"Denied","class"=>"border-danger"]];
                                             @endphp
                                        <td>
                                        <span class="py-1 px-2 border {{$statuses[$meeting->report->status_id]['class']}}">{{$statuses[$meeting->report->status_id]['text']}}</span>
                                        </td>
                                        @endif
                                         @if(empty($meeting->report))
                                            <td>

                                            </td>

                                            @endif
                                                @if(auth()->user()->user_type_id ==1 )
                                        <td data-id="{{$meeting->id}}">
                                            @if(!in_array($meeting->status_id,[1,2]))
                                                <a class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu">






                                                @if ($meeting->status_id < 1 && empty($meeting->report))

                                                        <a
                                                                class="dropdown-item accept "

                                                        >
                                                            <i class="far fa-check-circle"></i> {{ ('Hire') }}
                                                        </a>

                                                @endif

                                                    @if ($meeting->status_id < 1 && empty($meeting->report))

                                                        <a
                                                                class="dropdown-item report"

                                                        >
                                                            <i class="fas fa-exclamation-circle"></i> {{ ('Report no show') }}
                                                        </a>


                                                        <a
                                                                class="dropdown-item  reject"

                                                        >
                                                            <i class="far fa-times-circle"></i> {{ ('reject') }} 
                                                        </a>

                                                    @endif
                                                
                                                
                                                 <a
                                                                class="dropdown-item" 
                                                                href="{{url('account/meetings/'. $meeting->id .'/edit')}}"

                                                        >
                                                            <i class="fas fa-calendar-minus" ></i> {{ ('Reschedule') }}
                                                        </a>

                                                    @if (date('Y-m-d',strtotime($meeting->m_date)) <= date("Y-m-d",strtotime("now")))

                                                       
                                                    @else
                                                        <div class="dropdown-divider"></div>
                                                        <a
                                                                class="dropdown-item r"
                                                                href="{{url('account/meetings/'. $meeting->id .'/delete')}}"

                                                        >
                                                            <i class="fas fa-trash"></i> {{ ('Delete') }}
                                                        </a>


                                                    @endif
                                                    
                                            </div>
                                            @endif
                                        </td>
                                        @endif
                                            @endif
                                        @if(auth()->user()->user_type_id ==2 )
                                            <td data-id="{{$meeting->id}}">
                                                <a class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu">
                                                      <a
                                                                class=" dropdown-item"
                                                                data-toggle= "modal"
                                                                href="#rearrange"

                                                        >
                                                            <i class="fas fa-calendar-minus"></i> {{ ('Reschedule') }}
                                                        </a>

                                                    @if ($meeting->m_date >= $date->toDateString())

                                                      
                                                    @else

                                                            <a
                                                                    class=" dropdown-item"
                                                                    data-toggle= "modal"
                                                                    href="{{url('account/meetings/'. $meeting->id .'/delete')}}"
                                                               
                                                            >
                                                                <i class="fas fa-trash"></i> {{ ('Delete') }}
                                                            </a>

                                                    @endif
                                                </div>
{{--                                                    <div class="col-md-6 text-center">--}}
{{--                                                        <a--}}
{{--                                                                class="btn btn-sm"--}}
{{--                                                                href = "{{url('candidate-support')}}"--}}
{{--                                                                style="width: 7rem"--}}
{{--                                                        >--}}
{{--                                                            <i class="fas fa-exclamation-circle"></i> {{ ('Report') }}--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}

                                            </td>
                                        @endif
                                    </tr>
                                            <?php } ?>
                                    
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!--copleted-->
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                     <tbody  id="complete">
                                    <?php
                                    if(isset($meetings) && $meetings->count() > 0) : foreach ($meetings as $key => $meeting) : ?>
                                    
                                          <?php 
                                      $date2 = date('Y-m-d');
                                      if($meeting->m_date >= $date2 )
                                    {
                                        ?>
                                   
                                    <tr>
                                        @if(auth()->user()->user_type_id ==1 )
                                        <td class="add-img-selector">
                                          
                                            <div class="checkbox">
                                                <label
                                                ><input
                                                            type="checkbox"
                                                            name="entries[]"
                                                            value="{{ $meeting->id }}"
                                                    /></label>
                                            </div>
                                        </td>@endif
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ $meeting->employer->name }}</td>
                                        @if(auth()->user()->user_type_id ==1)
                                            <td>@isset ($meeting->candidate->name){{ $meeting->candidate->name }}@endempty</td>
                                        @endif
                                        <td>
                                            <div class="text-center">
                                                {{ $meeting->m_from }} - {{ $meeting->m_to }}
                                                <div class="text-center">{{$meeting->m_date }}</div>
                                                <div class="text-center">{{$meeting->m_location }}</div>
                                            </div>
                                        </td>
                                        @if(auth()->user()->user_type_id ==1)
                                            @if(!empty($meeting->report))
                                                @php $statuses = [["text"=>"Requested","class"=>"border-primary"],
                                                ["text"=>"Approved","class"=>"border-success"],
                                                ["text"=>"Denied","class"=>"border-danger"]];
                                             @endphp
                                        <td>
                                        <span class="py-1 px-2 border {{$statuses[$meeting->report->status_id]['class']}}">{{$statuses[$meeting->report->status_id]['text']}}</span>
                                        </td>
                                        @endif
                                         @if(empty($meeting->report))
                                            <td>

                                            </td>

                                            @endif
                                                @if(auth()->user()->user_type_id ==1 )
                                        <td data-id="{{$meeting->id}}">
                                            @if(!in_array($meeting->status_id,[1,2]))
                                                <a class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu">






                                                @if ($meeting->status_id < 1 && empty($meeting->report))

                                                        <a
                                                                class="dropdown-item accept "

                                                        >
                                                            <i class="far fa-check-circle"></i> {{ ('Hire') }}
                                                        </a>

                                                @endif

                                                    @if ($meeting->status_id < 1 && empty($meeting->report))

                                                        <a
                                                                class="dropdown-item report"

                                                        >
                                                            <i class="fas fa-exclamation-circle"></i> {{ ('Report no show') }}
                                                        </a>


                                                        <a
                                                                class="dropdown-item  reject"

                                                        >
                                                            <i class="far fa-times-circle"></i> {{ ('reject') }} 
                                                        </a>

                                                    @endif
                                                
                                                
                                                 <a
                                                                class="dropdown-item" 
                                                                href="{{url('account/meetings/'. $meeting->id .'/edit')}}"

                                                        >
                                                            <i class="fas fa-calendar-minus" ></i> {{ ('Reschedule') }}
                                                        </a>

                                                    @if (date('Y-m-d',strtotime($meeting->m_date)) <= date("Y-m-d",strtotime("now")))

                                                       
                                                    @else
                                                        <div class="dropdown-divider"></div>
                                                        <a
                                                                class="dropdown-item r"
                                                                href="{{url('account/meetings/'. $meeting->id .'/delete')}}"

                                                        >
                                                            <i class="fas fa-trash"></i> {{ ('Delete') }}
                                                        </a>


                                                    @endif
                                                    
                                            </div>
                                            @endif
                                        </td>
                                        @endif
                                            @endif
                                        @if(auth()->user()->user_type_id ==2 )
                                            <td data-id="{{$meeting->id}}">
                                                <a class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu">
                                                      <a
                                                                class=" dropdown-item"
                                                                data-toggle= "modal"
                                                                href="#rearrange"

                                                        >
                                                            <i class="fas fa-calendar-minus"></i> {{ ('Reschedule') }}
                                                        </a>

                                                    @if ($meeting->m_date >= $date->toDateString())

                                                      
                                                    @else

                                                            <a
                                                                    class=" dropdown-item"
                                                                    data-toggle= "modal"
                                                                    href="{{url('account/meetings/'. $meeting->id .'/delete')}}"
                                                               
                                                            >
                                                                <i class="fas fa-trash"></i> {{ ('Delete') }}
                                                            </a>

                                                    @endif
                                                </div>
{{--                                                    <div class="col-md-6 text-center">--}}
{{--                                                        <a--}}
{{--                                                                class="btn btn-sm"--}}
{{--                                                                href = "{{url('candidate-support')}}"--}}
{{--                                                                style="width: 7rem"--}}
{{--                                                        >--}}
{{--                                                            <i class="fas fa-exclamation-circle"></i> {{ ('Report') }}--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}

                                            </td>
                                        @endif
                                    </tr>
                                           <?php } ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                                
                                
                                
                                
                                
                                
                                
                                
                            </div>
                        </form>
                        <nav class="" aria-label=""></nav>
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
    <div
            class="modal fade"
            id="reason-reject"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                        id="reject-form"
                        method="post"
                        action="{{url('/account/meetings/status')}}"
                >
                    <div class="modal-body">
                        @csrf <input type="hidden" name="meeting_id" value="" />
                        <input type="hidden" name="status_id" value="2" />
                        <div class="form-group required">
                            <label class="required">Reason for Rejecting the Candidate</label>
                            <textarea
                                    class="form-control"
                                    name="message"
                                    rows="10"
                                    cols="20"
                                    required
                                    minlength="10"
                                    maxlength="180"
                            >
            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
            class="modal fade"
            id="report"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Report - Candidate is not Attended the Interview
                    </h5>
                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                        id="report-form"
                        method="post"
                        action="{{ lurl('account/report') }}"
                >
                    <div class="modal-body">
                        @csrf <input type="hidden" name="meeting_id" value="" />
                        <div class="form-group required">
                            <label class="required">Comments</label>
                            <textarea
                                    class="form-control"
                                    name="comments"
                                    rows="10"
                                    cols="20"
                                    required
                                    minlength="10"
                                    maxlength="250"
                            >
            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
            class="modal fade"
            id="rearrange"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Contact Company</h1>
                    <a type="button" href="{{url('company-detail/'.(!empty($meeting)?$meeting->company->id:""))}}" class="btn btn-view mt-1 ml-3">View</a>

                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')




<style>
    .dropdown-menu
    {
        display: none !important;
    }
    
    .show {
    display: block !important;
}
</style>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{url('assets/bootstrap/4/js/bootstrap.min.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{url('assets/js/formsubmit.js')}}"></script>

    <script src="{{url('assets/plugins/jquery-validation-1.19/dist/jquery.validate.min.js')}}"></script>

    <script>
     viewtable ('pending');
    
function viewtable (table=null)
{

let pending = document.getElementById("pending");
let complete = document.getElementById("complete");

if(table=="pending")
{
pending.style.display = "none";
complete.style.display = "contents";
}else
{
pending.style.display = "contents";
complete.style.display = "none";
}

}
    
    
    

        $(function () {

            $("#datepicker").datepicker();

        });

    </script>

    <script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>

    <script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $('textarea[name="message"]').val('');
        $('textarea[name="comments"]').val('');
        $("#reject-form").validate();
        $("#report-form").validate();

        $(function () {

            $('#addManageTable').footable().bind('footable_filtering', function (e) {

                var selected = $('.filter-status').find(':selected').text();

                if (selected && selected.length > 0) {

                    e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;

                    e.clear = !e.filter;

                }

            });

            $('[data-toggle="tooltip"]').tooltip();





            $('.clear-filter').click(function (e) {

                e.preventDefault();

                $('.filter-status').val('');

                $('table.demo').trigger('footable_clear_filter');

            });



            $('#checkAll').click(function () {

                checkAll(this);

            });



            $(".dropdown-toggle").on('click',function () {

                $(this).parent().find(".dropdown-menu").toggle1();

            });



            $(".dropdown-toggle a").on('click',function () {

                $(this).parent().find(".dropdown-menu").toggle1();

            });



            $("a.accept").on('click',function () {

                var data = new FormData();

                data.append("meeting_id",$(this).closest('td').data('id'));

                data.append("status_id",1);

                submitForm("{{url('account/meetings/status')}}",data).then((res)=>{



                   location.reload();

                })

            });



            $("a.reject").on('click',function () {

                $("#reason-reject").modal("show");

                $('textarea[name="message"]').val(null);

                getData("{{url('account/meetings/')}}"+"/"+$(this).closest('td').data('id')).then((res)=>{

                    if (res.reject_message != null)

                    {

                        $('textarea[name="message"]').val(res.reject_message);

                    }

                    $("#reason-reject form input[name='meeting_id']").val($(this).closest('td').data('id'));

                })





            });

            $("a.report").on('click',function () {
                $("#report").modal("show");

                $("#report-form input[name='meeting_id']").val($(this).closest('td').data('id'));
            })


            $('a.delete-action, button.delete-action').click(function (e) {

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
