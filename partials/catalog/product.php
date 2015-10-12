<!--CATALOG / PRODUCT-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Produits</h5>
    <h1 class="main-title">Produits</h1>
</div>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-search panel-icon" aria-hidden="true"></span> 
            Gérez vos produits
            <span class="badge">{{products.length}}</span>
            <div class="admin-option-btn">
                <a href="#catalog/edit/add-product" data-toggle="tooltip" data-placement="top" title="Ajouter un produit"><i class="glyphicon glyphicon-plus-sign"></i></a>
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir la liste"><i class="glyphicon glyphicon-refresh" ng-click="getAllProduct()"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="search-group">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" placeholder="Chercher un produit" ng-model="searchProduct"/>
            </div>
            <table class="table striped admin-table">
                <thead>
                    <th class="center">ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Prix de base</th>
                    <th>Prix final</th>
                    <th>Quantité</th>
                    <th class="center">état</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="product in products | orderBy:'-id_product' | filter: searchProduct">
                        <td class="center">{{product.id_product}}</td>
                        <td>
                            <div ng-if="product.path_img" class="tab-img" style="background:url('{{product.path_img}}');background-size:cover;background-position:center;"></div>
                            <div ng-if="!product.path_img" class="tab-img" style="background-color:#989898;line-height:50px;text-align:center;color:white;"><span class="glyphicon glyphicon-camera"></span></div>
                        </td>
                        <td>{{product.name}}</td>
                        <td>{{product.reference}}</td>
                        <td>{{product.id_category}}</td>
                        <td>{{product.price_ht}}€</td>
                        <td>{{product.price_ttc}}€</td>
                        <td>{{product.quantity}}</td>
                        <td class="center product-state available" ng-if="product.id_status <= 1"><i class="glyphicon glyphicon-ok"></i></td>
                        <td class="center product-state unavailable" ng-if="product.id_status >= 2"><i class="glyphicon glyphicon-remove"></i></td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="#catalog/product/{{product.url}}" type="button" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dupliquer</a></li>
                                    <li><a href="" ng-click="deleteProduct(product.id_product)">Supprimer</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>                                     
                </tbody>
            </table>
            <div class="alert alert-success" ng-show="loading">Loading...</div>
        </div>
    </div>
</div>