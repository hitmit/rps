<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Search Student</h4>
</div>
<div class="modal-body" >
    <div class="row">
        <div class="col-sm-9">
            <input type="text" class="form-control" id="searchLink" placeholder="Type student name / username / E-mail address">
        </div>
        <div class="col-sm-2">
            <a type="button" onclick="REGISTER.linkStudentButton()" class="btn btn-danger btn-flat">Search</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12" style="padding-top:10px;">
            <div class="box-body table-responsive">
                <table class="table table-bordered">
                    <tbody class="search_results">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('/js/Angular/parent.js')}}"></script>

