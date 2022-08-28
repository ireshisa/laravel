<?php

namespace App\Models;

use App\Models\ReviewStatus;
use Illuminate\Database\Eloquent\Model;
use Larapen\Admin\app\Models\Crud;

class ReportReview extends Model
{
    use Crud;

    protected $table = "review_reports";
    protected $fillable = ["comments", "candidate_id", "review_id", "review_status_id", "reject_comments"];

    public function status()
    {
        return $this->belongsTo(ReviewStatus::class, 'review_status_id');
    }

    public function candidate_id()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }


    public function approveBtn()
    {
        $this->load('status');
        $txt = "";
        $review = $this->status;
        if ($review->id == 1)
        {
            $txt = '<a class="btn btn-xs btn-success action-review" data-type="approve" data-id="' . $this->id . '" ><i class="fa fa-btn fa-check"></i>Approve</a>';

        }
        return $txt;
    }

    public function rejectBtn()
    {
        $this->load('status');
        $txt = "";
        $review = $this->status;
        if ($review->id == 1) {
            $txt = '<a class="btn btn-xs btn-danger action-review" data-type="reject" data-id="' . $this->id . '" ><i class="fa fa-btn fa-check"></i>Reject</a>';
        }
        return $txt;
    }

    public function get_review_status()
    {
        $this->load('status');
        $txt = "";
        $review = $this->status;
        if ($review->id == 1)
        {
            $txt = "<span class='badge ' style='padding: 5px 8px;'>".$review->review_status."</span>";
        }
        else if ($review->id == 2)
        {
            $txt = "<span class='badge badge-success' style='background-color:green;padding: 5px 8px'>".$review->review_status."</span>";
        }
        else if ($review->id == 3)
        {
            $txt = "<span class='badge bg-danger' style='background-color: red; padding: 5px 8px'>".$review->review_status."</span>";
        }
        return $txt;
//       return "<span class='badge badge-primary p-2'>$this->status->review_status</span>";
    }



}
