<!--CATALOG / PRODUCT ADD-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Produits</h5>
    <h1 class="main-title">Ajouter</h1>
</div>
<div class="col-sm-3">
    <div class="row admin-block edit">
        <ul class="nav-edit">
            <li ng-repeat="template in templatesAddProduct">
                <a href="" ng-class="{current:isActiveAdd(template)}" ng-click="selectAddTemplate(template)">{{template.name}}</a>
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
        <div class="panel-body" ng-include="addTemplate">
            <!--NG INCLUDE-->
        </div>
        <div class="panel-footer">
                <button type="button" class="btn btn-danger" ng-click="CancelConfirm('product')">Annuler</button>
                <button type="button" class="btn btn-default" ng-click="addProduct()"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer</button>
         </div>
    </div>
</div>
