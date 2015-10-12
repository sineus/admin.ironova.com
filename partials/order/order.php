<!--ORDER / ORDER-->
<div class="col-sm-12">
    <h5 class="sub-title">Commandes / Commandes</h5>
    <h1 class="main-title">Commandes</h1>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="alert alert-success alert-dismissible" ng-if="resDeleteOrder">
            {{resDeleteOrder}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user panel-icon" aria-hidden="true"></span> 
            Gérez vos commandes 
            <span class="badge">{{orders.length}}</span>
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir la liste" ng-click="getAllCategory()"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="search-group">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" placeholder="Chercher une commande" ng-model="searchOrder"/>
            </div>
            <table class="table striped admin-table">
                <thead>
                    <th class="center">ID</th>
                    <th>Référence</th>
                    <th>Livraison</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Paiement</th>
                    <th>État</th>
                    <th>Date</th>
                    <th>PDF</th>
                </thead>
                <tbody>
                    <tr ng-repeat="order in orders | orderBy:'-date_com' | filter: searchOrder">
                        <td class="center">{{order.id_commande}}</td>
                        <td>{{order.ref}}</td>
                        <td>{{order.pays_livr}}</td>
                        <td>{{order.nom_fact}} {{order.prenom_fact}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.type_paiement}}</td>
                        <td ng-if="order.paiement == 0"><span class="label label-primary">En attente de paiement</span></td>
                        <td ng-if="order.paiement == 1"><span class="label label-success">Paiement validé</span></td>
                        <td ng-if="order.paiement == 2"><span class="label label-danger">Paiement abandonné</span></td>
                        <td ng-if="order.paiement == 3"><span class="label label-warning">Préparation de la commande</span></td>
                        <td ng-if="order.paiement == 4"><span class="label label-success">Commande envoyé</span></td>
                        <td>{{order.date_com}}</td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="#order/order/{{order.id_commande}}" class="btn btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Afficher</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Imprimer</a></li>
                                    <li><a href="" ng-click="deleteOrder(order.id_commande)">Supprimer</a></li>
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