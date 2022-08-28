<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cv-{{$data->name ?? 'Build'}}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        .fa {
            display: inline;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 1;
            font-family: FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

		.mx-1 {
			margin-right: 5px;
		}

        .split_2 {
            width: 50%;
        }

        .left-div {
            float: left;
        }

        .right-div {
            float: right;
        }


        * {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans';
        }

        body {
            background: #aaa;
        }

        .dash {
            content: '';
            width: 100%;
            height: 1px;
            background: #676767;
            display: block;
            clear: both;
        }

        .page {
            width: 1000px;
            height: auto;
            background: white;
            margin: 0px auto;
            position: relative;
            overflow: hidden;
        }

        .page .overlay #left_rect {
            width: 200%;
            height: 500px;
            background: #676767;
            position: absolute;
            z-index: 1;
            transform: rotate(-45deg);
            left: -100%;
            top: -50px;
        }

        .page .overlay #right_rect {
            width: 200%;
            height: 500px;
            background: #26556d;
            position: absolute;
            transform: rotate(16.18deg);
            z-index: 2;
            left: -100px;
            top: -249px;
        }

        .page .left,
        .page .right {
            float: left;
        }

        .page .left {
            width: calc(38.1966% - 50px);
            height: 100%;
            background: #eee;
            padding: 565px 25px 0;
        }

        .page .left img {
            width: 250px;
            position: absolute;
            left: 60px;
            top: 190px;
            z-index: 2;
        }

        .page .left .section {
            margin-bottom: 25px;
        }

        .page .left .section.contact {
            //position: absolute;
            left: 25px;
            bottom: 0;
            margin-bottom: 0px;
        }

        .page .right {
            width: calc(61.8034% - 50px);
            height: 100%;
            margin-top: 200px;
            padding: 25px;
        }

        .page .right .top h1 {
            color: #255571;
            font-size: 35px;
            float: left;
        }

        .page .right .top h2 {
            color: #666;
            font-size: 20px;
            float: left;
            margin-top: 15px;
            margin-left: 10px;
            font-weight: 400;
        }

        .page .right .top:after {
            content: '';
            display: block;
            clear: both;
            height: 25px;
        }

        .page .right .section:after {
            content: '';
            display: block;
            clear: both;
            height: 25px;
        }


        .page .section h1 {
            color: #26556d;
            font-size: 25px;
            text-transform: uppercase;
        }

        .page .right .section .sub {
            padding: 5px 0 10px;
        }

        .page .right .section .sub.half {
            width: 50%;
            float: left;
        }

        .page .right .section .sub h2 {
            color: #676767;
            font-size: 18px;
        }

        .page .right .section .sub h3 {
            color: #676767;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 5px;
        }

        .page .right .section .sub h4,
        .page .left .section p {
            color: #777;
            font-size: 17px;
            font-weight: 400;
        }

        .page .right .section .sub ul {
            margin-left: 30px;
            color: #777;
            font-size: 17px;
            font-weight: 400;
        }

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

		.page .section .heading {
            color: #26556d;
		}

        @media print {
            body{
                -webkit-print-color-adjust:exact;
                -moz-print-color-adjust:exact;
                -ms-print-color-adjust:exact;
                print-color-adjust:exact;
            }
            #printbtn{
                display:none;
            }
            .printrow {
                display: none;
            }
            @page {
                 margin: 0; 
                 
             }
            body { 
                size: A3
                margin: 0.1cm;
                
            }
        }
        


@media screen and (max-width: 500px) {
      .printrow p
{
    display:none !important;
}



.printPage 
{
       margin-top: 21px  !important; 
           margin-right: 25% !important; 
}

}

        
        
    </style>
</head>

<body>
<div class="row printrow" style="height: 60px;
    background: #797676;">
        <p style="width: 75%; padding: 8px; color: white;">(*Please make sure you save as PDF in the print function.
If you have issues in background colour or paper size click on more settings and choose accordingly.)</p>

<div class='col-12'>
    <a class="printPage btn btn-primary " href="#" style="
        float: right;
        font-size: 1.5rem;
        margin-right: 25px;
        text-align: center;
        padding-top: 0px;
        margin-top: -50px;"
       id="printbtn">Print/Download</a>
