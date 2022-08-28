
@extends('layouts.master')
<div class="container body-content">
    <div class="row">
        <div class="col-md-12 mt-5 text-center">
            <h1 style="font-size: 2.5rem;">How do we Work?</h1>
            <h4>We have made the recruitment process
                efficient & effective with our unique features</h4>
        </div>
        <div class="col-md-12 grey-background my-2">
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between flex-wrap">
                    <div class="d-flex flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/1.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/1.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Create an account
                                    & complete your
                                    company profile</h4>
                                <p style="font-size: 12px;">
                                    Complete your company
                                    profile and create your job post
                                    by filling all the necessary
                                    information.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/2.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/2.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Use the filtered search
                                    & find suitable candidates
                                    for the job positions</h4>
                                <p style="font-size: 12px;">
                                    Check the endorsements and
                                    reviews to help you pick the
                                    right candidate.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/33.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/33.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Connect and get
                                    connected with the
                                    selected candidates.</h4>
                                <p style="font-size: 12px;">
                                    Send connection request to candidates, they
                                    can accept/reject it. Receive connection request
                                    by candidates, you can accept/reject it. The
                                    contact information is revealed once both parties
                                    have agreed for the job role
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/4.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/4.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Schedule
                                    Interviews
                                    with one click</h4>
                                <p style="font-size: 12px;">
                                    Schedule the interviews by selecting
                                    the date, time and the location.an e-mail
                                    will be sent to them immediately
                                    informing regarding the interview.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flow-element flex-wrap col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/55.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/55.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Hire your
                                    Rockstar
                                    employee</h4>
                                <p style="font-size: 12px;">
                                    Hire the perfect candidate for the
                                    job role and build a great team
                                    to grow your business.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-12 grey-background my-2">
            <div class="col-md-12 text-center">
                <h1 style="margin-top: 30px; font-size: 2.5rem;">How it works?</h1>
                <h5 class="px-5 mt-2" style="line-height: 1.5rem;">In Search Jobs Global, we make the job posting and employee head hunting free of charge. We will only charge you if both parties are agreed and connected
                    provided that they attend interviews only.  We  have review system in place to  check the quality of the candidate.  You can  schedule  interviews  through the
                    website itself with just one click but if you need to  call  them as well,  we can do that for you at a small  charge while you focus on  growing  your business by
                    focusing on key areas. With us, recruiting candidates for startups have been made easy, cost effective and hassle free. </h5>
            </div>

            <div class="container">
                <form id="package_form" method="post" action="{{url('/payment')}}">
                    <input type="hidden" name="package_id" value="">
                </form>
                <div class="row">
                    @php
                        $packages = $packages->flatten();
                    @endphp
                    @include('post.inc.notification')
                    <div class="col-md-12 page-content">
                        <div class="inner-box border-0" style="overflow-x: auto">
                            <h2 class="title-2"><strong><i class="icon-tag"></i> Plans & Pricing</strong></h2>
                            <table class="table table-bordered pricing-table" style="min-width: 800px;">
                                <tr>
                                    <td></td>
                                    {{-- <h2 class="title-2"><strong> {{ ('Note- Post a job is free you can skip and buy connects later') }}</strong></h2> --}}
                                    @foreach($packages as $package)



                                        <td>
                                            <h3>{{$package->name}}</h3>
                                            <h2>{{($package->id == 1)?'Free Trial':$package->price.' LKR'}}</h2>
                                            <h5>*{{$package->duration}} Months</h5>
                                            <h5>Unlimited Job Posts</h5>
                                            @if (auth()->check())
                                                @if (auth()->user()->user_type_id ==1)

                                                    <a class="btn d-block  btn-black package m-auto" style="max-width: 100px" data-package_id="{{$package->id}}">Buy
                                                    </a>



                                                @endif
                                            @else
                                                <a href="{{url('/register')}}" class="btn btn-black d-block mx-auto" style="max-width: 100px">Sign Up
                                                </a>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr class="row-heading">
                                    <td class="text-center">Features</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td></td>
                                    @endif
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> <tr>
                                    <td>Connects</td>
                                    @foreach($packages as $package)
                                        <td class="text-center">{{$package->connects}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Job Posts Approval Time</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center">Instant</td>
                                    @endif
                                    <td class="text-center">Instant</td>
                                    <td class="text-center">Instant</td>
                                    <td  class="text-center">Instant</td>
                                    <td  class="text-center">Instant</td>
                                </tr>
                                <tr>
                                    <td>Review Employees</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center"><i class="fa fa-check"></i> </td>
                                    @endif
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                </tr>
                                <tr>
                                    <td>View Talent Profile</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center"><i class="fa fa-check"></i> </td>
                                    @endif
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                </tr>
                                <tr>
                                    <td>Save Candidates</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center"><i class="fa fa-check"></i> </td>
                                    @endif
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                </tr>
                                <tr>
                                    <td>Scheduling Interviews</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center"><i class="fa fa-check"></i> </td>
                                    @endif
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                </tr>
                                <tr>
                                    <td>Basic HR Advise</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center"><i class="fa fa-check"></i> </td>
                                    @endif
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                    <td class="text-center"><i class="fa fa-check"></i> </td>
                                </tr>
                                <tr class="row-heading" style="opacity: 0.7">
                                    <td>Additional</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td></td>
                                    @endif
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Calling Interviews<br> (Optional)</td>
                                    @if($packages[0]->name == "Free Trial")
                                        <td class="text-center">Rs 600</td>
                                    @endif
                                    <td class="text-center">Rs 600</td>
                                    <td class="text-center">Rs 1000</td>
                                    <td class="text-center">Rs 2500</td>
                                    <td class="text-center">Rs 35/Call</td>
                                </tr>
                            </table>



                            <style>
                                .pricing-table-container {
                                    margin-top: 25px;
                                }

                                .pricing-table-container p {
                                    font-size: 20px;
                                    margin-bottom: 0px;
                                    padding-top: 3px;
                                }

                                .pricing-table-container small {
                                    font-size: 13px;
                                }

                                .pricing-table-container .price_border {
                                    border-right: 1px dotted black;
                                    height: 7em;
                                }

                                .pricing-table-container .price {
                                    color: green;
                                    font-size: 45px;
                                    text-align: center;
                                }

                                .pricing-table-container .qrdiv {
                                    border-left: 1px dotted black;
                                    height: 7em;
                                }

                                .pricing-table-container .paragraph_options {
                                    font-size: 12px;
                                    margin-bottom: 7px;
                                }

                                .pricing-table-container .pricing-table-container ul li {
                                    font-size: 15px;
                                    border-bottom: 1px solid black;
                                }

                                @media screen and (max-width: 768px) {
                                    .pricing-table-container .price_border {
                                        border: none;
                                    }

                                    .pricing-table-container .qrdiv {
                                        border: none;
                                        margin-left: 75px;
                                    }

                                    .pricing-table-container ul {
                                        -webkit-padding-start: 0;
                                    }

                                    .pricing-table-container ul li {
                                        list-style-type: none;
                                    }

                                }

                            </style>


                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-m-12">--}}
            {{--                    <h1>How Do We Help You?.</h1>--}}

            {{--                    <p> At the end of the day what you want is to work im good position at a good company for a good salary right?.</p>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <h1 class="mt-4">For Employers</h1>
            <div class="col-md-12">
                <div class="faq-single">
                    <a class=" text-left expand" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f1">How do we help you?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f1">
                        <p>
                            We identified that many startups find it difficult to find a suitable candidate for their business vacant positions. What the companies want is to recruit staff easily at an affordable rate without wasting time but what happens is they pay a huge sum of money to post a job post or for candidates and they get valueless and very limited number of applicants. Most of them don’t even attend the interviews after applying for the job post and end up wasting valuable time of the management. Also, the management doesn’t have time to check each CV and call the candidates to arrange interviews or to check the quality of the CVs.
                        </p>
                        <p>
                            In Search Jobs Global, we understand this problem. We have been in this industry for 5+ years serving 150+ companies. We had this problem and found that most of the startup companies have this problem as well. So, we decided to solve this issue by creating Search Jobs Global.
                        </p>
                    </div>
                </div>
                <div class="faq-single">
                    <a class="  text-left expand" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f2">What are Connects?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f2">
                        <p>
                            A successful connect is when both employers and candidates have accepted the job opportunity. After you have posted a job post, any applicant can connect with you for that job post. You can see their profile information without the contact details. If you like their application and is suitable for your job position, simply accept their connect request and it will be counted as one connect. If you think that they are not suitable, you may simply reject the application so that the candidate can look and apply for other jobs.
                        </p>
                        <p>
                            You can send them a connection request too. After you post the job post, you can go to our search talent section, use the filtered search option and narrow down the search results for your needs. Look at a few interested candidates’ profiles and save them first so you can check them later on in your dashboard. Make sure to check the endorsements and reviews before you send connect requests. Send connect requests for the most suited candidates. If the candidate is available and is interested, they will accept your connect request. Once they accept it will be counted as a successful connect. If they reject, you’ll be notified and can look for other talents.
                        </p>
                    </div>
                </div>
                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f3">How do I verify accuracy of the resumes? <span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f3">
                        <p>
                            After both parties agree and accepted the connect requests, you’ll be able to see the contact details of the candidates and can schedule the interviews through our platform itself. Before you schedule interviews, you can do a background check using our platform also. You can contact the candidates non-related referees and see if the information provided on the resume is accurate. You can do this with one click and call from the candidate’s profile. We can do this for you too.
                        </p>
                    </div>
                </div>

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f4">How do we set Interviews? <span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f4">
                        <p>
                            You just simply enter the date, time and the location and an email will be sent to the candidate notifying regarding the interview. You can also call them to inform about the interview. If it is a hassle, you can let us know and we will do this on behalf of you while you focus on growing your business.
                        <ul>
                            <li>What should I do if the candidate doesn’t attend interview after getting connected?</li>

                        </ul>

                        We help you track employee application process in our platform and if they don’t attend interviews and not inform you with a valid reason, you can simply rate them and write a review. Once you report the employee, we will look into it and restore your connects. This will not only benefit you but also change the mentality of Sri Lankan candidates.
                        <p><strong>Please do not hesitate to contact us if you face any issue or having concerns.</strong></p>
                    </div>
                </div>

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f5">What should I do if the candidate doesn’t attend interview after getting connected? <span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f5">
                        <p>
                            Yes, if you’re struggling to make a professional CV or need to pay someone to make a professional CV for you, you don’t have to do that anymore. You just have to create and account and fill all the information and the CV will be created for you. You can simply download and get it printed. We will also publish blogs and videos to help you face and better prepared for an interview.
                        <ul>
                            <li>What should I do if the candidate doesn’t attend interview after getting connected?</li>

                        </ul>

                        We help you track employee application process in our platform and if they don’t attend interviews and not inform you with a valid reason, you can simply rate them and write a review. Once you report the employee, we will look into it and restore your connects. This will not only benefit you but also change the mentality of Sri Lankan candidates.
                        <p><strong>Please do not hesitate to contact us if you face any issue or having concerns.</strong></p>
                    </div>
                </div>
            </div>
    </div>
        @if(!auth()->check())
            <div class="col-md-12 mt-5 text-center">
                <div class="text-center px-3 mt-2">
                    <h1>Please do not hesitate to contact us if you face any issue or having concerns.</h1>
                </div>
                <a data-toggle="modal" href="#quickLogin" class="btn btn-primary btn-lg text-center text-lg-center" style="font-size: 1.3rem; font-weight: 600;">Get Started NOW!</a>
            </div>
        @endif
</div>
</div>
@section('before_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('after_scripts')
    <script src="{{url('assets/js/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('assets/plugins/jqueryui/1.9.2/jquery-ui.min.js')}}"></script>
    <script>
        $("body").on('click','.expand',function () {
            if ($(this).attr('aria-expanded') == "true")
            {
                $(this).find("span").html("<i class='fa fa-plus'></i>");
            }
            else {
                $(this).find("span").html("<i class='fa fa-minus'></i>");
            }
        })
    </script>
@endsection