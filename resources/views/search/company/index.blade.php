{{--
//
--}}
@extends('layouts.master')

@section('search')

@endsection

@section('content')
    <!--@include('common.spacer')-->
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center align-items-center jobs-banner">
            <div class="row">
                <div class="col"></div>
                <div class="col-md-10 text-center"><h1 class="mb-3 banner-title">
                        Finding Your Favorite Companies Just Got Easier!</h1></div>
                <div class="col"></div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center align-items-center jobs-banner-search">
                        <div class="col"></div>
                        <div class="col-md-6">
                            <form action="{{url('/companies')}}" method="get">
                                <div class="input-group searchbar" style="height: 50px">
                                    <input class="form-control" name="search" placeholder="Search Employer" style="height: 50px;"/>
                                    <button type="submit" class="btn btn-blue rounded"><i
                                                class="fa fa-search mr-1"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container grey-background" style="padding-top: 40px">

        <div class="container body-content">

            @if (Session::has('flash_notification'))

                    <div class="row">
                        <div class="col-xl-12">
                            @include('flash::message')
                        </div>
                    </div>

            @endif

            <div class="jobsearch-row">




                <div class="latest-products">
                    <div class="container">
                        <div class="row">


                            <div class="col-md-3 pr-3 mr-5 ml-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap px-3" id="filter-options">



                                <div class="jobsearch-filter-responsive-wrap filter-panel">
                                    <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                        <div class="jobsearch-fltbox-title filter-head ">
                                            <div class="d-inline-block ">
                                                <h4>Locations</h4>
                                            </div>
                                            <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="py-3 filter-content px-2">
                                        <div class="form-group">
                                            <label>Province
                                            </label>
                                            <select class="form-control" name="province">
                                                <option value="">Select Province</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->code}}">{{$province->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>City
                                            </label>
                                            <select class="form-control" multiple="multiple" name="city">

                                            </select>

                                        </div>
                                        <button  class="btn find btn-block btn-primary m-auto"
                                                style="max-width: 200px">
                                            Find
                                        </button>
                                    </div>
                                </div>

                                <!--<div class="jobsearch-filter-responsive-wrap filter-panel">-->
                                <!--    <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">-->
                                <!--        <div class="jobsearch-fltbox-title filter-head ">-->
                                <!--            <div class="d-inline-block ">-->
                                <!--                <h4>Posted</h4>-->
                                <!--            </div>-->
                                <!--            <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i>-->
                                <!--            </div>-->


                                <!--        </div>-->
                                <!--    </div>-->

                                <!--    <div class="filter-content py-3">-->


                                <!--        <div class="form-check pl-0 mb-3">-->
                                <!--            <input type="radio" name="date_posted" value="1h"-->
                                <!--                   class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label small text-uppercase card-link-secondary">Last-->
                                <!--                Hour</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check pl-0 mb-3">-->
                                <!--            <input type="radio" name="date_posted" value="24h"-->
                                <!--                   class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label small text-uppercase card-link-secondary">Last-->
                                <!--                24-->
                                <!--                Hours</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check pl-0 mb-3">-->
                                <!--            <input type="radio" name="date_posted" value="7d"-->
                                <!--                   class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label small text-uppercase card-link-secondary">Last-->
                                <!--                7 Days</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check pl-0 mb-3 pb-1">-->
                                <!--            <input type="radio" name="date_posted" value="14d"-->
                                <!--                   class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label small text-uppercase card-link-secondary">Last-->
                                <!--                14-->
                                <!--                days</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check pl-0 mb-3 pb-1">-->
                                <!--            <input type="radio" name="date_posted" value="30d"-->
                                <!--                   class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label small text-uppercase card-link-secondary">Last-->
                                <!--                30-->
                                <!--                days</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check pl-0 mb-3 pb-1" >-->
                                <!--            <input type="radio" name="date_posted" value="all" class="form-check-input filled-in">-->
                                <!--            <label class="form-check-label  text-capitalize card-link-secondary">All</label>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="jobsearch-filter-responsive-wrap filter-panel">
                                    <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                        <div class="jobsearch-fltbox-title filter-head ">
                                            <div class="d-inline-block ">
                                                <h4>Categories</h4>
                                            </div>
                                            <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                                        </div>
                                    </div>

                                    <div class="filter-content py-3">

                                        @foreach($categories as $category)
                                            <div class="form-check pl-0 mb-3" >
                                                <input type="checkbox" class="form-check-input filled-in" name="category_id" value="{{$category->id}}">
                                                <label class="form-check-label align-middle  text-truncate text-capitalize card-link-secondary" style="max-width: 90%" >{{$category->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="jobsearch-filter-responsive-wrap filter-panel">
                                    <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                        <div class="jobsearch-fltbox-title filter-head ">
                                            <div class="d-inline-block ">
                                                <h4>Team Size</h4>
                                            </div>
                                            <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                                        </div>
                                    </div>

                                    <div class="filter-content py-3">

                                        @foreach($teamSizes as $teamSize)
                                            <div class="form-check pl-0 mb-3" >
                                                <input type="checkbox" class="form-check-input filled-in" name="team_size" value="{{$teamSize->id}}">
                                                <label class="form-check-label align-middle  text-truncate text-capitalize card-link-secondary" style="max-width: 90%" >{{$teamSize->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="jobsearch-filter-responsive-wrap filter-panel">
                                    <div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
                                        <div class="jobsearch-fltbox-title filter-head ">
                                            <div class="d-inline-block ">
                                                <h4>Year found</h4>
                                            </div>
                                            <div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


                                        </div>
                                    </div>

                                    <div class="filter-content py-3">
                                        <label>After</label>
                                        <input name="year_found" type="text" id="yearpicker"
                                               class="" placeholder=""
                                               value="">
                                    </div>
                                </div>

                                <a type="button" class="btn find btn-block btn-primary m-auto" href="{{ url('companies') }}"
                                   style="max-width: 200px">
                                    Reset
                                </a>
                              <br>
                                 <div   value="aasda" class="btn btn-block btn-danger m-auto closebuttone btnmf-none"" onclick="cloce()" style="max-width: 200px">
                        close
                    </div>

                            </div>




                            {{--						<div class="careerfy-employer careerfy-employer-grid" id="jobsearch-employer-3690">--}}
                            <div class="wp-jobsearch-candidate-content col-md-8 pr-0 d-flex align-self-stretch col-sm-12 wp-jobsearch-dev-candidate-content"
                                 id="filter-content">
                                <div class="row w-100">
                                    <div class="col-md-12">
                                                     <center>
                                                         <button type="button" class="btn btn-primary btn-block btnmf-none" onclick="showfilter()"><i class="fa fa-search mr-1"></i> Filter</button>
     
 </center>
                              <br><br>
                              </div>
                                    
                                    
                                    <div class="col-md-12 pr-0">


                                        <div class="section-heading">
                                            <h2 class="jobsearch-fltcount-title">
                                                {{isset($companies)?$companies->count():0}} &nbsp;Employers Found
                                            </h2>
                                        </div>
                                        @if (isset($companies) and $companies->count() > 0)
                                            @foreach($companies as $key => $iCompany)
                                                <div class="row border person-info"
                                                     style="margin-bottom: 45px">
                                                    <div class="col-md-12 py-3 d-flex">
                                                    <?php
                                                    // Get companies URL
                                                    $attr = ['countryCode' => config('country.icode'), 'id' => $iCompany->id];
                                                    $companyUrl = lurl(trans('routes.v-search-company', $attr), $attr);
                                                    ?>
                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
										<a href="{{ $companyUrl }}">
											<img alt="{{ $iCompany->name }}" class="img-fluid" src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}">
											<h6> {{ t('Jobs at') }}
                                                            <span class="company-name">{{ $iCompany->name }}</span>
												<span class="jobs-count text-muted">({{ $iCompany->posts_count }})</span>
											</h6>
										</a>
									</div> -->


                                                        <div class="d-inline-flex logo-container p-4  align-items-center justify-content-center">

                                                            <a href="search-talent/seeker/{{$iCompany->id}}">
                                                                <img src="{{ $iCompany->logo ? asset('storage/' . $iCompany->logo) : url('images/user.jpg')  }}"
                                                                     alt="">
                                                            </a>

                                                        </div>
                                                        <div class="d-inline-flex align-items-center flex-grow-1">
                                                            <div class="w-100 d-flex flex-row-reverse">
                                                                <div class="d-inline-flex flex-shrink-0">
                                                                    <div role="group"
                                                                         aria-label="Basic mixed styles example"
                                                                         class="px-2">
@if(auth()->check() && auth()->user()->user_type_id == 2)
    @php


                   $connected = $iCompany->followers->firstWhere('user_id',auth()->user()->id);

                   if (empty($connected))
                   {

              @endphp


                                                                        <a
                                                                                style=" margin-right: 10px"
                                                                                class="btn btn-block side-button btn-primary"
                                                                                href="{{url('/companies/'.$iCompany->id.'/follow')}}">Follow
                                                                        </a>
    @php
        }
        else {

        @endphp
                                                                            <a
                                                                                    style=" margin-right: 10px"
                                                                                    class="btn btn-block side-button btn-primary "
                                                                                href="{{url('/companies/'.$iCompany->id.'/unfollow')}}">Unfollow
                                                                            </a>
        @php

        }

    

    @endphp
      @endif
                                                                        <a class="btn btn-block side-button btn-primary btn-transparent color-black" href="{{url('/company-detail/'.$iCompany->id)}}">
                                                                            {{$iCompany->posts_count}} Vacancies
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-inline-flex flex-grow-1 px-2">
                                                                    <div class="d-block">
                                                                        <h2 class="jobsearch-pst-title">
                                                                            <a href="company-detail/{{$iCompany->id}}">{{$iCompany->name}}</a>
                                                                            <i class="jobsearch-icon jobsearch-check-mark"
                                                                               style="color: #40d184;"></i>
                                                                        </h2>
                                                                        <div class="d-block">
                                                                            <ul class="person-details">
{{--                                                                                @if(!empty($iCompany->category))--}}
{{--                                                                                    <li>--}}
{{--                                                                                        <i class="fa fa-map-marker"></i> {{$iCompany->category->name}}--}}
{{--                                                                                    </li>--}}
{{--                                                                                @endif--}}
                                                                                {{--                                                                @if(!empty($iCompany->sector))--}}
                                                                                {{--                                                                    <li class="text-truncate"><i--}}
                                                                                {{--                                                                                class="fa fa-filter"></i>{{$user->sector ? $user->sector->name : ''}}--}}
                                                                                {{--                                                                    </li>--}}
                                                                                {{--                                                                @endif--}}
                                                                                {{--																@if(!empty($user->skills))--}}
                                                                                {{--																	<li><a--}}
                                                                                {{--																				class="">--}}
                                                                                {{--																			{{$user->skills}}                </a>--}}
                                                                                {{--																	</li>--}}
                                                                                {{--																@endif--}}
                                                                                @if(!empty($iCompany->city))
                                                                                    <li>
                                                                                        <i class="fa fa-map-marker"></i> @if($iCompany->city){{$iCompany->city->name}}@endif
                                                                                    </li>
                                                                                @endif

                                                                            </ul>
                                                                        </div>

                                                                        {{--                                        <a href="javascript:void(0);"--}}
                                                                        {{--                                           class="jobsearch-candidate-default-btn jobsearch-open-signin-tab candidate_id"--}}
                                                                        {{--                                           data-candidateId="{{$user->id??''}}" style="margin-right: 10px">--}}
                                                                        {{--                                            <i class="jobsearch-icon jobsearch-add-list"></i> Save Candidate </a>--}}

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="pagination-bar text-center">
                                                {{ (isset($companies)) ? $companies->links() : '' }}
                                            </div>
                                        @else
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-category"
                                                 style="width: 100%;">
                                                {{ t('No result. Refine your search using other criteria.') }}
                                            </div>
                                        @endif
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>





    <div style="clear: both"></div>


    </div>

    <div class="col-lg-12 content-box hide">
        <div class="row row-featured row-featured-category row-featured-company">
            <div class="col-lg-12 box-title no-border">
                <div class="inner">
                    <h2>
                        <span class="title-3">{{ t('Companies List') }}</span>
                        <?php $attr = ['countryCode' => config('country.icode')]; ?>
                        <a class="sell-your-item" href="{{ lurl(trans('routes.v-search', $attr), $attr) }}">
                            {{ t('Browse Jobs') }}
                            <i class="icon-th-list"></i>
                        </a>
                    </h2>
                </div>
            </div>

            @if (isset($companies) and $companies->count() > 0)
                @foreach($companies as $key => $iCompany)
                    <?php
                    // Get companies URL
                    $attr = ['countryCode' => config('country.icode'), 'id' => $iCompany->id];
                    $companyUrl = lurl(trans('routes.v-search-company', $attr), $attr);
                    ?>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
                        <a href="{{ $companyUrl }}">
                            <img alt="{{ $iCompany->name }}" class="img-fluid"
                                 src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}">
                            <h6> {{ t('Jobs at') }}
                                <span class="company-name">{{ $iCompany->name }}</span>
                                <span class="jobs-count text-muted">({{ $iCompany->posts_count }})</span>
                            </h6>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-category" style="width: 100%;">
                    {{ t('No result. Refine your search using other criteria.') }}
                </div>
            @endif
            <div class="mt-2">
                <nav class="" aria-label="">
                    {{ (isset($companies)) ? $companies->links() : '' }}
                </nav>
            </div>

        </div>
    </div>



    </div>





@endsection
@section('after_styles')
    <link href="{{asset('assets/plugins/icheck/skins/futurico/futurico.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

@endsection
@section('after_scripts')



   <script>
       
       function cloce()
       {
            var element=document.getElementById("filter-options");
            element.style.display = "none";
       }
             function showfilter()
       {
            var element=document.getElementById("filter-options");
            element.style.display = "block";
       }
       
   </script>





    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">	</script>
    <script>
        $('#yearpicker').datepicker({
            minViewMode: "years",
            format: 'yyyy',
            autoclose: true
        });
    </script>
    <script src="{{asset('assets/plugins/icheck/icheck.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/formsubmit.js')}}"></script>
    {{--    <script src="{{asset('assets/plugins/jqueryui/1.11.3/jquery-ui.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/formsubmit.js')}}"></script>
    <script>
        $("input[type='radio'], input[type='checkbox']").iCheck({checkboxClass: 'icheckbox_futurico', radioClass: 'icheckbox_futurico'});
        $("select[name='city']").select2({
            placeholder: "Select City/Cities",
            allowClear: true
        });
        $(document).ready(function () {


        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);


        for (p of urlParams) {
            var qName = p[0];

            if (p[0] != "province" && p[0] != "city") {
                if (p[1].includes(","))
                {
                    var splitP1 = p[1].split(",");
                    splitP1.forEach(function(item,index) {
                        $('input[name='+qName+'][value='+item+']').iCheck('check');
                    })

                }
                else {
                    $('input[name='+qName+'][value='+p[1]+']').iCheck('check');
                }

            } else {

                if (p[0] == 'province') {
                    $("select[name='province']").val(p[1]);

                } else if (p[0] == 'city') {
                    if (urlParams.get('province') != null && urlParams.get('province') != '') {
                        $("select[name='city'] option").remove();
                        getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
                            // console.log(res[0]);
                            res.forEach(function (value, index) {
                                $("select[name='city']").append(new Option(value.text, value.id, false, false));
                                // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                            });

                            var splited = p[1].split(',');
                            $("select[name='city']").val(splited).trigger("change");

                        }, (res) => {

                        })

                    }
                }


            }

        }
        });

        $(".find").on('click', function () {
            var searchStr = window.location.search;
            var searchParams = new URLSearchParams(searchStr);
            searchParams.delete("province");
            searchParams.delete("city");
            if (searchStr != '' || searchStr != null) {


                var searchVal = 0;
                if ($("select[name='province']").val() != null && $("select[name='province']").val() != '') {
                    searchParams.append('province', $("select[name='province']").val())

                }
                if ($("select[name='city']").val() != null && $("select[name='city']").val() != '') {
                    searchParams.append('city', $("select[name='city']").val());

                    // (searchVal == 0)?"?location="+$("#locSearch").val():"&location="+$("#locSearch").val();

                }
                // $(this).attr('href',searchStr);
            }

            window.history.pushState("object or string", "Title", '?' + searchParams.toString());
            location.reload();
        })

        $("select[name='province']").on('change', function () {
            var html = "";
            $("select[name='city'] option").remove();
            getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
                // console.log(res[0]);
                res.forEach(function (value, index) {
                    $("select[name='city']").append(new Option(value.text, value.id, false, false)).trigger('change');
                    // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                });
                $("select[name='city']").append(html);
            }, (res) => {

            })
        })


        $(".filter-head").on('click', function () {
            $(this).closest('.filter-panel').find('.filter-content').toggle('slow');
        });


        $("input[type='checkbox']").on('ifToggled', function (e) {
            e.preventDefault();

            var qString = generateQueryString();

            applySearchFilters(qString);
        });

        $("input[type='radio']").on('ifChecked', function (e) {
            var qString = generateQueryString();
            if (qString != null && qString != '')
            {
                applySearchFilters(qString);
            }
        });
        
        $("input[type='text']").on('change', function (e) {
            var qString = generateQueryString();

            if (qString != null && qString != '')
            {
                applySearchFilters(qString);
            }
        });


        $(".filter-content").each(function () {
            $(this).find('.form-check').each(function (index, value) {
                if (index >= 10) {
                    $(this).hide();
                }
            })

        });
        $(".filter-content").each(function () {
            if ($(this).children().length > 10) {
                $(this).append('<a class="expand"><i class="fa fa-plus"></i> Show More </a>');
                $(this).append('<a class="collapse"><i class="fa fa-minus"></i> Show Less </a>');
                $(this).find(".collapse").hide();
            }
        })

        $("body").on('click', '.expand', function () {
            $(this).parent().find('.form-check').show();
            $(this).hide();
            $(this).parent().find(".collapse").show();
        });
        $("body").on('click', '.collapse', function () {
            $(this).parent().find('.form-check').each(function (index, value) {
                if (index < 10) {
                    $(this).show();


                } else {
                    $(this).hide();
                }
            });

            $(this).hide();
            $(this).parent().find(".expand").show();
        })

        function generateQueryString() {
            var str = "";
            var field_name = '';
            var counter = 0;
            $(".filter-panel input[type='checkbox']:checked,.filter-panel input[type='radio']:checked").each(function () {

                if (field_name == "")
                {
                    field_name = $(this).attr('name');
                    str +="?"+field_name+'=';
                }
                else if ($(this).attr('name') != field_name)
                {
                    field_name = $(this).attr('name');
                    str += "&"+field_name+"=";
                    counter = 0;
                }

                str +=  ((counter > 0)?','+$(this).val():$(this).val());

                counter++;
            });
            var loc = "";
            //console.log($("select[name='province_search']").val());
            if ($("select[name='province']").val() != "") {
                if (str != "")
                {
                    str+="&";
                }
                else {
                    str+="?";
                }
                //$("select[name='province']").trigger('change');
                loc +="province="+$("select[name='province']").val();

                if ($("select[name='city']").val() != null)
                {
                    loc+="&city=";
                    $("select[name='city']").select2('data').forEach(function(item,index) {
                        loc += item.id+",";

                    });
                    loc= loc.substring(0,loc.length-1);
                }
                str +=loc;
            }

            if ($("input[name='year_found']").val() != null && $("input[name='year_found']").val() != "")
            {
                if (str != "")
                {
                    str+="&";
                }
                else {
                    str+="?";
                }
                str +="year_found="+$("input[name='year_found']").val();
            }

            console.log(str);

            window.history.pushState("object or string", "Title", str);
            return str;
        }


        function applySearchFilters(qStr) {

            $("#filter-content").html("<div class='d-flex align-self-stretch align-items-center w-100 justify-content-center'>" +
                "<div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>" +
                "</div>")
            getData("{{url('/ajax/companies')}}" + qStr).then((res) => {

                $("#filter-content").html(res);
            }, (res) => {
                console.log(res);
            })
        }

    </script>
@endsection