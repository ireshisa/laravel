<link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
$experiences = [
    '6m' => '6 Months',
    '1y' => '1 Year',
    '2y' => '2 Years',
    '3y' => '3 Years',
    '4y' => '4 Years',
    '5y' => '5 Years',
];
?>
@extends('layouts.master')

@section('content')
<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />
<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/plugin.css?ver=1.5.9' type='text/css' media='all' />

<style>
.col-md-3.jobsearch-typo-wrap, .col-md-3.jobsearch-typo-wrap {
    padding-left: 15px;
    padding-right: 15px;
}
.reset-button{
    padding: 5px !important;
    margin: 10px auto;
    color: #fff !important;
    font-size: 17px;
    text-transform: uppercase;
}
.reset-button:before,.jobsearch-fltbox-title a:before{
    content: "" !important;
}
.fa.fa-angle-down{
    float: right;
    color: #ccc;
}
.jobsearch-filter-responsive-wrap .btn-primary{
    margin-bottom: 10px;
}
.search-row-wrapper {
    background: #fff;
}
</style>
<div class="jobsearch-main-content">
    <div class="jobsearch-plugin-default-container">
    <div class="row jobsearch-row">
    <div class="col-lg-3 page-sidebar-right ">
            <aside class="jobsearch-typo-wrap">
                <div class="card sidebar-card card-contact-seller jobsearch_side_box jobsearch_box_candidate_info">
                    <div class="card-content user-info jobsearch_candidate_info">
                        <div class="card-body text-center">
                            <figure>
                            <img class="mb-3" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}" alt="">
                            </figure>
                            <h2>
                            {{$user->name ?? ""}}
                            </h2>

                            @if (isset(auth()->user()->user_type_id))

                            @if (in_array(auth()->user()->user_type_id, [2]))
                            <a href="tel:{{$user->phone}}" class="btn btn-success btn-block"> <i class="fa fa-phone"></i> {{$user->phone ?? ""}}</a>
                            <a href="mailTo:{{$user->email}}" class="btn btn-primary btn-block"> <i class="icon-mail-2"></i> {{$user->email ?? ""}}</a>
                            @endif

                            @if (in_array(auth()->user()->user_type_id, [1]))
                            
                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModalConnect" onClick="onClick()">Connect</a>
                            
                            @endif
                            @endif



                            <!--                            <button class="btn btn-primary btn-block" onClick="onClick()">Endorse</button>
                            
                                                        <br>-->
                            @auth
                            <br>
                            <form method="POST" action="{{ lurl('seeker/' . $user->id . '/review') }}" id="reviewForm">
                                <textarea rows="3" cols="30" id="textInput" class="form-control"  name="comment"> {{$comment ?? ""}}</textarea>
                                <br><br>
                                <button type="submit" id="submitButton" class="btn btn-primary btn-block">  Review</button><br>

                            </form>
                            <span id="guests">
                                {{$comment ?? ""}}
                            </span>
                            @endauth
                            




                            <div class='success-box'>
                                <div class='clearfix'></div>
                                <img alt='tick image' width='32' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
                                <div class='text-message'></div>
                                <div class='clearfix'></div>
                            </div>



                             <div class="modal" id="myModalConnect">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Connects</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                       
                                       <form action="{{ lurl('search-talent/seeker/'. $user->id .'/connexion') }}" method="GET">
                                           @csrf
                                           <select class="form-control" name="job_id">
                                               @if(!empty($jobs))
                                                   @foreach($jobs as $job)
                                                   <option value="{{$job->id}}">{{$job->title ?? ""}}</option>
                                                   @endforeach
                                               @endif
                                           </select>
                                        <input type="submit" value="Connect">   
                                       </form>
                                       
                                       
                                      </div>
                                
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                
                                    </div>
                              </div>
                              </div>
                            <style>


                                * {
                                    -webkit-box-sizing:border-box;
                                    -moz-box-sizing:border-box;
                                    box-sizing:border-box;
                                }

                                *:before, *:after {
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
                                }

                                .clearfix {
                                    clear:both;
                                }

                                .text-center {text-align:center;}

                                a {
                                    color: tomato;
                                    text-decoration: none;
                                }

                                a:hover {
                                    color: #2196f3;
                                }

                                pre {
                                    display: block;
                                    padding: 9.5px;
                                    margin: 0 0 10px;
                                    font-size: 13px;
                                    line-height: 1.42857143;
                                    color: #333;
                                    word-break: break-all;
                                    word-wrap: break-word;
                                    background-color: #F5F5F5;
                                    border: 1px solid #CCC;
                                    border-radius: 4px;
                                }



                                #a-footer {
                                    margin: 20px 0;
                                }

                                .new-react-version {
                                    padding: 20px 20px;
                                    border: 1px solid #eee;
                                    border-radius: 20px;
                                    box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);

                                    text-align: center;
                                    font-size: 14px;
                                    line-height: 1.7;
                                }

                                .new-react-version .react-svg-logo {
                                    text-align: center;
                                    max-width: 60px;
                                    margin: 20px auto;
                                    margin-top: 0;
                                }





                                .success-box {
                                    margin:50px 0;
                                    padding:10px 10px;
                                    border:1px solid #eee;
                                    background:#f9f9f9;
                                }

                                .success-box img {
                                    margin-right:10px;
                                    display:inline-block;
                                    vertical-align:top;
                                }

                                .success-box > div {
                                    vertical-align:top;
                                    display:inline-block;
                                    color:#888;
                                }



                                /* Rating Star Widgets Style */
                                .rating-stars ul {
                                    list-style-type:none;
                                    padding:0;

                                    -moz-user-select:none;
                                    -webkit-user-select:none;
                                }
                                .rating-stars ul > li.star {
                                    display:inline-block;

                                }

                                /* Idle State of the stars */
                                .rating-stars ul > li.star > i.fa {
                                    font-size:2.5em; /* Change the size of the stars */
                                    color:#ccc; /* Color on idle state */
                                }

                                /* Hover state of the stars */
                                .rating-stars ul > li.star.hover > i.fa {
                                    color:#FFCC36;
                                }

                                /* Selected state of the stars */
                                .rating-stars ul > li.star.selected > i.fa {
                                    color:#FF912C;
                                }

                            </style>







                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-lg-9 page-content col-thin-right jobsearch-typo-wrap jobsearch-typo-wrap">
            <div class="inner inner-box items-details-wrapper pb-0 container-wrapper container-wrapper-view1">
                <h2 class="enable-long-words">
                    <strong>
                    About {{$user->name ?? ""}}
                    </strong>
                </h2>
                <span class="info-row">
                    <span class="category">{{$user->sector ? $user->sector->name : '-'}}</span> -&nbsp;
                    <span class="item-location"><i class="fas fa-map-marker-alt mr-2"></i>{{$user->location ?? ""}}</span>
                </span>

                <div class="items-details">
                    <div class="row pb-4">
                        <div class="items-details-info jobs-details-info col-md-12 col-sm-12 col-xs-12 enable-long-words">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h5 class="list-title"><strong>Qualifications</strong></h5>

                                        <!-- Description -->
                                        <div>
                                            {!! implode('<br>', explode(PHP_EOL, $user->qualifications)) !!}
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="list-title"><strong>Skills</strong></h5>

                                        <!-- Description -->

                                        <div>
                                            {{$user->skills ?? ""}}
                                            
                                            @auth
                                            <form method="POST" action="{{ lurl('seeker/' . $user->id . '/endorse') }}">
                                                <button type="submit">+</button>
                                            </form>                                            
                                            @endauth
                                            <p>Endorsement: <a id="endorsements">{{$endorsementCount ?? ""}}</a></p><br>


                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="list-title"><strong>Description</strong></h5>

                                        <!-- Description -->
                                        <div>
                                            {{$user->about_me ?? ""}}
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <!-- Rating Stars Box -->
                                        <div class='rating-stars text-center'>
                                            <ul id='stars'>
                                                <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list mt-4 seeker-details-list">
                                        <li>
                                            <h4>
                                                <span class="text-muted">Age</span>: {{$user->age ?? ""}}
                                            </h4>
                                        </li>
                                        <li>
                                            <h4>
                                                <span class="text-muted">Expected salary</span>: LKR {{$user->salary ?? ""}}
                                            </h4>
                                        </li>
                                        <li>
                                            <h4>
                                                <span class="text-muted">Experience</span>: {{ isset($experiences[$user->experience]) ? $experiences[$user->experience] : '-'  }}
                                            </h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.items-details-wrapper-->
            </div>
        </div>
        <!--/.page-content-->


        
    </div>

