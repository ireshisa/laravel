<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
if (!isset($cacheExpiration)) {
    $cacheExpiration = (int)config('settings.optimization.cache_expiration');
}
?>
@if (isset($latest) and !empty($latest) and !empty($latest->posts))
    @include('home.inc.spacer')

      {{-- <div class="col-xl-12  layout-section">
          <div class="row row-featured row-featured-category">
               --}}
              {{-- <div class="col-xl-12 box-title no-border">
                  <div class="inner">
                      <h2>
                          <span class="title-3">{!! $latest->title !!}</span>
                          <a href="{{ $latest->link }}" class="sell-your-item">
                              {{ t('View more') }} <i class="icon-th-list"></i>
                          </a>
                      </h2>
                  </div>
              </div> --}}
              <!-- ======= Breadcrumbs ======= -->
              <section id="breadcrumbs" class="breadcrumbs" style="margin-top: -50px ; margin-bottom: 20px">
                <div class="container">
                  <div class="col-xl-12  layout-section">
                    <div class="row row-featured row-featured-category">
                      <div class="inner">
                        <h2>
                        <span class="title-3">{!! $latest->title !!}</span>
                        <a href="{{ $latest->link }}" class="sell-your-item">
                            {{ t('View more') }} <i class="icon-th-list"></i>
                        </a>
                        </h2>
                      </div>
                    </div>
                  </div>
                </div>  
              </section>
            <!-- End Breadcrumbs -->

           <!-- section start -->
          <section id="team" class="team ">
              <div class="container">
{{--            <div class="adds-wrapper jobs-list">--}}
                <div class="row">
                <?php
                  foreach($latest->posts as $key => $post):
                      
                      // Get the Post's City
                      $cacheId = config('country.code') . '.city.' . $post->city_id;
                      $city = \Illuminate\Support\Facades\Cache::remember($cacheId, $cacheExpiration, function () use ($post) {
                          $city = \App\Models\City::find($post->city_id);
                          return $city;
                      });
                      if (empty($city)) continue;
  
                      // Get the Post's Type
                      $cacheId = 'postType.' . $post->post_type_id . '.' . config('app.locale');
                      $postType = \Illuminate\Support\Facades\Cache::remember($cacheId, $cacheExpiration, function () use ($post) {
                          $postType = \App\Models\PostType::findTrans($post->post_type_id);
                          return $postType;
                      });
                      if (empty($postType)) continue;
                      
                      // Get the Post's Salary Type
                      $cacheId = 'salaryType.' . $post->salary_type_id . '.' . config('app.locale');
                      $salaryType = \Illuminate\Support\Facades\Cache::remember($cacheId, $cacheExpiration, function () use ($post) {
                          $salaryType = \App\Models\SalaryType::findTrans($post->salary_type_id);
                          return $salaryType;
                      });
                      if (empty($salaryType)) continue;

                      // Convert the created_at date to Carbon object
                      $post->created_at = \Date::parse($post->created_at)->timezone(config('timezone.id'));
                      $post->created_at = $post->created_at->ago();
                      ?>
                  


                        <div class="col-md-6 col-sm-12" style="margin-bottom: 20px">
                          <div class="member d-sm-flex d-xs-block  align-items-start">
                            {{-- <div class="pic">
                              <img src= "https:public/images/flags/32/1.jfif" class="img-fluid" alt="">
                            </div> --}}
                            <div class="pic mb-10">
                                <div class="add-image">
                                    <a href="{{ \App\Helpers\UrlGen::post($post) }}">
                                        <img class="img-thumbnail no-margin" alt="{{ $post->company_name }}" src="{{ imgUrl(\App\Models\Post::getLogo($post->logo), 'medium') }}" width="360" height="270">
                                    </a>
                                </div>
                            </div>

                              <div class="member-info">
                                <h4 class="job-title" >
                                  <a href="{{ \App\Helpers\UrlGen::post($post) }}" style="color: #333; font-weight: 500;">
                                      {{ $post->title }}
                                  </a>
                                </h4>
                              <h5 class="company-title ">
                                  @if (!empty($post->company_id))
                                      <?php $attr = ['countryCode' => config('country.icode'), 'id' => $post->company_id]; ?>
                                      <a href="{{ lurl(trans('routes.v-search-company', $attr), $attr) }}" style="color: #03989e; font-weight: bold;">
                                          {{ $post->company_name }}
                                      </a>
                                  @else
                                      <strong>{{ $post->company_name }}</strong>
                                  @endif
                              </h5>
                              <span class="date"><i class="icon-clock"></i> {{ $post->created_at }}</span>
                              <span class="item-location">
                                  <i class="icon-location-2"></i>&nbsp;
                                  {{ $city->name }}
                              </span>
                              <span class="date"><i class="icon-clock"></i> {{ $postType->name }}</span>
                              <span class="salary">
                                  <i class="icon-money"></i>&nbsp;
                                  @if ($post->salary_min > 0 or $post->salary_max > 0)
                                      @if ($post->salary_min > 0)
                                          {!! \App\Helpers\Number::money($post->salary_min) !!}
                                      @endif
                                      @if ($post->salary_max > 0)
                                          @if ($post->salary_min > 0)
                                              &nbsp;-&nbsp;
                                          @endif
                                          {!! \App\Helpers\Number::money($post->salary_max) !!}
                                      @endif
                                  @else
                                      {!! \App\Helpers\Number::money('--') !!}
                                  @endif
                                  @if (!empty($salaryType))
                                      {{ t('per') }} {{ $salaryType->name }}
                                  @endif
                              </span>

                              <div class="jobs-desc">
                                {!! \Illuminate\Support\Str::limit(strCleaner($post->description), 180) !!}
                            </div>

                            <div class="job-actions">
                                <ul class="list-unstyled list-inline">
                                    @if (auth()->check())
                                        @if (\App\Models\SavedPost::where('user_id', auth()->user()->id)->where('post_id', $post->id)->count() <= 0)
                                            <li id="{{ $post->id }}">
                                                <a class="save-job" id="save-{{ $post->id }}" href="javascript:void(0)">
                                                    <span class="far fa-heart"></span>
                                                    {{ t('Save Job') }}
                                                </a>
                                            </li>
                                        @else
                                            <li class="saved-job" id="{{ $post->id }}">
                                                <a class="saved-job" id="saved-{{ $post->id }}" href="javascript:void(0)">
                                                    <span class="fa fa-heart"></span>
                                                    {{ t('Saved Job') }}
                                                </a>
                                            </li>
                                        @endif
                                    @else
                                        <li id="{{ $post->id }}">
                                            <a class="save-job" id="save-{{ $post->id }}" href="javascript:void(0)">
                                                <span class="far fa-heart"></span>
                                                {{ t('Save Job') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="email-job" data-toggle="modal" data-id="{{ $post->id }}" href="#sendByEmail" id="email-{{ $post->id }}">
                                            <i class="fa fa-envelope"></i>
                                            {{ t('Email Job') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                                {{-- <h4>Need Charted Accountant For Bank</h4> --}}
                                {{-- <span>Published 3 years ago</span> --}}
                                {{-- <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p> --}}
                                <div class="social">
                                  <button type="button" class="btn d-inline d-sm-block btn-danger" style="margin-right: 15px">TEMPORARY</button> <br>
                                  <button type="button" class="btn d-inline d-sm-block  btn-success">FREELANCE</button>

                                </div>
                              
                            </div>
                          </div>
                        </div>

                  
                  {{-- <div class="item-list job-item" style=" border-style: solid;border-width: 4px; border-color: #fff; border-radius: 10px; box-shadow: 4px 0 0 8px rgba(0,0.2,0,0);transition: 0.3s;">
                      <div class="row"> --}}
                          {{-- <div class="col-md-1 col-sm-2 no-padding photobox">
                              <div class="add-image">
                                  <a href="{{ \App\Helpers\UrlGen::post($post) }}">
                                      <img class="img-thumbnail no-margin" alt="{{ $post->company_name }}" src="{{ imgUrl(\App\Models\Post::getLogo($post->logo), 'medium') }}">
                                  </a>
                              </div>
                          </div> --}}
                          
                          {{-- <div class="col-md-10 col-sm-10 add-desc-box">
                              <div class="add-details jobs-item">
                                  <h4 class="job-title" >
                                      <a href="{{ \App\Helpers\UrlGen::post($post) }}" style="color: #333; font-weight: 500;">
                                          {{ $post->title }}
                                      </a>
                                  </h4>
                                  <h5 class="company-title ">
                                      @if (!empty($post->company_id))
                                          <a href="{{ lurl(trans('routes.v-search-company', $attr), $attr) }}" style="color: #03989e; font-weight: bold;">
                                              {{ $post->company_name }}
                                          </a>
                                      @else
                                          <strong>{{ $post->company_name }}</strong>
                                      @endif
                                  </h5>
                                  
                                  <span class="info-row">
                                      <span class="date"><i class="icon-clock"></i> {{ $post->created_at }}</span>
                                      <span class="item-location">
                                          <i class="icon-location-2"></i>&nbsp;
                                          {{ $city->name }}
                                      </span>
                                      <span class="date"><i class="icon-clock"></i> {{ $postType->name }}</span>
                                      <span class="salary">
                                          <i class="icon-money"></i>&nbsp;
                                          @if ($post->salary_min > 0 or $post->salary_max > 0)
                                              @if ($post->salary_min > 0)
                                                  {!! \App\Helpers\Number::money($post->salary_min) !!}
                                              @endif
                                              @if ($post->salary_max > 0)
                                                  @if ($post->salary_min > 0)
                                                      &nbsp;-&nbsp;
                                                  @endif
                                                  {!! \App\Helpers\Number::money($post->salary_max) !!}
                                              @endif
                                          @else
                                              {!! \App\Helpers\Number::money('--') !!}
                                          @endif
                                          @if (!empty($salaryType))
                                              {{ t('per') }} {{ $salaryType->name }}
                                          @endif
                                      </span>
                                  </span>
  
                                  <div class="jobs-desc">
                                      {!! \Illuminate\Support\Str::limit(strCleaner($post->description), 180) !!}
                                  </div>
  
                                  <div class="job-actions">
                                      <ul class="list-unstyled list-inline">
                                          @if (auth()->check())
                                              @if (\App\Models\SavedPost::where('user_id', auth()->user()->id)->where('post_id', $post->id)->count() <= 0)
                                                  <li id="{{ $post->id }}">
                                                      <a class="save-job" id="save-{{ $post->id }}" href="javascript:void(0)">
                                                          <span class="far fa-heart"></span>
                                                          {{ t('Save Job') }}
                                                      </a>
                                                  </li>
                                              @else
                                                  <li class="saved-job" id="{{ $post->id }}">
                                                      <a class="saved-job" id="saved-{{ $post->id }}" href="javascript:void(0)">
                                                          <span class="fa fa-heart"></span>
                                                          {{ t('Saved Job') }}
                                                      </a>
                                                  </li>
                                              @endif
                                          @else
                                              <li id="{{ $post->id }}">
                                                  <a class="save-job" id="save-{{ $post->id }}" href="javascript:void(0)">
                                                      <span class="far fa-heart"></span>
                                                      {{ t('Save Job') }}
                                                  </a>
                                              </li>
                                          @endif
                                          <li>
                                              <a class="email-job" data-toggle="modal" data-id="{{ $post->id }}" href="#sendByEmail" id="email-{{ $post->id }}">
                                                  <i class="fa fa-envelope"></i>
                                                  {{ t('Email Job') }}
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
  
                              </div>
                          </div> --}}



                  
                <?php endforeach; ?>
                </div>
{{--            </div>--}}
    </div>
    </section>

              <!-- section end -->
                  
          
                  
          

              <!--<div class="tab-box save-search-bar text-center">-->
              <!--    <?php $attr = ['countryCode' => config('country.icode')]; ?>-->
              <!--    <a class="text-uppercase" href="{{ lurl(trans('routes.v-search', $attr), $attr) }}">-->
              <!--        <i class="icon-briefcase"></i> {{ t('View all jobs') }}-->
              <!--    </a>-->
              <!--</div>-->
{{--          </div>--}}

{{--      </div>--}}
{{--  </div>--}}



<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs" style="margin-bottom: 40px">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>FEATURED JOBS LISTING</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>FEATURED JOBS LISTING</li>
        </ol>
      </div>
    </div>
</section>
<!-- End Breadcrumbs -->


  <!-- ======= Team Section ======= -->
    <section id="team" class="team ">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="https:public/images/flags/32/1.jfif" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Need Charted Accountant For Bank</h4>
                  <span>Published 3 years ago</span>
                  <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                  <div class="social">
                    <button type="button" class="btn btn-danger">TEMPORARY</button>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-6 mt-4 mt-lg-0">
              <div class="member d-flex align-items-start">
                <div class="pic"><img src="https:public/images/flags/32/3.png" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Accountant For Yearly Audit Required</h4>
                  <span>Published 3 years ago</span>
                  <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                  <div class="social">
                    <button type="button" class="btn btn-success">FREELANCE</button>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-6 mt-4">
              <div class="member d-flex align-items-start">
                <div class="pic"><img src="https:public/images/flags/32/5.png" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Marketing Expert Organization</h4>
                  <span>Published 3 years ago</span>
                  <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                  <div class="social">
                    <button type="button" class="btn btn-danger">TEMPORARY</button>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-6 mt-4">
              <div class="member d-flex align-items-start">
                <div class="pic"><img src="https:public/images/flags/32/4.jpg" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4> Receptionist Female For Banking</h4>
                  <span>Published 3 years ago</span>
                  <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                  <div class="social">
                    <button type="button" class="btn btn-success">FREELANCE</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mt-4">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="https:public/images/flags/32/6.jfif" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>    We Need A Senior Print Designer</h4>
                    <span>Published 3 years ago</span>
                    <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                    <div class="social">
                        <button type="button" class="btn btn-danger">TEMPORARY</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="https:public/images/flags/32/121.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4> Voluntary  For Organization</h4>
                    <span>Published 3 years ago</span>
                    <p>Califonia <i class="fa fa-filter" aria-hidden="true"></i> Automotive Jobs</p>
                    <div class="social">
                        <button type="button" class="btn btn-success">FREELANCE</button>
                    </div>
                  </div>
                </div>
              </div>
  
          </div>
        </div>
      </section>
      <!-- End Team Section -->

  <!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs" style="margin-bottom: 40px">
    <div class="container">
       <div class="d-flex justify-content-between align-items-center">
        <h2>POPULAR JOB CATEGORIES</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>POPULAR JOB CATEGORIES</li>
        </ol>
      </div>
  </div>
</section><!-- End Breadcrumbs -->

  
  <!-- Page Content -->
  <div class="container">
      <!-- Team Members -->

    <div class="row">
      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/campaign-creators-gMsnXqILjp4-unsplash.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Sales & Marketing</h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
          
        </div>
      </div>
      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/daniel-bestjumpstarterreview-com-jbPWzyKPGbU-unsplash.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Automobile Jobs</h4>
            <h6 class="card-subtitle mb-2 text-muted">2 Vacancies</h6>
          </div>
          
        </div>
      </div>
      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/thisisengineering-raeng-df7erzy97sg-unsplash.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title"> Constraction/Facilities</h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/kendal-L4iKccAChOc-unsplash.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Health Care</h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

      

      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/edu.jfif" alt="">
          <div class="card-body">
            <h4 class="card-title">Education Training </h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/tele.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Telecommunication </h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/acc.jfif" alt="">
          <div class="card-body">
            <h4 class="card-title">Accounting / Finance </h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

      <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/nathan-dumlao-6VhPY27jdps-unsplash.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Restaurant / Food Service </h4>
            <h6 class="card-subtitle mb-2 text-muted">3 Vacancies</h6>
          </div>
         
        </div>
      </div>

    </div>
</div>

    <!-- /.row -->

          <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs" style="margin-bottom: 40px">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>TESTIMONIALS </h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>TESTIMONIALS</li>
        </ol>
      </div>

    </div>
    </section><!-- End Breadcrumbs -->




    
  <!-- Page Content -->
  <div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <!-- Intro Content -->
    <div class="row">
      <div class="col-lg-6">
        <img class="img-fluid rounded mb-4" src="https:public/images/flags/32/chase-clark-dGqWUPPesrQ-unsplash.jpg" alt="">
      </div>
      <div class="col-lg-6">
        <h3>What Companies sav about Us!</h3>
        <p><h2> "I Just got a job that  I applied for via careerfy! <br>
              I used the site all the time during my job hurt"</h2></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
      </div>
    </div>
  </div>

    <!-- /.row -->


             <!-- ======= Breadcrumbs ======= -->
             <section id="breadcrumbs" class="breadcrumbs" style="margin-bottom: 40px">
                <div class="container">
            
                  <div class="d-flex justify-content-between align-items-center">
                    <h2>FROM OUR BLOGS </h2>
                    <ol>
                      <li><a href="index.html">Home</a></li>
                      <li>FROM OUR BLOGS</li>
                    </ol>
                  </div>
            
                </div>
                </section><!-- End Breadcrumbs -->


    

  <!-- Page Content -->
  <div class="container">

   

    
    

   

    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/tabs-2.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Make sure your resume is complete</h4>
            <h6 class="card-subtitle mb-2 text-muted" style="color: #C62121">BLOGS</h6>
            <p class="card-text">Your resume is one of the key factors to kicking off a strong job search. Not sure how yours stand? Get a free resume evaluation today from the experts at <strong><span>Search Jobs</span></strong></p>
          </div>
          <div class="card-footer">
            <a href="{{ lurl('page/blog')}}">
            <button type="button"  class="btn btn-success" style="background-color: #03989e"> Read Article More</button>
            </a> 
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/tabs-3.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Let the employers Find you</h4>
            <h6 class="card-subtitle mb-2 text-muted" style="color: #C62121">BLOGS</h6>
            <p class="card-text">This one is a no-brainer:<strong><span> Signing up for an account on Search Jobs </strong></span> is the quickest way to turn that shiny new resume of yours into interviews.</p>
          </div>
          <div class="card-footer">
            <a href="{{ lurl('page/blog')}}">
            <button type="button"  class="btn btn-success" style="background-color: #03989e"> Read Article More</button>
            </a>           
            </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="https:public/images/flags/32/tabs-4.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Get alerted as soon as your preferred jobs are posted </h4>
            <h6 class="card-subtitle mb-2 text-muted" style="color: #C62121">BLOGS</h6>
            <p class="card-text">Be the first to know about recently posted jobs by setting up job alerts on Search Jobs. First, if you’re signed into your account,and the search will be stored under your <strong><span>“saved searches” </strong></span>area of your profile.</p>
          </div>
          <div class="card-footer">
            <a href="{{ lurl('page/blog')}}">
            <button type="button"  class="btn btn-success" style="background-color: #03989e"> Read Article More</button>
            </a>           
        </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
            


     
  

  















   


@endif

@section('modal_location')
    @parent
    @include('layouts.inc.modal.send-by-email')
@endsection

@section('after_scripts')
    @parent
    <script>
        /* Favorites Translation */
		var lang = {
			labelSavePostSave: "{!! t('Save Job') !!}",
			labelSavePostRemove: "{{ t('Saved Job') }}",
			loginToSavePost: "{!! t('Please log in to save the Ads.') !!}",
			loginToSaveSearch: "{!! t('Please log in to save your search.') !!}",
			confirmationSavePost: "{!! t('Post saved in favorites successfully !') !!}",
			confirmationRemoveSavePost: "{!! t('Post deleted from favorites successfully !') !!}",
			confirmationSaveSearch: "{!! t('Search saved successfully !') !!}",
			confirmationRemoveSaveSearch: "{!! t('Search deleted successfully !') !!}"
		};
		
		$(document).ready(function ()
		{
            /* Get Post ID */
			$('.email-job').click(function(){
				var postId = $(this).attr("data-id");
				$('input[type=hidden][name=post]').val(postId);
			});
			
			@if (isset($errors) and $errors->any())
				@if (old('sendByEmailForm')=='1')
                    $('#sendByEmail').modal();
                @endif
            @endif
		});
    </script>
@endsection