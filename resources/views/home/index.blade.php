@extends('layouts.master')
<link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">
<style>
	body {
		margin: 0;
		padding: 0;
		width:100vw;
		height: 100vh;
		background-color: #eee;
	}
	.loader-wrapper {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		left: 0;
		background-color: #092d5f;
		display:flex;
		justify-content: center;
		align-items: center;
		z-index: 9999999999;
	}
	.loader {
		display: inline-block;
		width: 30px;
		height: 30px;
		position: relative;
		border: 4px solid #Fff;
		animation: loader 2s infinite ease;
	}
	.loader-inner {
		vertical-align: top;
		display: inline-block;
		width: 100%;
		background-color: #fff;
		animation: loader-inner 2s infinite ease-in;
	}
	@keyframes loader {
		0% { transform: rotate(0deg);}
		25% { transform: rotate(180deg);}
		50% { transform: rotate(180deg);}
		75% { transform: rotate(360deg);}
		100% { transform: rotate(360deg);}
	}
	@keyframes loader-inner {
		0% { height: 0%;}
		25% { height: 0%;}
		50% { height: 100%;}
		75% { height: 100%;}
		100% { height: 0%;}
	}

</style>


@section('search')
	@parent
@endsection


@section('content')
<div class="row">
<div class="body-content">
	<div class="body-container">
		<!-- carousel section Starting -->

		<div class="row m-0 carousel-content caurosel-image d-flex align-items-center p-0 p-md-4 pt-4 pb-4">

			<div class="col-sm-12 col-md-6 col-lg-6 m-0 px-2">
				<h1>The Platform You</h1>
				<h1><strong>Can Rely On</strong></h1>
				<div class="my-2">
					<p>
					We have identified that 8 out of 10 candidates don’t attend interviews
					in Sri Lanka after companies pay a large sum of amount for job posts
					and resumes.
					</p>
					<p>
					With Search Jobs  Global  you  don’t  have  to  pay  for  Job posts or
					resumes  you  just  have to pay  when  candidates  attend  interviews.
					Yes  you read that right!  Not only  that  we will also  help you call the
					candidates for interviews while you focus on managing your business.
					</p>
				</div>

				<div class="mt-4 display-column-mobile" style="display: flex;">
					<a
							type="button"
							class="btn btn-lg carousel-content-btn btn-light"
							href="{{url('/latest-jobs')}}"
					>
						Find Your Dream Job
					</a>
					<a
							type="button"
							class="btn btn-outline-primary-employee ml-1 btn-lg"
							href="{{url('/search-talent')}}"
					>
						Find Your Rockstar Employee
					</a>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6 pt-3 pt-md-0 pt-lg-0">
				<div class="embed-responsive embed-responsive-16by9 embed-border">
					<iframe
							title="video"
							class="embed-responsive-item video-embed-container"
							src="https://www.youtube.com/embed/2U2sr0W8OrI"
							width="200" height="200"
					></iframe>
				</div>
			</div>
			</div>
		</div>

		<div class="container">
		<!-- carousel section ending -->
		<!-- Card section starting -->
		<div class="row">
			<div class="col-md-12">
			<div class="d-flex flex-wrap justify-content-center card-container-home">
					<div class="card rounded mx-4 my-5 d-inline-block">
						<img src="{{url('images/money.png')}}" class="card-img-top">
						<div class="card-body text-center">
							<h4 class="card-title">Value for money</h4>
							<p>
								Post your jobs free of charge
								and pay only for the interviews
								you conduct
							</p>
						</div>
					</div>

				<div class="card rounded mx-4 my-5 d-inline-block">
					<img src="{{url('images/time.png')}}" class="card-img-top">
					<div class="card-body text-center">
						<h4 class="card-title">Save Time</h4>
						<p>
							We will help you call and schedule
							the interviews while you focus on
							growing the business
						</p>
					</div>
				</div>

				<div class="card rounded mx-4 my-5 d-inline-block">
					<img src="{{url('images/candidate.png')}}" class="card-img-top">
					<div class="card-body text-center">
						<h4 class="card-title">Relevant Candidates</h4>
						<p>
							Hire candidates with more
							endorsement on their resume and
							skills, read reviews of the candidates
						</p>
					</div>
				</div>
				<div class="card rounded mx-4 my-5 d-inline-block">
					<img src="{{url('images/verify.png')}}"  class="card-img-top">
					<div class="card-body text-center">
						<h4 class="card-title">Easy Background Check</h4>
						<p class="px-3 pb-4">
							Verify information provided in the
							resume with one click
						</p>
					</div>
				</div>
				<div class="card rounded mx-4 my-5 d-inline-block">
					<img src="{{url('images/interview.png')}}" class="card-img-top">
					<div class="card-body text-center">
						<h4 class="card-title">One Click Interviews</h4>
						<p>
							Schedule interviews and send
							interview emails with blink
							of an eye
						</p>
					</div>
				</div>

			</div>
			</div>



		</div>
		<!-- Card section ending -->
		<!-- How it's work stating -->
		<div class="row rounded info-container py-5">
			<div class="col-sm-12 pl-md-5 pl-sm-3">
				<h1><strong>How it Works</strong></h1>
				<h3>Find out What Makes Search Jobs Global So Special!</h3>

				<div class="info-action-buttons-wrapper">
					<a
							type="button"
							class="btn btn-lg btn btn-primary-upload custom-info-btn"
							href="{{url('/faq-employer')}}"
					>
						I am an Employer
					</a>
					<a
							type="button"
							class="btn btn-lg btn btn-primary-upload custom-info-btn"
							href="{{url('/faq-candidate')}}"
					>
						I am a candidate
					</a>
				</div>
			</div>

		</div>

		<!-- How it's work ending -->


		<!-- What companies says about starting-->
