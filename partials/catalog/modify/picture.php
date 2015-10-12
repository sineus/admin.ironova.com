<!--CATALOG / MODIFY / PICTURES-->
<div class="form-group">
    <label for="picture">Ajouter une nouvelle image pour ce produit</label>
    <button class="btn btn-default" ngf-select="uploadFiles($files, 'process/upload/upload.php', product.id_product, product.url)" multiple accept="image/*">
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
<div class="form-group">
    <table class="table striped admin-table">
        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Chemin du fichier</th>
            <th></th>
        </thead>
        <tbody>
            <tr ng-repeat="picture in picturesProduct track by $index">
                <td>
                    <div class="tab-img" style="background:url('{{picture.path_img}}');background-size:cover;background-position:center;"></div>
                </td>
                <td>
                    {{picture.img_name}}
                </td>
                <td>
                    {{picture.path_img}}
                </td>
                <td class="right">
                    <button type="button" class="btn btn-danger" ng-click="removeImg(picture.id, product.id_product)"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                </td>
            </tr>                                     
        </tbody>
    </table>
    <div class="alert alert-success" ng-show="loading">Loading...</div>
</div>
<div class="form-group">
    <label>Image de couverture</label>
    <select class="form-control" ng-model="product.id_cover">
        <option ng-repeat="picture in picturesProduct track by $index" value="{{picture.id}}">{{picture.img_name}}</option>
    </select>
</div>