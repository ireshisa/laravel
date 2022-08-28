<?php

/**
 *
 * ========================================================================================================
 *
 * #################### personal profile calculation system ################################################
 *
 * ========================================================================================================
 *
 * author: Krishna sharma
 */
 
 return [
     
     
     
           'progress_marking'=>[
            	'profile_image_value'=>10,
            	
                'resume_detail_value'=>[
                	'name'=>8,
                	'email'=>8,
                	'phone'=>8,
                	'age'=>8,
                	'gender'=>8,
                	'city_id'=>8,
                	'qualification'=>8,
                	'experience'=>8,
                	'salary'=>8,
                	'skills'=>8,
                	'sector_id'=>10,
                ],
                'employer_marking_profile_value'=>[
                       // 'username'=>5,
                        'name'=>10,
                    	'email'=>5,
                    	'phone'=>5,
                        'company'=>20,
                        'logo'=>20,
                        'address' => 5,
                        'description' => 5,
                        'teamsize_id' =>5,
                        'sector_id' => 5,
                        'yearfound' => 5,
                        'website' => 5,

                    	
                    ],
	           'resume_complete_value'=>70
     
        	],
            'color_statuses'=> [
            	'100' =>'green',
	            '70'=>'blue',
	            '30'=>'yellow'
            ]
     
     ];
 
 
 
