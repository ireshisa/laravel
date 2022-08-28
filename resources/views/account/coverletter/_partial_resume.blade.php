<hr>
       <div class="text-center">
          <label  class=" col-form-label">Educations</label>
          </div>
          <hr>
         
          <div class="moreEducations">
              @if(!empty($data['extra_educations']))
                 @php
                 $education=$data['extra_educations'];
                 $count= count($data['extra_educations']['title']);
                @endphp
                @for($e=0;$e<$count;$e++)
                    @if($e==0)
                          <div class="form-group row ">
{{--                               <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
                                   <div class="col-sm-11 float-right">
                                       <input type="date" name="extra_educations[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$education['start_date'][$e] ?? ""}}">
                                       <input type="date" name="extra_educations[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$education['end_date'][$e] ?? ""}}">
                                       <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Title" value="{{$education['title'][$e] ?? ""}}">
                                       <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education">{{$education['description'][$e] ?? ""}}</textarea>
                                   </div>
                              <div class="text-right"><span class="btn btn-success btn-sm addEducation">+</span></div>
                       </div>
                      @else
                          <div class="form-group row ">
{{--                                <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
                                    <div class="col-sm-11 float-right">
                                        <input type="date" name="extra_educations[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$education['start_date'][$e] ?? ""}}">
                                        <input type="date" name="extra_educations[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$education['end_date'][$e] ?? ""}}">
                                        <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Title" value="{{$education['title'][$e] ?? ""}}">
                                        <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education">{{$education['description'][$e] ?? ""}}</textarea>
                                    </div>
                            <a href="#" class="remove_education_field"><span class="btn btn-danger btn-sm">-</span></a>
                          </div>
                    @endif
                  @endfor
                  @else
                  <div class="form-group row ">
{{--                        <label for="inputEducations" class="col-sm-2 col-form-label"> </label>--}}
                            <div class="col-sm-11 float-right">
                                <input type="date" name="extra_educations[start_date][]" class="form-control" placeholder="Enter Start Date">
                                 <input type="date" name="extra_educations[end_date][]" class="form-control" placeholder="Enter End Date">
                                <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Education Level">
                                <textarea class="form-control" id="inputEducations" name="extra_educations[description][]" placeholder="About Educations"></textarea>
                            </div>
                        <div class="text-right"><span class="btn btn-success btn-sm addEducation">+</span></div>
                    </div>
                  @endif
          </div>
    <hr>
    <div class="text-center">
       <label  class=" col-form-label">Skills</label>
       </div>
       <hr>
      
       <div class="moreSkills">
         @if(!empty($data['extra_skills']))
               @php
               $extra_skills=$data['extra_skills'];
               $count= count($data['extra_skills']['title']);
              @endphp
              @for($s=0;$s<$count;$s++)
                  @if($s==0)
               <div class="form-group row ">
{{--                      <label for="inputSkill" class="col-sm-2 col-form-label"> </label>--}}
                          <div class="col-sm-11 float-right">
                              <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_skills['start_date'][$s] ?? ""}}">
                              <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_skills['end_date'][$s] ?? ""}}">
                              <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name" value="{{$extra_skills['title'][$s] ?? ""}}">
                              <textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill">{{$extra_skills['description'][$s] ?? ""}}</textarea>
                          </div>
                   <div class="text-right"><span class="btn btn-success btn-sm addSkill">+</span></div>
              </div>
               @else
                <div class="form-group row ">
{{--                <label for="inputSkill" class="col-sm-2 col-form-label"> </label>--}}
                   <div class="col-sm-11 float-right">
                       <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_skills['start_date'][$s] ?? ""}}">
                       <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_skills['end_date'][$s] ?? ""}}">
                       <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name" value="{{$extra_skills['title'][$s] ?? ""}}">
                       <textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill">{{$extra_skills['description'][$s] ?? ""}}</textarea>
                   </div>
                <a href="#" class="remove_skill_field"><span class="btn btn-danger btn-sm">-</span></a>
                </div>
                @endif
              @endfor
             @else
                <div class="form-group row ">
{{--                <label for="inputSkills" class="col-sm-2 col-form-label"> </label>--}}
                <div class="col-sm-11 float-right">
                    <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date">
                    <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date">
                    <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name">
                    <textarea class="form-control" id="inputSkills" name="extra_skills[description][]" placeholder="About Skills"></textarea>
                </div>
                <div class="text-right"><span class="btn btn-success btn-sm addSkill">+</span></div>
                </div>
             @endif
       </div>
    <hr>
    <div class="text-center">
    <label  class=" col-form-label">Experience</label>
    </div>
    <hr>
    
 
    <div class="moreExperience">
        @if(!empty($data['extra_experiences']))
      {{--       @dd($data['extra_experiences'])--}}
             @php
              $extra_experiences=$data['extra_experiences'];
              $count= count($data['extra_experiences']['title']);
             @endphp
             @for($i=0;$i<$count;$i++)
                 @if($i==0)
                    <div class="form-group row ">
{{--                             <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
                                 <div class="col-sm-11 float-right">
                                     <input type="date" name="extra_experiences[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_experiences['start_date'][$i] ?? ""}}">
                                      <input type="date" name="extra_experiences[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_experiences['end_date'][$i] ?? ""}}">
                                     <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Title" value="{{$extra_experiences['title'][$i] ?? ""}}">
                                     <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience">{{$extra_experiences['description'][$i] ?? ""}}</textarea>
                                 </div>
                        <div class="text-right"><span class="btn btn-success btn-sm addExperience">+</span></div>
                      </div>
                 @else
                  <div class="form-group row ">
{{--                         <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
                             <div class="col-sm-11 float-right">
                                 <input type="date" name="extra_experiences[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_experiences['start_date'][$i] ?? ""}}">
                                  <input type="date" name="extra_experiences[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_experiences['end_date'][$i] ?? ""}}">
                                 <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Title" value="{{$extra_experiences['title'][$i] ?? ""}}">
                                 <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience">{{$extra_experiences['description'][$i] ?? ""}}</textarea>
                             </div>
                     <a href="#" class="remove_experience_field"><span class="btn btn-danger btn-sm">-</span></a>
                  </div>
                @endif
              @endfor
         @else
            <div class="form-group row ">
{{--                    <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
                        <div class="col-sm-11 float-right">
                            <input type="date" name="extra_experiences[start_date][]" class="form-control" placeholder="Enter Start Date">
                             <input type="date" name="extra_experiences[end_date][]" class="form-control" placeholder="Enter End Date" >
                            <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Title">
                            <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience"></textarea>
                        </div>
                    <div class="text-right"><span class="btn btn-success btn-sm addExperience">+</span></div>
                </div>
        @endif
        
    </div>

@push('scripts')
    
    
    <script >
           'use stick';
           
           $(document).ready(function() {
           	var max_fields      = 11; //maximum input boxes allowed
           	var wrapper   		= $(".moreExperience"); //Fields wrapper
           	var add_button      = $(".addExperience"); //Add button ID
           	
           	var x = 1; //initlal text box count
           	$(add_button).click(function(e){ //on add input button click
           		e.preventDefault();
           		if(x < max_fields){ //max input box allowed
           			x++; //text box increment
           			$(wrapper).append(`<div>
                            <div class="form-group row ">
<!--                              <label for="inputExperience" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-11 float-right">
                                      <input type="date" name="extra_experiences[start_date][]" class="form-control" placeholder="Enter Start Date">
                                       <input type="date" name="extra_experiences[end_date][]" class="form-control" placeholder="Enter End Date">
                                      <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Title">
                                      <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience"></textarea>
                                  </div>
                          <a href="#" class="remove_experience_field"><span class="btn btn-danger btn-sm">-</span></a>
                      </div>
                    </div>
           			`); //add input box
           		}
           	});
           	
           	$(wrapper).on("click",".remove_experience_field", function(e){ //user click on remove text
           		e.preventDefault(); $(this).parent('div').remove(); x--;
           	})
           });
           $(document).ready(function() {
           	var max_fields      = 11; //maximum input boxes allowed
           	var wrapper   		= $(".moreSkills"); //Fields wrapper
           	var add_button      = $(".addSkill"); //Add button ID
           	
           	var x = 1; //initlal text box count
           	$(add_button).click(function(e){ //on add input button click
           		e.preventDefault();
           		if(x < max_fields){ //max input box allowed
           			x++; //text box increment
           			$(wrapper).append(`<div>
                            <div class="form-group row ">
<!--                              <label for="inputSkill" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-11 float-right">
                                      <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date">
                                      <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date">
                                      <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name">
                                      <textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill"></textarea>
                                  </div>
                          <a href="#" class="remove_skill_field"><span class="btn btn-danger btn-sm">-</span></a>
                      </div>
                    </div>
           			`); //add input box
           		}
           	});
           	
           	$(wrapper).on("click",".remove_skill_field", function(e){ //user click on remove text
           		e.preventDefault(); $(this).parent('div').remove(); x--;
           	})
           });
           $(document).ready(function() {
           	var max_fields      = 11; //maximum input boxes allowed
           	var wrapper   		= $(".moreEducations"); //Fields wrapper
           	var add_button      = $(".addEducation"); //Add button ID
           	
           	var x = 1; //initlal text box count
           	$(add_button).click(function(e){ //on add input button click
           		e.preventDefault();
           		if(x < max_fields){ //max input box allowed
           			x++; //text box increment
           			$(wrapper).append(`<div>
                            <div class="form-group row ">
<!--                              <label for="inputEducation" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-11 float-right">
                                      <input type="date" name="extra_educations[date][]" class="form-control" placeholder="Enter Start Date">
                                       <input type="date" name="extra_educations[end_date][]" class="form-control" placeholder="Enter End Date">
                                      <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Title">
                                      <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education"></textarea>
                                  </div>
                          <a href="#" class="remove_education_field"><span class="btn btn-danger btn-sm">-</span></a>
                      </div>
                    </div>
           			`); //add input box
           		}
           	});
           	
           	$(wrapper).on("click",".remove_education_field", function(e){ //user click on remove text
           		e.preventDefault(); $(this).parent('div').remove(); x--;
           	})
           });
      
    </script>
	@endpush
