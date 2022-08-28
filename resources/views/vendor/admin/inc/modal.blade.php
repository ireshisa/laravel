<div class="modal" id="review-reject" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="review-reject-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required">Reason for Reject</label>
                            <textarea name="reason" class="form-control" style="min-height: 200px" minlength="10" maxlength="200" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var id = null;
        $("body").on('click','.action-review',function () {
            id = $(this).data('id');

            if ($(this).data('type')=="approve")
            {
                var fData= new FormData();
                fData.append('id',id);
                fData.append('review_status_id',2);

                submitForm("{{url('/')}}/admin/review-report",fData).then((res)=> {
                        if (res.val == 1)
                        {
                            $("#crudTable").DataTable().ajax.reload();
                            new PNotify({
                                title:"Item Updated",
                                type: "success",
                                text: 'Review Report Request is Approved and Notification sent to the Employee',
                            }).show();

                        }
                    },
                    (res) => {
                        new PNotify({
                            title: "Error",
                            type: "error",
                            text: 'There was an error while processing your request',
                        }).show();
                    })
            }
            else {
                $("#review-reject").modal("show");
            }
        });

        $("body").on('click','#review-reject-form button[name="submit"]',function () {

                var fData= new FormData();
                fData.append('id',id);
            fData.append('review_status_id',3);
                fData.append('reject_comments',$("textarea[name='reason']").val());
                submitForm("{{url('/')}}/admin/review-report",fData).then((res)=> {
                        if (res.val == 1)
                        {
                            $("#crudTable").DataTable().ajax.reload();
                            new PNotify({
                                title:"Item Updated",
                                type: "success",
                                text: 'Review Report Request is denied. A Notification sent to the Employee',
                            }).show();
                            $("#review-reject").modal("hide");

                        }
                    },
                    (res) => {
                        new PNotify({
                            title:"Error",
                            type: "error",
                            text: 'There was an error while processing your request',
                        }).show();
                    })
            });
    });
</script>