</div>
@endsection
<script>
    $(document).ready(function () {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function () {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });


    });


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
</script>
<script>

    $(document).ready(function () {
        $("#submitButton").on("click", function (e) {
            e.preventDefault();
            var input = $("#textInput").val()
            $("#guests").html(input);
            $('#reviewForm').submit();
        })
    });

</script>
<script type="text/javascript">
    var clicks = 0;
    function onClick() {
        clicks += 1;
        document.getElementById("clicks").innerHTML = clicks;
    }
    ;
</script>

<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=sYPib-4HG3Kq22t0_eSgUV3OGPLyv4oFBAvLFJagLrSfgPj4UR5rWAhK9oREN54S1BQhSM-Cga3VSBq1CJAi8ChUeHCls9MOcfEl7FMn9tcHC8zO0SVvooFmsf-7QvlgA8eSksLLrzeLnFGMgG-Ht9YtE4O4nKGL8Vz-9Tr0Ze4" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly93d3cuanF3aWRnZXRzLmNvbS9qcXVlcnktd2lkZ2V0cy1kb2N1bWVudGF0aW9uL2RvY3VtZW50YXRpb24vanF4cmF0aW5nL2pxdWVyeS1yYXRpbmdfc2FtcGxlNC5odG0"/><script type="text/javascript" src="../../scripts/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="../../jqwidgets/jqxrating.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Create jqxRating.
        $("#jqxRating").jqxRating({width: 350, height: 35});
        // bind to jqxRating 'change' event.
        $("#jqxRating").bind('change', function (event) {
            $("#rate").html('<span>' + event.value + '</span');
        });
    });
</script>
