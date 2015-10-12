<!--CATALOG / MODIFY / INFORMATIONS-->
<div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" ng-model="product.name">
</div>
<div class="form-group">
    <label for="name">Edition</label>
    <input type="text" class="form-control" id="edition" ng-model="product.edition">
</div>
<div class="form-group">
    <label>Visibilité</label>
    <select class="form-control" ng-model="product.display">
        <option value="2">Oui</option>
        <option value="1">Non</option>
    </select>
</div>
<div class="form-group">
    <label>Status</label>
    <select class="form-control" ng-model="product.id_status">
        <option value="1">Produit en stock</option>
        <option value="2">Produit en cours de réassortiment</option>
        <option value="3">Produit en rupture de stock</option>
    </select>
</div>
<div class="form-group">
    <label for="reference">Référence</label>
    <input type="text" class="form-control" id="reference" ng-model="product.reference">
</div>
<div class="form-group">
    <label for="bar-code-ean">Code-barres EAN</label>
    <input type="text" class="form-control" id="bar-code-ean" ng-model="product.barcode_ean">
</div>
<div class="form-group">
    <label for="bar-code-upc">Code-barres UPC</label>
    <input type="text" class="form-control" id="bar-code-upc" ng-model="product.barcode_upc">
</div>
<div class="form-group">
    <label for="bar-code-upc">Url du produit</label>
    <input type="text" class="form-control" id="url" ng-model="product.url">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <div text-angular ta-toolbar="[['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'pre', 'quote'],['bold', 'italics', 'underline', 'strikeThrough', 'ul', 'ol', 'redo', 'undo', 'clear'], ['justifyLeft', 'justifyCenter', 'justifyRight', 'indent', 'outdent'],['html', 'insertImage','insertLink', 'insertVideo']]" ng-model="product.description"></div>
</div>
<div class="form-group">
    <label for="description">Contenu de la boîte</label>
    <div text-angular ta-toolbar="[['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'pre', 'quote'],['bold', 'italics', 'underline', 'strikeThrough', 'ul', 'ol', 'redo', 'undo', 'clear'], ['justifyLeft', 'justifyCenter', 'justifyRight', 'indent', 'outdent'],['html', 'insertImage','insertLink', 'insertVideo']]" ng-model="product.content"></div>
</div>
<div class="form-group">
    <label for="description">Information supplémentaire</label>
    <div text-angular ta-toolbar="[['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'pre', 'quote'],['bold', 'italics', 'underline', 'strikeThrough', 'ul', 'ol', 'redo', 'undo', 'clear'], ['justifyLeft', 'justifyCenter', 'justifyRight', 'indent', 'outdent'],['html', 'insertImage','insertLink', 'insertVideo']]" ng-model="product.info"></div>
</div>