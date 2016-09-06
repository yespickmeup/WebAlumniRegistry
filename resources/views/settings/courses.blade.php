
{{-- Alert for Year --}}
<div class="alert alert-success fade in" ng-show="showAddCourseSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Added!</strong>
</div>
<div class="alert alert-success fade in" ng-show="showUpdateCourseSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Updated!</strong>
</div>
<div class="alert alert-warning fade in" ng-show="showDeleteCourseSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Deleted!</strong>
</div>


<div class="panel panel-default col-md-12" >
    <form name="myFormCourse">
        <br>
        <div class="panel-body">
            <div class="row ">
                <div class="col-md-6"><h2>Courses</h2></div>
                <div class="col-md-6">
                    <button class="btn btn-default pull-right " type="button"
                            ng-click="newCourse()" style="margin-top: 20px;">
                        New
                    </button>
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Input Course" name="inputCourse"
                       id="inputCourse"
                       ng-model="inputCourse"
                       ng-keydown="($event.which === 13) && addCourse(myFormCourse)"
                       ng-minlength="1"
                       ng-maxlength="1000"
                       required
                >
                   <span class="input-group-btn">
                           <button ng-show="showCourseAdd" class="btn btn-primary" type="button"
                                   ng-click="addCourse(myFormCourse)">
                               Add
                           </button>
                           <button ng-show="showCourseUpdate" class="btn btn-primary" type="button"
                                   ng-click="updateCourse()">
                               Update
                           </button>
                   </span>
            </div>

            <div ng-messages=" myFormCourse.inputCourse.$error " style="color:maroon" role="alert"
                 ng-show="myFormCourse.inputCourse.$touched">
                <div ng-message="required">You did not enter a field</div>
                <div ng-message="minlength">Your field is too short</div>
                <div ng-message="maxlength">Your field is too long</div>
            </div>

            <br>
            <table st-table="displayedCourseCollection" st-safe-src="courses"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                            type="text"/></th>
                </tr>
                <tr>
                    <th st-sort="course.course">Course</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="course in displayedCourseCollection">
                    <td><%course.course%></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-default "
                                ng-click="editCourse(course)">
                            <i class="glyphicon glyphicon-edit">
                            </i>

                        </button>
                    </td>
                    <td>
                        <a href="" type="button" ng-click="confirmDeleteCourse(course)"
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