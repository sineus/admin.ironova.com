<!--CATALOG / CATEGORY-->
<div class="col-sm-12">
    <h5 class="sub-title">Catalogue / Catégories</h5>
    <h1 class="main-title">Catégories</h1>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="alert alert-success alert-dismissible" ng-if="resDeleteCategory">
            {{resDeleteCategory}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible" ng-if="resAddCategory">
            {{resAddCategory}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-search panel-icon" aria-hidden="true"></span> 
            Gérez vos catégories 
            <span class="badge">{{categories.length}}</span>
            <div class="admin-option-btn">
                <a href="#catalog/edit/add-category" data-toggle="tooltip" data-placement="top" title="Ajouter une catégorie"><i class="glyphicon glyphicon-plus-sign"></i></a>
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir la liste"><i class="glyphicon glyphicon-refresh" ng-click="getAllCategory()"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="search-group">
                <i class="glyphicon glyphicon-search"></i>
                 <input type="text" class="form-control" placeholder="Chercher une catégorie" ng-model="searchCategory"/>
            </div>
            <table class="table striped admin-table">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="category in categories | orderBy:'-id' | filter: searchCategory">
                        <td>{{category.id}}</td>
                        <td>{{category.name}}</td>
                        <td>{{category.description}}</td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="#catalog/category/{{category.url}}" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="" ng-click="deleteCategory(category.id)">Supprimer</a></li>
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