<!--CATALOG / ADD / PICTURES-->
<div class="form-group">
    <label for="picture">Ajouter une nouvelle image pour ce produit</label>
    <button class="btn btn-default" ngf-select="uploadFiles($files, 'process/upload/upload.php', newProduct.url)" multiple accept="image/*">
        <span class="glyphicon glyphicon-folder-open"></span>
        Ajouter des fichiers
    </button>

    <div class="file-list" ng-if="files">
        <div class="form-group" ng-repeat="f in files">
            <span class="glyphicon glyphicon-picture"></span>
            <span class="file-name">{{f.name}}</span>  ({{f.size | bytes}}) {{f.$error}} {{f.$errorParam}}
            <button type="button" class="btn btn-success" ng-if="fileRes"><span class="glyphicon glyphicon-ok"></span> Fichier copié</button>
        </div>
    </div>
</div>