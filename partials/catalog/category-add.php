<!--CATALOG / CATEGORY ADD-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Catégories</h5>
    <h1 class="main-title">Ajouter</h1>
</div>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-chevron-down panel-icon" aria-hidden="true"></span> 
            Créer une catégorie
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" ng-model="newCategory.name" required>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" id="edition" ng-model="newCategory.description">
            </div>
            <div class="form-group">
                <label for="reference">Url</label>
                <input type="text" class="form-control" id="reference" ng-model="newCategory.url">
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-danger" ng-click="CancelConfirm('category')">Annuler</button>
            <button type="button" class="btn btn-default" ng-click="addCategory()"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer</button>
        </div>
    </div>
</div>
