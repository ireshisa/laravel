<div class="modal fade" id="register-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="icon-mail-2"></i> Please Register/Login to Get Connected
                </h4>

                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{{ t('Close') }}</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-danger text-center">You must Login to Send the Connect Request to the Employer.</h4>
                <div class="btn-container">
                    <a class="btn btn-add-listing text-white float-left btn-post" href="{{url('/login')}}">
                       Login
                    </a>
                    <a class="btn btn-add-listing text-white float-right  btn-post" href="{{url('/register')}}">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('after_styles')
    <style>
        .btn-container {
            width: 100%;
            max-width: 190px;
            display: block;
            margin: auto;
        }
        /*@media screen and (max-width: 200px) {*/
        /*    .btn-container {*/
        /*       width: 100%;*/
        /*        max-width: 200px;*/
        /*        display: block;*/
        /*        margin: auto;*/
        /*    }*/
        /*}*/
    </style>
    @endsection

@section('after_scripts')
    <script>

        $(document).ready(function () {
            $(".not-register").on('click',function () {
                $("#register-modal").modal("show");
            })
        })
    </script>

    @endsection