<div class="row w-100">
    <div class="col-md-12">
        <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">
            <div class="sortfiltrs-contner">
                <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                    <h2 class="jobsearch-fltcount-title color-black">
                        {{ $users->total() }}&nbsp;Candidates Found

                    </h2>
                </div>
            </div>
        </div>

        <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">

            @foreach($users as $user)
                <div class="row person-info" style="margin-bottom: 45px">
                    <div class="col-md-12 py-3 d-flex">

                        {{-- <img src="http://placehold.it/300x200" alt="" class="img-rounded img-fluid" /> --}}

                        {{-- <a href="search-talent/seeker/{{$user->id}}"> --}}
                        <div class="d-inline-flex  align-items-center justify-content-center">

                            <a href="search-talent/seeker/{{$user->id}}">
                                <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : url('images/user.jpg')  }}"
                                     class="img-rounded" alt="">
                            </a>

                        </div>
                        <div class="d-inline-flex align-items-center flex-grow-1">
                            <div class="w-100 d-flex flex-row-reverse">
                                <div class="d-inline-flex flex-shrink-0">
                                    <div role="group" aria-label="Basic mixed styles example"
                                         class="px-2">

                                        @if(auth()->check() && auth()->user()->user_type_id == 1)
                                            @if(!in_array($user->id,$saved))
                                                <button type="button "
                                                        style="background-color: #03989e; margin-right: 10px"
                                                        class="btn btn-block side-button black-btn candidate_id " data-candidateid="{{$user->id}}"><i class="fa fa-save mr-2"></i> Save Candidate
                                                </button>
                                            @else
                                                <button type="button "
                                                        style="background-color: #03989e; margin-right: 10px"
                                                        class="btn btn-block side-button black-btn delete_candidate " data-candidateid="{{$user->id}}"><i class="fa fa-trash mr-2"></i> Leave
                                                </button>
                                            @endif
                                        @endif
{{--                                        <button type="button" class="btn btn-block side-button"--}}
{{--                                                style="background-color: #ECB338">--}}
{{--                                            Add--}}
{{--                                            Wishlist--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                                <div class="d-inline-flex flex-grow-1 px-2">
                                    <div class="d-block">
                                        <h2 class="jobsearch-pst-title">
                                            <a href="search-talent/seeker/{{$user->id}}">{{explode(' ',$user->name)[0] ?? $user->name}}</a>
                                            <i class="jobsearch-icon jobsearch-check-mark"
                                               style="color: #40d184;"></i>
                                        </h2>
                                        <div class="d-block">
                                            <ul class="person-details">
                                                @if(!empty($user->skills))
                                                    <li><a
                                                                class="">
                                                            {{$user->skills}}                </a>
                                                    </li>
                                                @endif
                                                @if(!empty($user->location))
                                                    <li>
                                                        <i class="fa fa-map-marker"></i> @if($user->location){{$user->location}}@endif
                                                    </li>
                                                @endif
                                                @if(!empty($user->sector))
                                                    <li class="text-truncate"><i
                                                                class="fa fa-filter"></i>{{$user->sector ? $user->sector->name : ''}}
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
        </div>


        {{-- <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content"style="margin-top: 10px">
            <div class="well well-sm border border-info">
                <div class="row">
                    <div class="col-sm-4 col-md-6 col-lg-4">
                        <img src="http://placehold.it/300x200" alt="" class="img-rounded img-fluid" />
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-5">
                        <h4>Abraham Lincoln</h4>
                        <small><cite title="San Diego, USA">San Diego, USA <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>lorem@random.net
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="https://www.prepbootstrap.com">www.prepbootstrap.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>January 19, 1993
                        </p>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" style="background-color: #03989e; margin-right: 10px" class="btn btn-">Save Candidate</button>
                            <button type="button" class="btn btn-" style="background-color: #ECB338">Add Wishlist</button>
                          </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <style>
            .wrap {
                padding-top: 30px;
            }

            .glyphicon {
                margin-bottom: 10px;
                margin-right: 10px;
            }

            small {
                display: block;
                color: #888;
            }

            /* .well
            {
                border: 1px solid blue;
            } */
        </style>
        {{-- <div class="sortfiltrs-contner">
            <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                <h2 class="jobsearch-fltcount-title">
                    {{ $users->total() }}&nbsp;Candidates Found

                </h2>
            </div>
        </div> --}}
        <div class="mt-2">
            <nav class="" aria-label="">
                {{ (isset($users)) ? $users->links() : '' }}
            </nav>
        </div>
    </div>
</div>