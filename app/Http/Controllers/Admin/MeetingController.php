<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Larapen\Admin\app\Http\Controllers\PanelController;

class MeetingController extends PanelController
{
    public function setup()
    {
        $this->xPanel->setModel("App\Models\Meetings");
        $this->xPanel->setRoute(admin_uri('interviews'));

        $this->xPanel->setEntityNameStrings('Interview', 'Interviews');
        $this->xPanel->with(['post','candidate','employer','report']);
        $this->xPanel->removeAllButtons();
    

        $this->xPanel->addColumn([
            'name'=>'post_id',
            'type'=>'select',
            'label'=>'Job',
            'entity'=>"post",
            'attribute'=>'title',
            'orderable'=>true
        ]);
        
        

        $this->xPanel->addColumn([
            'name'=>'company_id',
            'type'=>'model_function',
            'label'=>'View post',
            'entity'=>"post",
            'function_name'=>'title_function',
            'orderable'=>true
        ]);
        
        
        
        
        
        $this->xPanel->addColumn([
            'name'=>'employer_id',
            'type'=>'select',
            'label'=>'Employer',
            'entity'=>"employer",
            'attribute'=>'name',
            'orderable'=>true
        ]);
        
        
        
        
     
        
    
        
        
        $this->xPanel->addColumn([
            'name'=>'candidate_id',
            'type'=>'select',
            'label'=>'Candidate',
            'entity'=>"candidate",
            'attribute'=>'name',
            'orderable'=>false
        ]);
        
        
        
            
        $this->xPanel->addColumn([
            'name'=>'candidate_view',
            'type'=>'model_function',
            'label'=>'Viw Candidate',
            'function_name'=>'viewcandidate',
            'orderable'=>false
        ]);
        
        $this->xPanel->addColumn([
            'name'=>'id',
            'type'=>'model_function',
            'label'=>'Date & Time',
            'function_name'=>'scheduleDate',
            'orderable'=>false
        ]);
        $this->xPanel->addColumn([
            'name'=>'created_at',
            'type'=>'model_function',
            'label'=>'Created at',
            'function_name'=>'createdAt',
            'orderable'=>false
        ]);

    }
}
