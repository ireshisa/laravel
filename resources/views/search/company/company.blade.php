
                                <div class="row w-100">
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


                                                        <div class="d-inline-flex logo-container  p-4 align-items-center justify-content-center">

                                                            <a href="company-detail/{{$iCompany->id}}">
                                                                <img src="{{ $iCompany->logo ? asset('storage/' . $iCompany->logo) : url('images/user.jpg')  }}" alt="">
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


                                                                                if(!empty($iCompany->followers) && count($iCompany->followers) > 0)
                                                                                {
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
                                                                                    class="btn btn-block side-button btn-primary"
                                                                                    href="{{url('/companies/'.$iCompany->id.'/unfollow')}}">Unfollow
                                                                            </a>
                                                                            @php

                                                                                }

                                                                            }

                                                                            @endphp
                                                                        @endif
                                                                        <a class="btn btn-block side-button btn-primary btn-transparent color-black" href="{{url('/company-detail/'.$iCompany->id)}}"
                                                                           style="background-color: #ECB338">
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
                                                                                @if(!empty($iCompany->city))
                                                                                    <li>
                                                                                        <i class="fa fa-map-marker"></i> @if($iCompany->city){{$iCompany->city->name}}@endif
                                                                                    </li>
                                                                                @endif
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









