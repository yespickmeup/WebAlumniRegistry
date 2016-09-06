
{{-- Alert for Year --}}
<div class="alert alert-success fade in" ng-show="showAddMajorSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Added!</strong>
</div>
<div class="alert alert-success fade in" ng-show="showUpdateMajorSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Updated!</strong>
</div>
<div class="alert alert-warning fade in" ng-show="showDeleteMajorSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Deleted!</strong>
</div>


<div class="panel panel-default col-md-12" >
    <form name="myFormMajor">
        <br>
        <div class="panel-body">
            <div class="row ">
                <div class="col-md-6"><h2>Majors</h2></div>
                <div class="col-md-6">
                    <button class="btn btn-default pull-right " type="button"
                            ng-click="newMajor()" style="margin-top: 20px;">
                        New
                    </button>
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Input Major" name="inputMajor"
                       id="inputMajor"
                       ng-model="inputMajor"
                       ng-keydown="($event.which === 13) && addMajor(myFormMajor)"
                       ng-minlength="1"
                       ng-maxlength="1000"
                       required
                >
                   <span class="input-group-btn">
                           <button ng-show="showMajorAdd" class="btn btn-primary" type="button"
                                   ng-click="addMajor(myFormMajor)">
                               Add
                           </button>
                           <button ng-show="showMajorUpdate" class="btn btn-primary" type="button"
                                   ng-click="updateMajor()">
                               Update
                           </button>
                   </span>
            </div>

            <div ng-messages=" myFormMajor.inputMajor.$error " style="color:maroon" role="alert"
                 ng-show="myFormMajor.inputMajor.$touched">
                <div ng-message="required">You did not enter a field</div>
                <div ng-message="minlength">Your field is too short</div>
                <div ng-message="maxlength">Your field is too long</div>
            </div>

            <br>
            <table st-table="displayedMajorCollection" st-safe-src="majors"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                            type="text"/></th>
                </tr>
                <tr>
                    <th st-sort="major.major">Major</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="major in displayedMajorCollection">
                    <td><%major.major%></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-default "
                                ng-click="editMajor(major)">
                            <i class="glyphicon glyphicon-edit">
                            </i>

                        </button>
                    </td>
                    <td>
                        <a href="" type="button" ng-click="confirmDeleteMajor(major)"
                           class="btn btn-sm btn-danger">
                            <i class="glyphicon glyphicon-remove-sign">
                            </i>
                        </a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" class="text-center">
                        <div st-pagination="" st-items-by-page="itemsByPage2" st-displayed-pages="7"></div>
                    </td>
                </tr>
                </tfoot>
            </table>

        </div>

        <script type="text/ng-template" id="modal.html">
            <div class="modal ">
                <div class="modal-dialog modal-sm type-danger">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="close('Cancel')" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Confirm Delete!</h4>
                        </div>

                        <div class="modal-footer">
                            <button type="button" ng-click="close('No')" class="btn btn-default" data-dismiss="modal">
                                No
                            </button>
                            <button type="button" ng-click="close('Yes')" class="btn btn-primary" data-dismiss="modal">
                                Yes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </script>


    </form>

</div>