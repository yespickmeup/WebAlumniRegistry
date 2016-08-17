<div class="row col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">

                <input type="button" class="btn btn-default pull-right" value="New" ng-click="ShowHide()"/>
                <br>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Activity" name="inputInvolvement"
                           id="inputInvolvement"
                           ng-model="activity.activity">
                   <span class="input-group-btn">
                    <button ng-show="showActivityAdd" class="btn btn-primary" type="button" ng-click="addActivity()">
                        Add
                    </button>
                    <button ng-show="showActivityUpdate" class="btn btn-primary" type="button" ng-click="updateActivity()">
                        Update
                    </button>
                   </span>
                </div>
            </div>
        </div>
        <table st-table="displayedCollection" st-safe-src="activities"
               class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th st-sort="activity.activity">Involvement</th>
                <th style="width:30px;"></th>
                <th style="width:30px;"></th>
            </tr>
            {{--  <tr>
                <th colspan="7"><input st-search="" class="form-control" placeholder="search ..." type="text"/></th>
              </tr>--}}
            </thead>
            <tbody>
            <tr ng-repeat="activity in displayedCollection">
                <td><%activity.activity%></td>
                <td>
                    <button type="button" class="btn btn-sm btn-default "
                            ng-click="editInvolvement(activity)">
                        <i class="glyphicon glyphicon-edit">
                        </i>

                    </button>
                </td>
                <td>
                    <button type="button" ng-click="removeInvolvement(activity)" class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-remove-circle">
                        </i>
                    </button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-center">
                    <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="7"></div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


    <div class="modal fade bs-example-modal-sm" id="myActivityModal" name="myActivityModal" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel" ng-model="editModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Activity</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="activityName">Enter Activity</label>

                        <div><input type="text" class="form-control" id="editactivityName" name="editactivityName"
                                    ng-model="activity.editactivityName"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancelEditActivity()">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" ng-click="updateActivity(activity.editactivityName)">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


     
   

