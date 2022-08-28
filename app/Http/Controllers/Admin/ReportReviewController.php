<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Models\ReportReview;
use App\Notifications\ReportReview as ReportReviewNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Larapen\Admin\app\Http\Controllers\PanelController;

class ReportReviewController extends PanelController
{

    public function setup()
    {
        $this->xPanel->setModel('App\Models\ReportReview');
//        if (!request()->input('order')) {
//            $this->xPanel->orderBy('created_at', 'DESC');
//        }
        $this->xPanel->denyAccess('create');
        $this->xPanel->denyAccess('update');
        $this->xPanel->setRoute(admin_uri('report-review'));
        $this->xPanel->setEntityNameStrings('Report Review', 'Report Reviews');
        $this->xPanel->addButtonFromModelFunction('line', 'reject_btn', 'rejectBtn', 'beginning');
        $this->xPanel->addButtonFromModelFunction('line', 'approve_btn', 'approveBtn', 'beginning');

//        $this->xPanel->addColumn([
//            'name'  => 'name',
//            'label' => 'Name',
//        ]);
        $this->xPanel->addColumn([
            'name'      => 'candidate_id',
            'label'     => 'Candidate',
            'model'     => 'App\Models\User',
            'entity'    => 'candidate_id',
            'attribute' => 'name',
            'type'      => 'select',
        ]);
        $this->xPanel->addColumn([
            'name'      => 'review_id',
            'label'     => 'Review',
            'model'     => 'App\Models\Review',
            'entity'    => 'review',
            'attribute' => 'comment',
            'type'      => 'select',
        ]);
        $this->xPanel->addColumn([
            'name'      => 'review_status_id',
            'label'     => 'Status',
//            'model'     => 'App\Models\ReviewStatus',
//            'entity'    => 'status',
//            'attribute' => 'review_status',
            'type'      => 'model_function',
            'function_name'=> 'get_review_status'
        ]);

        $this->xPanel->addColumn([
            'name'      => 'comments',
            'label'     => 'Comments'
        ]);
        $this->xPanel->removeAllButtons();
    }
   public function updateReviewReport(Request $request)
{
  $obj = $request->toArray();
    $report = ReportReview::with(['review','candidate_id'])->updateOrCreate(["id"=>$request->id],$obj);
    $report->load('status');
    $mail = new \stdClass();
    $mail->review = $report->review->comment;
    $mail->subject = "Your Report on the Review has been approved";
    $message = "Your Report on the Review has been ".$report->status->review_status. " By our team.";
    $type = "success";
    if ($obj["review_status_id"]==2)
    {
     $report->review()->update(["status"=>1]);
    }
    $t = 1;
    
    $candid = User::findOrFail($report->candidate_id);
    $name = $candid->name;
    if ($obj["review_status_id"]==3)
    {
        $mail->subject = "Your Report on the Review has been declined";
        $mail->reason = $request->reject_comments;
       
        // dd($report->review());
        if (!empty($request->reject_comments))
        {
            $message .= "<br><b>Reason:</b><p>{{$request->reject_comments}}</p>";
        }
$t=2;
        $type = "danger";

    }
    $mail->type=$t;
    $mail->name=$name;
    Notification::create(["to_user_id"=>$report->candidate_id,"type"=>$type,"url"=>url('/search-talent/seeker/'.$report->candidate_id),"notification"=>$message,"created_by"=>auth()->user()->id]);

    $candid->notify(new ReportReviewNotification($mail));                                                                                                          
    return response()->json(["val"=>1]);
}

}
