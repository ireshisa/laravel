
<div class="w-100 page-content d-flex align-self-stretch col-thin-left jobsearch-typo-wrap search-talent" id="filter-content" style="padding-left: 25px">
                    <div class="row w-100">
                        <div class="col-md-12">
                            <div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">
                                <div class="sortfiltrs-contner">
                                    <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
                                        <h2 class="jobsearch-fltcount-title color-black">
{{ $users->total() }}&nbsp;Candidates Matched to your Criteria

</h2>
</div>
</div>
</div>

<div class="wp-jobsearch-candidate-content wp-jobsearch-dev-candidate-content">

    @foreach($users as $user)
        <div class="row person-info" style="margin-bottom: 45px">
            <div class="col-md-12 py-3 d-flex">

                {{-- <img src="http://placehold.it/300x200" alt="" class="img-rounded img-fluid" /> --}}

                {{-- <a href="{{url('search-talent/seeker/'.$user->id)}}"> --}}
                <div class="d-inline-flex  align-items-center justify-content-center">

                    <a href="search-talent/seeker/{{$user->id}}">
                        <img src="{{ $user->avatar_url ? url('images/user.jpg') : url('images/user.jpg')  }}"
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
                                                class="btn btn-block side-button black-btn delete_candidate " data-candidateid="{{$user->id}}"><i class="fa fa-trash mr-2"></i> Unsave Candidate
                                        </button>
                                    @endif
                                @endif
                                {{--                                                            <button type="button" class="btn btn-block side-button"--}}
                                {{--                                                                    style="background-color: #ECB338">--}}
                                {{--                                                                Add--}}
                                {{--                                                                Wishlist--}}
                                {{--                                                            </button>--}}
                            </div>
                        </div>
                        <div class="d-inline-flex flex-grow-1 px-2">
                            <div class="d-block">
                                <h2 class="jobsearch-pst-title">

                                        <a href="{{url('search-talent/seeker/'.$user->id)}}">{{ $user->firstname}}</a>
                                    
                                    
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
                                        @if(!empty($user->city_id))
                                            <li>
                                                <i class="fa fa-map-marker"></i> @if($user->city_id){{$user->city->name}}@endif
                                            </li>
                                        @endif
                                        @if(!empty($user->sector))
                                            <li class="text-truncate"><i
                                                        class="fa fa-filter"></i>{{$user->sector ? $user->sector->name : ''}}
                                            </li>
                                        @endif
                                        @if (!empty($user->endorsements->count()))
                                            <div class="text-truncate d-block">
                                                {{($user->endorsements->count())}} Endorsements

                                            </div>
                                        @endif
                                    </ul>
                                </div>
                                <div class="review mt-2" data-rating="{{ $user->getAverageReviewRate() }}">
                                    <div class="review-stars">
                                        <div class='rating-stars list-rating text-center'>
                                            <ul style="display: flex">
                                                <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent'
                                                    data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
</div>


@section('modal_location')
    @parent
    @include('layouts.inc.modal.location')
@endsection
@section('after_styles')
    <link href="{{asset('assets/plugins/icheck/skins/futurico/futurico.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