<div class="row my-5">
	<div class="col-md-12">
		<h1 class="font-weight-bold">What Companies Say About Us!</h1>
	</div>
	<div class="col-md-12 testimonial-wrapper">
		<div class="card testimonial d-inline">
			<div class="card-body" data-toggle="tooltip" title="Really impressed with the features provided by Search Jobs Global. This is a great idea hence brings value to time & money.
					Gone are the days where we have to screen through 100's of CV's.
					We can now purchase the candidates we feel suitable based on the ratings and reviews. The rates are reasonable as well.">
				<p>
					Really impressed with the features provided by Search Jobs Global. This is a great idea hence brings value to time & money.
					Gone are the days where we have to screen through 100's of CV's.
					We can now purchase the candidates we feel suitable based on the ratings and reviews. The rates are reasonable as well.
				</p>
				<div class="d-flex align-items-center justify-content-start">
{{--					<img class="rounded-circle testimonial-pic" src="https://i.pravatar.cc/150?img=7"/>--}}
					<div class="detail">
						<h4 class="text-truncate">
							Arhab Mistha
						</h4>
						<h5 class="text-truncate font-italic">
							M’Bros (Pvt) Ltd
						</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="card testimonial d-inline">
			<div class="card-body" data-toggle="tooltip" title="Search Jobs global completely changed the way we hire. It has never been more easy. We save plenty of time by handing everything over to search jobs global and they do everything for us. And on top of that, we only pay for the ones we recruit!!
">
				<p>
					Search Jobs global completely changed the way we hire. It has never been more easy. We save plenty of time by handing everything over to search jobs global and they do everything for us. And on top of that, we only pay for the ones we recruit!!
				</p>
				<div class="d-flex align-items-center justify-content-start">
{{--					<img class="rounded-circle testimonial-pic" src="https://i.pravatar.cc/150?img=6"/>--}}
					<div class="detail">
						<h4 class="text-truncate">
							Rayhaan Rushdi
						</h4>
						<h5 class="text-truncate font-italic">
							Sports Med (Pvt) Ltd
						</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="card testimonial d-inline">
			<div class="card-body" data-toggle="tooltip" title="We used to spend a great deal of money on job posts where candidates just apply even when they are not suitable for the job and not answer calls or even attend the interview when called if they are suitable. Now with Search Jobs Global, we only have to pay if we like the person who has applied for jobs or if the candidate accepts our connect request. Their packages are reasonable as well. Really impressed with their features. Glad I found them sooner than later.
