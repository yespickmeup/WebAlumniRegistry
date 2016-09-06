
{{-- Alert for Level --}}
<div class="alert alert-success fade in" ng-show="showAddLevelSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Added!</strong>
</div>
<div class="alert alert-success fade in" ng-show="showUpdateLevelSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Updated!</strong>
</div>
<div class="alert alert-warning fade in" ng-show="showDeleteLevelSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Deleted!</strong>
</div>


{{-- Alert for Year --}}
<div class="alert alert-success fade in" ng-show="showAddYearSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Added!</strong>
</div>
<div class="alert alert-success fade in" ng-show="showUpdateYearSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Updated!</strong>
</div>
<div class="alert alert-warning fade in" ng-show="showDeleteYearSuccess">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Deleted!</strong>
</div>


<div class="panel panel-default col-md-6" >
    <form name="myForm">
        <br>
        <div class="panel-body">
            <div class="row ">
                <div class="col-md-6"><h2>Level</h2></div>
                <div class="col-md-6">
                    <button class="btn btn-default pull-right " type="button"
                            ng-click="newLevel()" style="margin-top: 20px;">
                        New
                    </button>
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Level" name="inputLevel"
                       id="inputLevel"
                       ng-model="inputLevel"
                       ng-keydown="($event.which === 13) && addLevel(myForm)"
                       ng-minlength="1"
                       ng-maxlength="1000"
                       required
                >
                   <span class="input-group-btn">
                           <button ng-show="showLevelAdd" class="btn btn-primary" type="button"
                                   ng-click="addLevel(myForm)">
                               Add
                           </button>
                           <button ng-show="showLevelUpdate" class="btn btn-primary" type="button"
                                   ng-click="updateLevel()">
                               Update
                           </button>
                   </span>
            </div>

            <div ng-messages=" myForm.inputLevel.$error " style="color:maroon" role="alert"
                 ng-show="myForm.inputLevel.$touched">
                <div ng-message="required">You did not enter a field</div>
                <div ng-message="minlength">Your field is too short</div>
                <div ng-message="maxlength">Your field is too long</div>
            </div>

            <br>
            <table st-table="displayedCollection2" st-safe-src="levels"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                            type="text"/></th>
                </tr>
                <tr>
                    <th st-sort="level.level">Level</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="level in displayedCollection2">
                    <td><%level.level%></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-default "
                                ng-click="editLevel(level)">
                            <i class="glyphicon glyphicon-edit">
                            </i>

                        </button>
                    </td>
                    <td>
                        <a href="" type="button" ng-click="confirmDeleteLevel(level)"
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


<div class="panel panel-default col-md-6">
    <form name="myFormYear">
        <br>

        <div class="panel-body">
            <div class="row ">
                <div class="col-md-6"><h2>Year</h2></div>
                <div class="col-md-6">
                    <button class="btn btn-default pull-right " type="button"
                            ng-click="newYear()" style="margin-top: 20px;">
                        New
                    </button>
                </div>
            </div>

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Year" name="inputYear"
                       id="inputYear"
                       ng-model="inputYear"
                       ng-keydown="($event.which === 13 ) && addYear(myFormYear)"
                       ng-minlength="1"
                       ng-maxlength="1000"
                       required
                >
                   <span class="input-group-btn">
                           <button ng-show="showYearAdd" class="btn btn-primary" type="button"
                                   ng-click="addYear(myFormYear)">
                               Add
                           </button>
                           <button ng-show="showYearUpdate" class="btn btn-primary" type="button"
                                   ng-click="updateYear()">
                               Update
                           </button>
                   </span>
            </div>

            <div ng-messages=" myFormYear.inputYear.$error " style="color:maroon" role="alert"
                 ng-show="myFormYear.inputYear.$touched">
                <div ng-message="required">You did not enter a field</div>
                <div ng-message="minlength">Your field is too short</div>
                <div ng-message="maxlength">Your field is too long</div>
            </div>

            <br>

            <table st-table="displayedCollection" st-safe-src="years"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                            type="text"/></th>
                </tr>
                <tr>
                    <th st-sort="year.year">Year</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="year in displayedCollection">
                    <td><%year.year%></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-default "
                                ng-click="editYear(year)">
                            <i class="glyphicon glyphicon-edit">
                            </i>

                        </button>
                    </td>
                    <td>
                        <a href="" type="button" ng-click="confirmDeleteYear(year)"
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
                        <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="7"></div>
                    </td>
                </tr>
                </tfoot>
            </table>
            <script>
                var myToken = '{{ Session::token() }}';
            </script>
        </div>


        <script type="text/ng-template" id="modalYear.html">
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


</hr>



