<!--CUSTOMER / CUSTOMER ADDRESS-->
<div class="col-sm-12">
    <h5 class="sub-title">Clients / Adresses</h5>
    <h1 class="main-title">Adresses</h1>
</div>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-home panel-icon" aria-hidden="true"></span> 
            Adresses 
            <span class="badge">{{customersAddress.length}}</span>
            <div class="admin-option-btn">
                <a href="#customer/edit/add-customer-address" data-toggle="tooltip" data-placement="top" title="Ajouter un adresse"><i class="glyphicon glyphicon-plus-sign"></i></a>
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir la liste"><i class="glyphicon glyphicon-refresh" ng-click="getAllCustomerAddress()"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="search-group">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" placeholder="Chercher une adresse" ng-model="searchCustomerAddress"/>
            </div>
            <table class="table striped admin-table">
                <thead>
                    <th class="center">ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Type</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="customerAddress in customersAddress | orderBy:'nom' | filter: searchCustomerAddress">
                        <td class="center">{{customerAddress.id_adresse}}</td>
                        <td>{{customerAddress.prenom}}</td>
                        <td>{{customerAddress.nom}}</td>
                        <td>{{customerAddress.adresse1}}</td>
                        <td>{{customerAddress.cp}}</td>
                        <td>{{customerAddress.ville}}</td>
                        <td>{{customerAddress.rid_pays}}</td>
                        <td ng-if="customerAddress.livr == 0" ><span class="status-box success">Défaut</span></td>
                        <td ng-if="customerAddress.livr == 1"><span class="status-box wait">Livraison</span></td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="" type="button" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="" ng-click="">Supprimer</a></li>
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
