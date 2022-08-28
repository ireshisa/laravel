@extends('layouts.master')

@section('content')
    <div class="container body-content">
        <h1 class="font-weight-bold">Resume & Career Help</h1>
        <h4 class="color-black">Are you looking for a Job?</h4>
        <div class="row">
            <div class="col-md-12">
        <p>
            Here's how you should organize through the hundreds of available opportunities to find the one that's right for you.
        </p>
        <p>
            Your resume is perfect. It's keyword optimized, industry specified, full of acheivements, backed by data and double-checked by an expert.<br/>
            (If it's none of these things, contact us get a free evaluation today).
        </p>
        <p>
But with more than hundreds of jobs on Search Jobs, do you know where to begin?. We will guide you to fiond the best job better, faster and smarter.
        </p>
            </div>
            <div class="col-md-12 d-flex justify-content-center mb-3 mt-2">
                <a class="btn btn-primary" href="{{url('/contact')}}">Contact Us</a>
            </div>
        </div>
    </div>
    @endsection
