<!--PREFERENCE / ENVOIMOINSCHER-->
<div class="col-sm-12">
    <h5 class="sub-title">Préférences / EnvoiMoinsCher API</h5>
    <h1 class="main-title">EnvoiMoinsCher API</h1>
</div>
<div class="col-sm-12">
	<div class="alert alert-success" ng-if="addApiInfoRes">
		{{addApiInfoRes}}
	</div>
	<div class="alert alert-danger" ng-if="addApiResError">
		{{addApiResError}}
	</div>
</div>
<div class="col-sm-3">
    <div class="row admin-block edit">
        <ul class="nav-edit">
            <li ng-repeat="template in templatesEnvoimoinscher">
                <a href="" ng-class="{current:isActiveEnvoimoinscher(template)}" ng-click="selectEnvoimoinscherTemplate(template)">{{template.name}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> 
            {{envoimoinscherName}}
        </div>
        <div class="panel-body" ng-include="envoimoinscherTemplate">
            <!--NG INCLUDE-->
        </div>
        <div class="panel-footer">
                <button type="button" class="btn btn-danger" ng-click="CancelConfirm('product')">Annuler</button>
                <button type="button" class="btn btn-default" ng-click="addApiInfo()"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer</button>
         </div>
    </div>
</div>