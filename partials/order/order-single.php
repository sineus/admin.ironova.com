<!--ORDER / ORDER SINGLE-->
<div class="col-sm-12">
    <h5 class="sub-title">Commandes / Commandes</h5>
    <h1 class="main-title">Commandes <span class="green">#{{order.id_commande}}</span></h1>
</div>
<!-- <div class="col-sm-12">
    <div class="alert alert-success" ng-if="resUpdateProduct">
        {{resUpdateProduct}}
    </div>
</div> -->
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-file" aria-hidden="true"></span> 
            Commande
            <span class="badge">{{order.id_commande}}</span>
        </div>
        <div class="panel-body panel-tabs">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li role="presentation" class="active"><a data-target="#status" aria-controls="status" role="tab" data-toggle="tab">État</a></li>
                <li role="presentation"><a data-target="#file" aria-controls="file" role="tab" data-toggle="tab">Documents</a></li>
                <li role="presentation"><a data-target="#delivery" aria-controls="delivery" role="tab" data-toggle="tab">Livraison</a></li>
                <li role="presentation"><a data-target="#product-return" aria-controls="product-return" role="tab" data-toggle="tab">Retours produits</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="status"> 
                    <div class="form-group">
                        <b>Statut actuel</b>
                    </div>
                    <div class="form-group">
                        <span class="label label-primary" ng-if="order.paiement == 0">En attente de paiement</span>
                        <span class="label label-success" ng-if="order.paiement == 1">Paiement validé</span>
                        <span class="label label-danger" ng-if="order.paiement == 2">Paiement abandonné</span>
                        <span class="label label-warning" ng-if="order.paiement == 3">Préparation de la commande</span>
                        <span class="label label-success" ng-if="order.paiement == 4">Commande envoyé</span>
                    </div> 
                </div>
                <div role="tabpanel" class="tab-pane" id="file">

                </div>
                <div role="tabpanel" class="tab-pane" id="delivery">
                    <table class="table striped admin-table">
                        <thead>
                            <th>Date</th>
                            <th>Transporteur</th>
                            <th>Poids</th>
                            <th>Frais d'expédition</th>
                            <th>Numéro de suivi</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{order.date_env}}</td>
                                <td>{{order.rid_carrier}}</td>
                                <td>{{order.poids}}</td>
                                <td>{{order.frais_port}}</td>
                                <td>{{order.num_suivi}}</td>
                                <td>
                                    <button class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>  Modifier</button>
                                </td>
                            </tr>                                     
                        </tbody>
                    </table>
                    <div class="alert alert-success" ng-show="loading">Loading...</div>
                </div>
                <div role="tabpanel" class="tab-pane" id="product-return">

                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span> 
            Paiement
            <span class="badge">{{order.id_commande}}</span>
        </div>
        <div class="panel-body">
            <table class="table striped admin-table">
                <thead>
                    <th>Date</th>
                    <th>Méthode paiement</th>
                    <th>ID de la transaction</th>
                    <th>Montant</th>
                    <th>Facture</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{order.date_paie}}</td>
                        <td>{{order.type_paiement}}</td>
                        <td>{{order.transaction}}</td>
                        <td>{{order.total}}</td>
                        <td>Null</td>
                    </tr>                                     
                </tbody>
            </table>
            <div class="alert alert-warning" ng-if="!paymentStatus">Aucun paiement effectué</div>
            <div class="alert alert-success" ng-show="loading">Loading...</div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
            Client
            <span class="badge">{{order.civilite_fact}} {{order.nom_fact}} {{order.prenom_fact}}</span>
            <span class="badge">{{order.rid_client}}</span>
        </div>
        <div class="panel-body panel-tabs">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li role="presentation" class="active"><a data-target="#info" aria-controls="info" role="tab" data-toggle="tab">Informations</a></li>
                <li role="presentation"><a data-target="#address" aria-controls="address" role="tab" data-toggle="tab">Adresse</a></li>
                <li role="presentation"><a data-target="#note" aria-controls="note" role="tab" data-toggle="tab">Commentaire</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="info"> 
                    <div class="info-list">
                        <label>Email</label>
                        <a href="mailto:{{order.email_fact}}">{{order.email_fact}}</a>
                    </div>
                    <div class="info-list">
                        <label>Compte créé</label>
                        <p>{{order.date_com}}</p>
                    </div>
                    <div class="info-list">
                        <label>Commandes validées</label>
                        <p><span class="badge">{{order.rid_client}}</span></p>
                    </div>
                    <div class="info-list">
                        <label>Total payé depuis la création du compte</label>
                        <p><span class="badge">{{order.rid_client}}€</span></p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="address">
                    <div class="row">
                        <div class="col-sm-6 map-container">
                            <map center="-34.397, 150.644" zoom="8"></map>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li><b>Adresse de facturation</b></li>
                                <li>{{order.nom_fact}} {{prenom_fact}}</li>
                                <li>{{order.adresse1_fact}}</li>
                                <li>{{order.cp_fact}} {{order.ville_fact}}</li>
                                <li>{{order.pays_fact}}</li>
                                <li>{{order.tel_fact}}</li>
                                <li>{{order.portable_fact}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 map-container">
                            <map center="-34.397, 150.644" zoom="8"></map>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li><b>Adresse de livraison</b></li>
                                <li>{{order.nom_livr}} {{prenom_livr}}</li>
                                <li>{{order.adresse1_livr}}</li>
                                <li>{{order.cp_livr}} {{order.ville_livr}}</li>
                                <li>{{order.pays_livr}}</li>
                                <li>{{order.tel_livr}}</li>
                                <li>{{order.portable_livr}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="note">
                    <p>Vous pouvez écrire un commentaire sur le client</p>
                    <div class="form-group">
                        <textarea></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span>  Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
            Produits
            <span class="badge">{{items.length}}</span>
        </div>
        <div class="panel-body">
            <table class="table striped admin-table">
                <thead>
                    <th></th>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Quantités disponibles</th>
                    <th>Total</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in items">
                        <td>
                            <img src="{{item.path_img}}" alt="{{item.nom_produit"/>
                        </td>
                        <td>
                            {{item.nom_produit}}
                            {{item.edition}}
                        </td>
                        <td>
                            {{item.prix_ex}}
                        </td>
                        <td>
                            {{item.qte}}
                        </td>
                        <td>
                            {{item.quantity}}
                        </td>
                        <td>
                            {{item.prix}}
                        </td>
                        <td class="right">
                            <div class="btn-group">
                                <a href="" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Supprimer</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>Produits</b>
                        </td>
                        <td>
                            {{order.total}}€
                        </td>
                    </tr>  
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>Livraison</b>
                        </td>
                        <td>
                            00,00€
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>Total</b>
                        </td>
                        <td>
                            <b>{{order.total}}€</b>
                        </td>
                    </tr>                                   
                </tbody>
            </table>
            <div class="alert alert-success" ng-show="loading">Loading...</div>
        </div>
    </div>
</div>
