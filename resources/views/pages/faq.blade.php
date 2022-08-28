
@extends('layouts.master')
<div class="container body-content">
    <div class="row">
        <div class="col-md-12 mt-5 text-center">
        <h1 style="font-size: 2.5rem;">How It Works?</h1>
        </div>
        <div class="col-md-12">
            <div class="d-flex flex-wrap justify-content-center card-container-home">
                <div class="card rounded mx-4 my-5 d-inline-block">
                    <img src="{{url('images/cv.png')}}" class="card-img-top">
                    <div class="card-body text-center">
                        <h3 class="card-title">Application Made Easy</h3>
                        <p>
                           Create your Free CV and Apply through the Platform
                        </p>
                    </div>
                </div>

                <div class="card rounded mx-4 my-5 d-inline-block">
                    <img src="{{url('images/high-emp.png')}}" class="card-img-top">
                    <div class="card-body text-center">
                        <h3 class="card-title">High Employment Probability</h3>
                        <p>
                            With your innovative filtering and review features you will be found easily
                        </p>
                    </div>
                </div>

                <div class="card rounded mx-4 my-5 d-inline-block">
                    <img src="{{url('images/highlighted.png')}}" class="card-img-top">
                    <div class="card-body text-center">
                        <h3 class="card-title">Get Highlighted</h3>
                        <p>
                            Get more reviews and endorsements and get recognized
                        </p>
                    </div>
                </div>
                <div class="card rounded mx-4 my-5 d-inline-block">
                    <img src="{{url('images/bell.png')}}"  class="card-img-top">
                    <div class="card-body text-center">
                        <h3 class="card-title">Create Alerts</h3>
                        <p class="px-3 pb-4">
                            Create Alerts with job filters and follow companies. Get notified When similar job are posted
                        </p>
                    </div>
                </div>
                <div class="card rounded mx-4 my-5 d-inline-block">
                    <img src="{{url('images/research.png')}}" class="card-img-top">
                    <div class="card-body text-center">
                        <h3 class="card-title">Easy Tracking</h3>
                        <p>
                            Track your application process in the dashboard
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12 grey-background my-2">
            <div class="col-md-12 text-center">
                <h1 style="margin-top: 30px; font-size: 2.5rem;">How do we help you?</h1>
                <h5 class="px-5 mt-2" style="line-height: 1.5rem;">At the end of the day what you want is to work in good position at a good company for a good salary right?  But the problem is there is high competition,
                    it is not easy for you to get recognized. You find it difficult to create a professional CV or have no idea how to face an interview.</h5>
                <h6>We have been in the industry for 5+ years and have over 8,000 people who have applied and approached us.
                    We have made a one stop job search platform for you. </h6>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between flex-wrap">
                    <div class="d-flex flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/1.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/1.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Create an account
                                    & Create your CV</h4>
                                <p style="font-size: 12px;">
                                    Make sure the information is
                                    accurate and complete & Ask your
                                    friends/colleagues to endorse on
                                    your resumes to get noticed faster.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/2.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/2.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Search for
                                    Jobs</h4>
                                <p style="font-size: 12px;">
                                    Use the filtered search and connect
                                    with interested job roles. Follow
                                    companies you’re interested  to work
                                    for and be notified when they hire. Create
                                    alerts using filters and be  notified when
                                    similar jobs are posted.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/33.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/33.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Connect and get connected
                                    for the Job roles</h4>
                                <p style="font-size: 12px;">
                                    Connect for the job posts you’re interested
                                    in. if the company is interested, they will
                                    accept your connection request.
                                    The company can send you a connection
                                    request if they find you suitable for their jobs
                                    roles. You can either accept or reject it.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flow-element col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/4.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/4.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Attend
                                    Interviews</h4>
                                <p style="font-size: 12px;">
                                    The company will set interviews & inform
                                    you in prior. Inform them if  you want
                                    it rescheduled. Attend interviews after confirming
                                    or else the company may write a review
                                    under your profile.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flow-element flex-wrap col-lg-2 col-md-4">
                        {{--                <img src="{{url('images/55.png')}}"/>--}}
                        <div class="card rounded my-5 d-inline-block grey-background" style="border: 0px;">
                            <img src="{{url('images/55.png')}}" class="card-img-top">
                            <div class="card-body text-center mt-3" style="padding: 1px">
                                <h4 class="card-title m-0">Get hired for
                                    your Dream job</h4>
                                <p style="font-size: 12px;">
                                    Get recruited for the perfect job
                                    and start building your career
                                </p>
                            </div>
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

            <h1>For Employers</h1>
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
                        </p>
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
                        </p>
                    </div>
                </div>
            </div>
            <h1 class="mt-5">For Employees</h1>
            <div class="col-md-12">

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f6">Can I create a professional CV with Search Jobs Global? <span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f6">
                        <p>
                            After both parties agree and accepted the connect requests, you’ll be able to see the contact details of the candidates and can schedule the interviews through our platform itself. Before you schedule interviews, you can do a background check using our platform also. You can contact the candidates non-related referees and see if the information provided on the resume is accurate. You can do this with one click and call from the candidate’s profile. We can do this for you too.
                        </p>
                    </div>
                </div>
                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f7">What Are Connects?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f7">
                        <p>
                            Connects work in two ways. After you connect for a job post, the company will look into your profile and see if you’re suitable for that job position. If you are suitable, they will accept your connect request. If they think that you are not suitable, they will reject your request so you can start looking and applying for other jobs.
                        </p>
                        <p>
                            The companies can find you from the search talent page and send you connect requests if they feel like you’re a good addition to their company. If you’re interested in the opportunity, you can accept the connection request or else you can simply reject it.
                        </p>
                    </div>
                </div>

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f8">How do interviews work?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f8">
                        <p>
                            The companies can schedule interviews through the platform you will receive a mail and you can check your interviews on your dashboard as well.  If you accept the connection request and not attend interviews, the companies will rate you lower and write negative reviews under your profile which will affect your future recruitment.
                        </p>

                    </div>
                </div>

                <div class="faq-single">

                    <a class="expand text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f9">How can I find my dream job?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f9">
                        <p>
                            Use our filtered search option and find your dream job sooner than later.
                        </p>

                    </div>
                </div>

                <div class="faq-single">

                    <a class="expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f10">Can I check the status of my application through the dashboard?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f10">
                        <p>
                            Yes, you can track your application process from our platform as well.
                        </p>

                    </div>
                </div>


                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f11">How does the review and endorsement work?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f11">
                        <p>
                            We have a review and an endorsing system in place where if you’re a good candidate, the employer can rate and write a review about you. The people who know you and your capabilities can endorse your CV. The higher the ratings and endorsements are, the higher you’ll be shown to companies when they look for talents.
                        </p>

                    </div>
                </div>


                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f12">What else can I do to get the best out of Search Jobs Global?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f12">
                        <p>
                            Make sure you check in to your Search Jobs profile every day and keep the information up to date.
                        </p>
                        <p>
                            We request you to not apply for the jobs you are not 100% interested in or don’t accept connect request from companies if you are not available for an interview or you’re not considering the opportunity. Make sure you read the job post clearly before you send or accept connect requests. Since if you don’t attend interviews without a valid reason, you can be blacklisted and companies can write negative reviews under your profile. If you’re unable to attend for the job interview on the scheduled date and time, you can politely ask them to reschedule. Make sure you don’t do this at the last minute as the management of the company makes time to interview you. Everyone dislikes when their times are wasted.
                        </p>
                        <p>
                            Keep your profile accurate and attractive. The companies may check the accuracy by contacting non related referees provided by you.
                        </p>
                        <p>
                            You can request your friends and family to endorse your profile since companies tend to connect with candidates who have a high number of endorsements.
                        </p>
                    </div>
                </div>


                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f13">What do I do if I am interested in a job or company and want to connect later?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f13">
                        <p>
                            If you’re interested in a job post, you can click save jobs and view them and connect later from your dashboard.
                        </p>
                        <p>
                            If you like any particular company and you want to get notified when they have an opportunity, you can simply follow that company. You will be notified when they post a job opportunity.
                        </p>

                    </div>
                </div>

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f14">Can I get notified when a job similar to what I am looking for is posted?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f14">
                        <p>
                            Yes, you can use our filters and create an alert to be notified. So, when a job is posted in your preferred criteria, you will be notified via email. You can view all your alerts, edit and delete them from your dashboard.
                        </p>


                    </div>
                </div>

                <div class="faq-single">

                    <a class=" expand  text-left" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="#f15">What do I do if a company is being unfair or a review has been made mistakenly?<span class="float-right"> <i class="fa fa-plus"></i> </span></a>
                    <div class="collapse p-2" id="f15">
                        <p>
                            If you feel like the company is being unfair or the review was made mistakenly. You can report the issue to us. We will look into the issue and do the needful.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @if(!auth()->check())
        <div class="col-md-12 mt-5 text-center">
            <div class="text-center px-3 mt-2">
                <h1>With us, getting recognized and finding your dream job is easy. So why wait? Register with us & create your CV now. </h1>
            </div>
            <a data-toggle="modal" href="#quickRegister" class="btn btn-primary btn-lg text-center text-lg-center" style="font-size: 1.3rem; font-weight: 600;">Get Hire NOW!</a>
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