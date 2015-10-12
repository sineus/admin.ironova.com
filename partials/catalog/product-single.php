<!--CATALOG / PRODUCT SINGLE-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Produits</h5>
    <h1 class="main-title">Modifier: <span class="green">{{product.name}}</span></h1>
</div>
<div class="col-sm-12">
    <div class="alert alert-success" ng-if="resUpdateProduct">
        {{resUpdateProduct}}
    </div>
</div>
<div class="col-sm-3">
    <div class="row admin-block edit">
        <ul class="nav-edit">
            <li ng-repeat="template in templatesModifyProduct">
                <a href="" ng-class="{current:isActiveModify(template)}" ng-click="selectModifyTemplate(template)">{{template.name}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> 
            {{modifyName}}
        </div>
        <div class="panel-body" ng-include="modifyTemplate">
            <!--NG INCLUDE-->
        </div>
        <div class="panel-footer">
                <button type="button" class="btn btn-danger" ng-click="CancelProduct()">Annuler</button>
                <button type="button" class="btn btn-default" ng-click="updateProduct(false)"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer et rester</button>
                <button type="button" class="btn btn-default" ng-click="updateProduct(true)"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer</button>
         </div>
    </div>
</div>
