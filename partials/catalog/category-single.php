<!--CATALOG / CATEGORY SINGLE-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Catégories</h5>
    <h1 class="main-title">Modifier: <span class="green">{{category.name}}</span></h1>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="alert alert-success" ng-if="resUpdateCategory">
            {{resUpdateCategory}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-chevron-down panel-icon" aria-hidden="true"></span> 
            Modifier une catégorie
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" ng-model="category.name" required>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea row="5" id="edition" class="form-control" ng-model="category.description"></textarea>
            </div>
            <div class="form-group">
                <label for="reference">Url</label>
                <input type="text" class="form-control" id="reference" ng-model="category.url">
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-danger" ng-click="CancelConfirm('category')">Annuler</button>
            <button type="button" class="btn btn-default" ng-click="updateCategory()"><span class="glyphicon glyphicon-floppy-disk"></span>Enregistrer</button>
        </div>
    </div>
</div>