</div>
</div>
<section class="page" id='contentPdf'>
    <div class="overlay">
        <div id="left_rect"></div>
        <div id="right_rect"></div>
    </div>
    <div class="left">
        @if (!empty($userPhoto))
            <img class="userImg" src="{{ asset('storage/' . $userPhoto) }}" alt="user"
                 style="width:150px;height:150px;left: 107px;">&nbsp;
        @else
            <!-- <img class="userImg" src="{{ url('images/user1.jpg') }}" alt="user"> -->
        @endif
        @if(!empty($data->about_me))
            <div class="section about">
                <h1>About Me</h1>
                <p>
                    {!! $data->about_me ?? "" !!}
                </p>
            </div>
        @endif
        <div class="section contact">
            <h1>Contact</h1>
            <p>
                @if(!empty($data->name)) {{$data->name}} @endif<br> <br>
                @if(!empty($data->email))<b>Email: </b>{{$data->email}} @endif<br>
                @if(!empty($data->location)) <b>Location: </b> {{$data->location}} @endif<br>

                @if(!empty($data->phone)) <b>T: </b>{{$data->phone}} @endif<br>
                @if(!empty($data->mobile)) <b>M: </b>{{$data->mobile}} @endif<br>
                @if(!empty($data->gender))<b>Gender: </b>  {{$data->gender}} @endif<br>
                @if(!empty($data->age)) <b>Age: </b> {{$data->age}} @endif<br>

            </p>
            <br>
            <div class="section social">
                <h2 class="heading">Social Media</h2>
                <p>
                    @if(!empty($data->social_links) && !empty($data->social_links["facebook"]))<i
                            class="fa fa-facebook d-inline-flex "></i> <span
                            class="d-inline-flex mx-1">{{$data->social_links["facebook"]}}</span> @endif<br>
                    @if(!empty($data->social_links) && !empty($data->social_links["twitter"]))<i
                            class="fa fa-twitter d-inline-flex"></i> <span
                            class="d-inline-flex mx-1"> {{$data->social_links["twitter"]}}</span> @endif<br>

                    @if(!empty($data->social_links) && !empty($data->social_links["linkedin"])) <i
                            class="fa fa-linkedin d-inline-flex"></i> <span
                            class="d-inline-flex mx-1">{{$data->social_links["linkedin"]}}</span> @endif<br>

                    @if(!empty($data->social_links) && !empty($data->social_links["instagram"]))<i
                            class="fa fa-instagram d-inline-flex"></i> <span
                            class="d-inline-flex mx-1"> {{$data->social_links["instagram"]}}</span> @endif<br>

                </p>
            </div>

        </div>

    </div>
    <div class="right">
        <div class="top">
            <h1>@if(!empty($data->name)) {{$data->name}} @endif</h1>


        </div>
        @if(!empty($data->extra_educations) && !empty($data->extra_educations['title'][0]))
            @php
                $educations =$data->extra_educations;

            @endphp
            <div class="section">

                <h1>Educations</h1>

                @for($e=0;$e< count($educations['title']); $e++)
                    <div class="sub half">
                        <h2>{{$educations['title'][$e] ?? ""}}</h2>
                        <h3>{{$educations['institue'][$e] ?? ""}}</h3>
                        <h3>{!!$educations['start_date'][$e] ?? ""!!} - {!!(array_key_exists('current',$educations) && ($educations['current'][0] == $e+1))?'current': (!empty($educations['end_date'][$e])?date('Y-m-d',strtotime($educations['end_date'][$e])): "")!!}</h3>
                        <h4>{!!$educations['description'][$e] ?? ""!!}</h4>
                    </div>
                    <span class="dash"></span>
                @endfor

            </div>
        @endif

        @if(!empty($data->extra_experiences) && !empty($data->extra_experiences['title'][0]))
            @php
                $experiences =$data->extra_experiences;

            @endphp
            <div class="section">
                <h1>Experiences</h1>
                @for($ex=0;$ex< count($experiences['title']); $ex++)
                    <div class="sub">
                        <h2>{{$experiences['title'][$ex] ?? ""}}</h2>
                  
                        <h2>{{$experiences['company'][$ex]}}</h2>
                        <h3>{!!$experiences['start_date'][$ex] ?? ""!!} - {!!(array_key_exists('current',$experiences) && ($experiences['current'][0] == $ex+1))?'current': (!empty($experiences['end_date'][$ex])?date('Y-m-d',strtotime($experiences['end_date'][$ex])): "")!!}</h3>
                        @if(!empty($experiences['description'][$ex]))
                            @php
                                $experiences_descs=  array_filter(explode("\r\n", $experiences['description'][$ex]));
                               // dd($experiences_descs);
                            @endphp
                            <ul>
                                @foreach($experiences_descs as $exp_desc)
                                    <li>
                                        {!! $exp_desc ?? ""!!}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <span class="dash"></span>
                @endfor

            </div>
        @endif


        @if(!empty($data->extra_skills) && !empty($data->extra_skills['title'][0]))

            @php
                $skills =$data->extra_skills;
            @endphp
            <div class="section">
                <h1>Skills</h1>
                @for($s=0;$s< count($skills['title']); $s++)
                    <div class="sub half">
                        <h2>{{$skills['title'][$s] ?? ""}}</h2>
{{--                        <h3>{!!$skills['start_date'][$s] ?? ""!!} - {!!$skills['end_date'][$s] ?? ""!!}</h3>--}}
                        @if(!empty($skills['description'][$s]))
                            @php
                                $skill_descs=  array_filter(explode("\r\n", $skills['description'][$s]));
                               // dd($skill_descs);
                            @endphp
                            <ul>
                                @foreach($skill_descs as $skill_desc)
                                    <li>
                                        {!! $skill_desc ?? ""!!}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <span class="dash"></span>
                @endfor
            </div>
        @endif

        @if(!empty($data->acheivements) && !empty($data->acheivements['title'][0]))

            @php
                $acheivements =$data->acheivements;
           //

            @endphp
            <div class="section">
                <h1>Acheivements</h1>

                @for($s=0;$s< count($data->acheivements['title']); $s++)
                    <div class="sub half">
                        <h2>{{$acheivements['title'][$s] ?? ""}}</h2>
{{--                        <h3>{!!$acheivements['start_date'][$s] ?? ""!!} - {!!$acheivements['end_date'][$s] ?? ""!!}</h3>--}}
                        @if(!empty($acheivements['description'][$s]))
                            @php
                                $acheivements=  array_filter(explode("\r\n", $acheivements['description'][$s]));
                               // dd($skill_descs);
                            @endphp
                            <ul>
                                @foreach($acheivements as $skill_desc)
                                    <li>
                                        {!! $skill_desc ?? ""!!}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <span class="dash"></span>
                @endfor
            </div>
        @endif

		@if(!empty($data->referees) && !empty($data->referees['name'][0]) && !empty($data->referees['email'][0]))

        @php
            //dd($data->referees);
                        $acheivements =$data->referees;

        @endphp
        <div class="section" style="line-height: 1.7rem;">
            <h1>Referees</h1>

            <div class="split_2 left-div">
                <h3>{{$data->referees['name'][0]}}</h3>

                @if(!empty($data->referees['position'][0])) <h4>{{$data->referees['position'][0]}}</h4>@endif
                @if(!empty($data->referees['company'][0])) <h4>{{$data->referees['company'][0]}}</h4>@endif
                @if(!empty($data->referees['email'][0])) <h4><span><i class="fa fa-envelope mx-1"></i></span>{{$data->referees['email'][0]}}</h4>@endif
                @if(!empty($data->referees['phone'][0])) <h4><span><i class="fa fa-phone mx-1"></i></span>{{$data->referees['phone'][0]}}</h4>@endif

            </div>
            @if(count($data->referees) > 1 && !empty($data->referees['name'][1]) && !empty($data->referees['email'][1]))

                <div class="right-div" style="">
                    <h3>{{$data->referees['name'][1]}}</h3>
                    @if(!empty($data->referees['position'][1])) <h4>{{$data->referees['position'][1]}}</h4>@endif
                    @if(!empty($data->referees['company'][1])) <h4>{{$data->referees['company'][1]}}</h4>@endif
                    @if(!empty($data->referees['email'][1])) <h4><span><i class="fa fa-envelope mx-1"></i></span>{{$data->referees['email'][1]}}</h4>@endif
                    @if(!empty($data->referees['phone'][1])) <h4><span><i class="fa fa-phone mx-1"></i></span>{{$data->referees['phone'][1]}}</h4>@endif
                </div>
                <span class="dash"></span>

            @endif
        </div>

        @endif


    </div>

</section>

<div id="ignoreContent">
</div>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js" integrity="sha512-s/XK4vYVXTGeUSv4bRPOuxSDmDlTedEpMEcAQk0t/FMd9V6ft8iXdwSBxV0eD60c6w/tjotSlKu9J2AAW1ckTA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js" integrity="sha512-jzL0FvPiDtXef2o2XZJWgaEpVAihqquZT/tT89qCVaxVuHwJ/1DFcJ+8TBMXplSJXE8gLbVAUv+Lj20qHpGx+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('a.printPage').click(function () {
        window.print(); j
        return false;
    });


</script>
</body>
</html>