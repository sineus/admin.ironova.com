<!--CUSTOMER / CUSTOMER-->
<div class="col-sm-12">
    <h5 class="sub-title">Clients / Clients</h5>
    <h1 class="main-title">Clients</h1>
</div>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user panel-icon" aria-hidden="true"></span> 
            Gérez vos clients 
            <span class="badge">{{customers.length}}</span>
            <div class="admin-option-btn">
                <a href="#customer/edit/add-customer" data-toggle="tooltip" data-placement="top" title="Ajouter un clients"><i class="glyphicon glyphicon-plus-sign"></i></a>
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir la liste"><i class="glyphicon glyphicon-refresh" ng-click="getAllCustomer()"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="search-group">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" placeholder="Chercher un client" ng-model="searchCustomer"/>
            </div>
            <table class="table striped admin-table">
                <thead>
                    <th class="center">ID</th>
                    <th>Titre</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Adresse e-mail</th>
                    <th>Pays</th>
                    <th>Inscription</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="customer in customers | orderBy:'-date_inscription' | filter: searchCustomer">
                        <td class="center">{{customer.id_client}}</td>
                        <td>{{customer.civilite}}</td>
                        <td>{{customer.prenom}}</td>
                        <td>{{customer.nom}}</td>
                        <td>{{customer.email}}</td>
                        <td>{{customer.country}}</td>
                        <td>{{customer.date_inscription}}</td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="" type="button" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Afficher</a></li>
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