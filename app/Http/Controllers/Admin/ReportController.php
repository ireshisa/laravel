<?php


namespace App\Http\Controllers\Admin;


use App\Models\UserPackage;
use Illuminate\Http\Request;
use App\Models\Meetings;
use App\Models\ReportNoShow;
use App\Notifications\ReportStatusNotification;
use Larapen\Admin\app\Http\Controllers\PanelController;
use Prologue\Alerts\Facades\Alert;

class ReportController extends  PanelController
{
public function setup()
{

   $this->xPanel->setModel('App\Models\ReportNoShow');
   $this->xPanel->denyAccess('create');

  //  Alert::add('success', 'You have successfully logged in')->flash();
   $this->xPanel->with(['meeting','meeting.post']);
    $this->xPanel->setRoute(admin_uri('report'));


  //  $this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
//    $this->xPanel->addFilter([
//        'name'  => 'job_title',
//        'type'  => 'text',
//        'label' => 'Job Title',
//    ],
//        false,
//        function ($value) {
//            $this->xPanel->query = $this->xPanel->query->whereHas('post', function ($query) use ($value) {
//                $query->where('post', $value);
//            });
//        });


    $this->xPanel->addColumn([
        'name'  => 'id',
        'label' => '',
        'type'  => 'checkbox',
        'orderable' => false,
    ]);
    $this->xPanel->addColumn([
        'name'  => 'title',
        'label' => 'Job Title',
        'type'  => 'model_function',
        'function_name'=>'getJobTitle',

    ]);


    $this->xPanel->addColumn([
        'name'  => 'company',
        'label' => 'Company/Employer',
        'type'  => 'model_function',
        'function_name'=>'getCompany',

    ]);

    $this->xPanel->addColumn([
        'name'  => 'company',
        'label' => 'Company/Employer',
        'type'  => 'model_function',
        'function_name'=>'getCompany',

    ]);

    $this->xPanel->addColumn([
        'name'  => 'name',
        'label' => 'Candidate Name',
        'type'  => 'model_function',
        'function_name'=>'getCandidate',

    ]);
    $this->xPanel->addColumn([
        'name'  => 'comments',
        'label' => 'Comments',
        'type'  => 'text',

    ]);

    $this->xPanel->addColumn([
        'name'  => 'status',
        'label' => 'Status',
        'type'  => 'model_function',
        'function_name'=>'getStatus',

    ])->afterColumn('comments');
    $this->xPanel->addColumn([
        'name'  => 'action',
        'label' => 'Actions',
        'type'  => 'model_function',
        'function_name'=>'getActions',

    ])->afterColumn('status');
    $this->xPanel->removeAllButtons();
//    dd($this->xPanel->getColumns());
}



public function reportStatus(Request $request)
{
    $report = ReportNoShow::findOrFail($request->id);
    $report->status_id = $request->status_id;
    $report->load('meeting.employer','meeting.post','meeting.candidate');

    $details = new \stdClass();
    $details->title = $report->meeting->post->title;
    $details->employer_name = $report->meeting->employer->name;

    $details->candidate_name = $report->meeting->candidate->name;
    $details->date = date('j F Y ',strtotime($report->meeting->m_date)).' '.$report->meeting->m_from.' - '.$report->meeting->m_to;
    
    $details->status_id = $request->status_id;
 
    $report->save();
    if ($request->status_id == 1)
    {
        $employerPackage = UserPackage::where('user_id',$report->meeting->employer->id)->first();
        $employerPackage->available_connects +=1;
        $employerPackage->save();
        Alert::add('success', 'Report - No Show is successfully approved')->flash();
    }
    else {
        Alert::add('success', 'Report - No Show request is rejected')->flash();
    }

    $report->meeting->employer->notify(new ReportStatusNotification($details));


    return response()->json($report);


}

}