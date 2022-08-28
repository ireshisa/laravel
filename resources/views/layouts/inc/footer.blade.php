
<footer class="bg text-lg-start  footer">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-5 col-md-12 mb-4 mb-md-0">
        <img class="navbar-brand-footer" src="{{url('images/logo.svg')}}"href="#"></img>
        <br>
        <p class="text-white">
          We have been in the industry for 5+ years and identified that most  of  the  start  ups  find  it  difficult to  employ  potential candidates. We have found the solution to resolve this  issue. We  make the job posting  and  employee  head  hunting free of charge. We will only charge you if both parties have agreed and connected provided that they attend interviews only
        </p>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-2 offset-lg-1 col-md-4 col-sm-12 mb-4">

        <h6 class="text-uppercase footer-title">Quick Links</h6>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="{{url('/our-story')}}" class="text-white">Our Story</a>
          </li>
          <li>
            <a href="{{url('/candidate-support')}}" class="text-white">Contact Us</a>
          </li>
          <li>
            <a href="{{url('/blog')}}" class="text-white">Blog</a>
          </li>
          <li>
            <a href="{{url('/privacy-policy')}}" class="text-white">Privacy Policy</a>
          </li>
          <li>
            <a href="{{url('/terms')}}" class="text-white">Terms of Service</a>
          </li>
        </ul>

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-2 col-md-4 col-sm-12 mb-4 mb-md-0">
       @if (auth()->check() && auth()->user()->user_type_id == 1)
              <div class="mx-auto">
                  <h6 class="text-uppercase footer-title">For Employer</h6>

                  <ul class="list-unstyled mb-0">
                      @if(auth()->check() && auth()->user()->user_type_id == 1)
                          <li>
                              <a href="{{url('/posts/create')}}" class="text-white">Post a New Job</a>
                          </li>
                      @endif
                      <li>
                          <a href="{{url('/search-talent')}}" class="text-white">Search Talents</a>
                      </li>
                      <li>
                          <a href="{{url('/faq-employer')}}" class="text-white">How it Works</a>
                      </li>
                      <li>
                          <a href="{{url('pricing')}}" class="text-white">Pricing</a>
                      </li>
                      <li>
                          <a href="{{url('/candidate-support')}}" class="text-white">Employer Support</a>
                      </li>
                  </ul>
              </div>

          @else
              <div class="mx-auto">
                  <h6 class="text-uppercase footer-title">For Candidates</h6>

                  <ul class="list-unstyled mb-0">
                      @if(auth()->check() && auth()->user()->user_type_id == 2)
                          <li>
                              <a href="{{url('/account/resumes')}}" class="text-white">Upload Resumes</a>
                          </li>
                      @endif
                      <li>
                          <a href="{{__('routes.search')}}" class="text-white">Search Jobs</a>
                      </li>
                      <li>
                          <a href="{{url('/faq')}}" class="text-white">FAQ's</a>
                      </li>
                      <li>
                          <a href="{{url('/resume-advice')}}" class="text-white">Resume Advice & Career Help</a>
                      </li>
                      <li>
                          <a href="{{url('/candidate-support')}}" class="text-white">Candidate Support</a>
                      </li>
                  </ul>
              </div>
           @endif
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-2 col-md-4 col-sm-12 mb-4 mb-md-0">
          <div class="float-md-right float-sm-none mx-sm-auto text-white">
        <h6 class="text-uppercase footer-title">Contact Us</h6>
<div class="contact-wrapper">
        <div class="d-flex justify-content-start align-items-start contact-item">
            <span> <i class="fa fa-map-marker  mr-2" aria-hidden="true"></i></span>
            <span>
            18, Frances Road<br>Colombo 05<br>Sri Lanka
            </span>
        </div>
              <div class="d-flex justify-content-start align-items-start contact-item">
                  <span> <i class="fa fa-phone fa-flip-horizontal mr-2" aria-hidden="true"></i></span>  +9477 894 1243
              </div>
              <div class="d-flex justify-content-start align-items-start contact-item">
                  <span><i class="fa fa-envelope mr-2" aria-hidden="true"></i></span> <span>info@searchjobs.global</span>
              </div>

        <div class="social-box mx-auto d-block contact-item" style="max-width: 145px">
          <div class="d-inline-block"><a href="https://www.facebook.com/zrirecruitment/"><i class="fab fa-facebook-square"></i></a></div>
            <div class="d-inline-block"><a href="#"><i class="fab fa-twitter-square"></i></a></div>
            <div class="d-inline-block"><a href="https://www.linkedin.com/company/search-jobs-global"><i class="fab fa-linkedin"></i></a></div>
            <div class="d-inline-block"><a href="https://instagram.com/searchjobsglobal?igshid=1qde66q3iem3r"><i class="fab fa-instagram"></i></a></div>
        </div>
          </div>
      </div>
      </div>
      <!--Grid column-->



    </div>
    <!--Grid row-->
  </div>
    <hr style="border-color: white">
    <div class="row">
        <div class="col-md-12 text-center text-white mt-2 copyright" style="font-size: smaller;">
            <p>Designed and Developed by Adage Digital</p>
        </div>
    </div>
  <!-- Grid container -->

</footer>