">
				<p>
					We used to spend a great deal of money on job posts where candidates just apply even when they are not suitable for the job and not answer calls or even attend the interview when called if they are suitable. Now with Search Jobs Global, we only have to pay if we like the person who has applied for jobs or if the candidate accepts our connect request. Their packages are reasonable as well. Really impressed with their features. Glad I found them sooner than later.
				</p>
				<div class="d-flex align-items-center justify-content-start">
					{{--					<img class="rounded-circle testimonial-pic" src="https://i.pravatar.cc/150?img=6"/>--}}
					<div class="detail">
						<h4 class="text-truncate">
							Ilzam Mistha
						</h4>
						<h5 class="text-truncate font-italic">
							Partner at ZRI Adventures
						</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="card testimonial d-inline">
			<div class="card-body" data-toggle="tooltip" title="We would usually get a lot of CVs and only a few of them would attend interviews, and we end up wasting our time allocated for interviews. However, with search jobs global they only charged us for interviews we had and even they took the extra mile to call them and arrange interview for us, thanks to them we were able to recruit hassle free and it saved us a lot of time, would like to wish Zakib and his team good luck with new features coming up.
">
				<p>
					We would usually get a lot of CVs and only a few of them would attend interviews, and we end up wasting our time allocated for interviews. However, with search jobs global they only charged us for interviews we had and even they took the extra mile to call them and arrange interview for us, thanks to them we were able to recruit hassle free and it saved us a lot of time, would like to wish Zakib and his team good luck with new features coming up.
				</p>
				<div class="d-flex align-items-center justify-content-start">
					{{--					<img class="rounded-circle testimonial-pic" src="https://i.pravatar.cc/150?img=6"/>--}}
					<div class="detail">
						<h4 class="text-truncate">
							Aabith Sabeer
						</h4>
						<h5 class="text-truncate font-italic">
							CEO of Simplebooks (Pvt) Ltd
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		<!--What companies says about Ending-->

		<!-- Our Blog staring-->
		<div class="row cards-container text-center mt-3 ourblogsection">
			<div class="col-md-12 mt-4 text-left"><h1><strong>Our Blog</strong></h1></div>
			@foreach ($blogs as $blog)
				<div class="col-sm-12 col-md-6 col-lg-4 mb-3 card-wrapper view-blog"><a href="{{ url('page/'.$blog->slug) }}">
						<div>
							<div class="mx-1 custom-card">
								<div class="image">
									<img src="{{url('images/group931.png')}}" class="pt-4 mt-3 imagecard-blog">
									<h5 class="image-text">{{ $blog->title }}</h5>
								</div>
								<h4 class="pt-4 pb-2 px-3 card-title">{{ $blog->title }}</h4>
								<h4 class="px-2 text-muted">{{ $blog->author }}</h4>
								<p class="px-3 pb-4"><small>{{ $blog->date }}</small></p>
								<!--	{{ Str::limit(strip_tags($blog->content), 200) }}-->
								<!--</p>-->
							</div>
						</div></a>
				</div>
			@endforeach
			<div class="col-sm-12 col-md-12 col-lg-12 pl-5 pb-4 mt-3 text-right">
				<a
						type="button"
						class="btn btn-lg btn btn-primary-upload custom-info-btn "
						href="{{url('/blog')}}"
				>
					Show More
				</a>
			</div>
		</div>

		<!-- Our Blog Ending-->
	</div>
</div>
</div>
@endsection


@section('before_styles')
	<link href="{{url('assets/plugins/slick/slick.css')}}" rel="stylesheet"/>
	<link href="{{url('assets/plugins/slick/slick-theme.css')}}" rel="stylesheet"/>
@endsection
@section('after_scripts')
    <script src="{{url('assets/plugins/slick/slick.min.js')}}"></script>

@endsection