@endsection
@section('after_scripts')
    <script src="{{asset('assets/plugins/icheck/icheck.js')}}"></script>
{{--    <script src="{{asset('assets/plugins/jqueryui/1.11.3/jquery-ui.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/formsubmit.js')}}"></script>
    <script>
        $("input[type='checkbox'],input[type='radio']").iCheck({checkboxClass: 'icheckbox_futurico',radioClass: 'icheckbox_futurico'});
        // const queryString = window.location.search;
        //
        // const urlParams = new URLSearchParams(queryString);
        // for (p of urlParams)
        // {
        //     var qName = p[0];
        //     if(p[0]!= "q" && p[0] != "location")
        //     {
        //
        //         if (p[1].includes(','))
        //         {
        //
        //             var arr = p[1].split(',');
        //             arr.forEach(function(value,index) {
        //
        //                 $('input[name='+qName+'][value='+value+']').iCheck('check');
        //             })
        //         }
        //         else {
        //             $('input[name='+qName+'][value='+p[1]+']').iCheck('check');
        //
        //         }
        //     }
        //
        // }
        //
        // $(".find").on('click',function () {
        //     var searchStr = window.location.search;
        //     var searchParams = new URLSearchParams(searchStr);
        //     searchParams.delete("q");
        //     searchParams.delete("location");
        //     if (searchStr != '' || searchStr != null)
        //     {
        //
        //
        //         var searchVal  = 0;
        //         if ($("#search").val() != null && $("#search").val() != '')
        //         {
        //             searchParams.append('q',$("#search").val())
        //             searchVal = 1;
        //
        //         }
        //         if ($("#locSearch").val() != null && $("#locSearch").val() != '')
        //         {
        //             searchParams.append('location',$("#locSearch").val());
        //             console.log("l");
        //            // (searchVal == 0)?"?location="+$("#locSearch").val():"&location="+$("#locSearch").val();
        //
        //         }
        //         // $(this).attr('href',searchStr);
        //     }
        //
        //     window.history.pushState("object or string", "Title", '?'+searchParams.toString());
        //      location.reload();
        // })


        $(".filter-head").on('click', function () {
            $(this).closest('.filter-panel').find('.filter-content').toggle('slow');
        });
        $(".filter-panel:nth-child(3) .filter-content").slideUp();
        $(".filter-panel:nth-child(4) .filter-content").slideUp();
        $(".filter-panel:nth-child(5) .filter-content").slideUp();
        $(".filter-panel:nth-child(6) .filter-content").slideUp();
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

        $("select[name='province']").on('change',function () {
            console.log("changed");
             var qString = generateQueryString();
             console.log(qString);
            if (qString != null && qString != '')
            {
                applySearchFilters(qString);
            }
        })

        $(".filter-content").each(function () {
            $(this).find('.form-check').each(function (index,value) {
                if (index >= 10)
                {
                    $(this).hide();
                }
            })

        });
        $(".filter-content").each(function () {
            if ($(this).children().length > 10)
            {
                $(this).append('<a class="expand"><i class="fa fa-plus"></i> Show More </a>');
                $(this).append('<a class="collapse"><i class="fa fa-minus"></i> Show Less </a>');
                $(this).find(".collapse").hide();
            }
        })

        $("body").on('click','.expand',function() {
            $(this).parent().find('.form-check').show();
            $(this).hide();
            $(this).parent().find(".collapse").show();
        });
        $("body").on('click','.collapse',function() {
            $(this).parent().find('.form-check').each(function (index,value) {
                if (index < 10)
                {
                    $(this).show();


                }
                else
                {
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
            $("#filter-options input[type='checkbox']:checked,#filter-options input[type='radio']:checked").each(function () {

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
            if ($("select[name='province_search']").val() != "") {
                if (str != "")
                {
                    str+="&";
                }
                else {
                    str+="?";
                }
                //$("select[name='province']").trigger('change');
                loc +="province="+$("select[name='province_search']").val();

                if ($("select[name='city_search']").val() != null)
                {
                    loc+="&city=";
                    $("select[name='city_search']").select2('data').forEach(function(item,index) {
                        loc += item.id+",";

                    });
                    loc= loc.substring(0,loc.length-1);
                }
                str +=loc;
            }



            window.history.pushState("object or string", "Title", str);
            return str;
        }


        function applySearchFilters(qStr) {

            $("#filter-content").html("<div class='d-flex align-self-stretch align-items-center w-100 justify-content-center'>" +
                "<div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>" +
                "</div>");
            getData("{{url('/search-talent-filter')}}"+qStr).then((res)=> {

                $("#filter-content").html(res);
            },(res)=> {
                console.log(res);
            })
        }


        $("#salary-range").slider({
            range: true,
            min: 0,
            max: 500000,
            values: [0, 200000],
            slide: function (event, ui) {
                $("#salary-amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#salary-filter").val(ui.values[0] + " - " + ui.values[1]);
                var qString = generateQueryString();
                applySearchFilters(qString);
            }
        });
        // $("#salary-amount").val($("#salary-range").slider("values", 0) +
        //     " - " + $("#salary-range").slider("values", 1));
        $('.candidate_id').click(function () {
            let candidateId = $(this).attr('data-candidateid');
            // alert(candidateId);
            $.ajax({
                url: "{{route('save.candidate')}}",
                type: 'post',
                data: {
                    candidateId: candidateId,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {

                    if (data.logged >= 1) {
                        alert(data.message);
                        location.reload();
                    } else {

                        alert(data.message);
                        location.reload();
                    }

                }
            })

        });


        $('.delete_candidate').click(function () {
            let candidateId = $(this).data('candidateid');
            // alert(candidateId);
            $.ajax({
                url: "{{route('delete.candidate')}}",
                type: 'post',
                data: {
                    candidateId: candidateId,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {


                        alert(data.message);
                        location.reload();


                }
            })

        });


        $(document).ready(function () {

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            console.log(urlParams);
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
                        $("select[name='province_search']").val(p[1]);

                    } else if (p[0] == 'city') {
                        if (urlParams.get('province') != null && urlParams.get('province') != '') {
                            $("select[name='city_search'] option").remove();
                            getData("{{url('ajax/countries/cities/')}}/" + urlParams.get('province')).then((res) => {
                                // console.log(res[0]);
                                res.forEach(function (value, index) {
                                    $("select[name='city_search']").append(new Option(value.text, value.id, false, false));
                                    // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                                });

                                var splited = p[1].split(',');
                                $("select[name='city_search']").val(splited).trigger("change");

                            }, (res) => {

                            })

                        }
                    }


                }

            }

            $('#postType a').click(function (e) {
                e.preventDefault();
                var goToUrl = $(this).attr('href');
                redirect(goToUrl);
            });
            $('#orderBy').change(function () {
                var goToUrl = $(this).val();
                redirect(goToUrl);
            });

            $("input[type='radio']").iCheck({checkboxClass: 'icheckbox_futurico', radioClass: 'icheckbox_futurico'});
            $("select[name='city']").select2({
                placeholder: "Select City/Cities",
                allowClear: true
            });


        });

        $("select[name='city_search']").select2({
            placeholder: "Select City/Cities",
            allowClear: true
        });


        $(".find").on('click', function () {
            var qs = generateQueryString();
            applySearchFilters(qs);
        })



        $("select[name='province_search']").on('change', function () {
            var html = "";
            $("select[name='city_search'] option").remove();
            getData("{{url('ajax/countries/cities/')}}/" + $(this).val()).then((res) => {
                // console.log(res[0]);
                res.forEach(function (value, index) {
                    $("select[name='city_search']").append(new Option(value.text, value.id, false, false)).trigger('change');
                    // html += "<option value='"+value.id+"'>"+value.text+"</option>";
                });
                $("select[name='city_search']").append(html);
            }, (res) => {

            })
        })
    </script>
        <script>
                $(document).ready(function () {

                var current_rating = "{{(!empty($userReview) && count($userReview) > 0)?$userReview[0]->rating:0}}";
                console.log(current_rating);
                if (parseInt(current_rating) > 0) {
                var stars = $("#stars").children('li.star');
                for (i = 0; i < parseInt(current_rating); i++) {
                $(stars[i]).addClass('selected');
                }
                }

                $(".review").each(function () {
                var stars = $(this).find(".rating-stars ul").children('li.star');
                var review_rating = $(this).data('rating');
                for (i = 0; i < parseInt(review_rating); i++) {
                $(stars[i]).addClass('selected');
                }
                })

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
                $("input[name=rating]").val(onStar);
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

@endsection