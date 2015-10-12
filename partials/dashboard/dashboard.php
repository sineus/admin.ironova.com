<!--DASHBOARD / DASHBOARD-->
<div class="col-sm-12">
    <h5 class="sub-title">Tableau de bord</h5>
    <h1 class="main-title">Tableau de bord</h1>
</div>
<div class="col-sm-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-shopping-cart panel-icon" aria-hidden="true"></span> 
            Aperçu de l'activité
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div class="list-group">
            <a href="#" class="list-group-item">
                <span class="badge">14</span>
                <h5 class="list-group-item-heading">Visiteurs en ligne</h5>
                <p class="list-group-item-text">Dans les 30 dernières minutes</p>
            </a>
            <a href="#" class="list-group-item">
                <span class="badge">78</span>
                <h5 class="list-group-item-heading">Paniers actifs</h5>
                <p class="list-group-item-text">Dans les 30 dernières minutes</p>
            </a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-time panel-icon" aria-hidden="true"></span> 
            Actuellement en attente
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">14</span>
                Commandes
            </li>
            <li class="list-group-item">
                <span class="badge">14</span>
                Retours / Échanges
            </li>
            <li class="list-group-item">
                <span class="badge">14</span>
                Paniers abandonnés
            </li>
            <li class="list-group-item">
                <span class="badge">14</span>
                Produits en rupture de stock
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-check panel-icon" aria-hidden="true"></span> 
            Notifications
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">42</span>
                Nouveaux messages
            </li>
            <li class="list-group-item">
                <span class="badge">156</span>
                Revues de produits
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user panel-icon" aria-hidden="true"></span> 
            Clients & newsletters
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">42</span>
                Nouveaux clients
            </li>
            <li class="list-group-item">
                <span class="badge">156</span>
                Nouveaux abonnements
            </li>
            <li class="list-group-item">
                <span class="badge">156</span>
                Total des abonnés
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-random panel-icon" aria-hidden="true"></span> 
            Trafic
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">42</span>
                Visites
            </li>
            <li class="list-group-item">
                <span class="badge">156</span>
                Visiteurs uniques
            </li>
        </ul>
    </div>
</div>
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-signal panel-icon" aria-hidden="true"></span> 
            Trafic
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div class="panel-body panel-tabs">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li role="presentation" class="active"><a data-target="#home" aria-controls="home" role="tab" data-toggle="tab">Ventes</a></li>
                <li role="presentation"><a data-target="#profile" aria-controls="profile" role="tab" data-toggle="tab">Commandes</a></li>
                <li role="presentation"><a data-target="#messages" aria-controls="messages" role="tab" data-toggle="tab">Visites</a></li>
                <li role="presentation"><a data-target="#settings" aria-controls="settings" role="tab" data-toggle="tab">Bénéfices net</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home"> 
                    <canvas id="line" class="chart chart-line" chart-data="data"
                        chart-labels="labels" chart-legend="true" chart-series="series"
                        chart-click="onClick">
                    </canvas>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <canvas id="line" class="chart chart-line" chart-data="data"
                        chart-labels="labels" chart-legend="true" chart-series="series"
                        chart-click="onClick">
                    </canvas>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <canvas id="line" class="chart chart-line" chart-data="data"
                        chart-labels="labels" chart-legend="true" chart-series="series"
                        chart-click="onClick">
                    </canvas>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <canvas id="line" class="chart chart-line" chart-data="data"
                        chart-labels="labels" chart-legend="true" chart-series="series"
                        chart-click="onClick">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-signal panel-icon" aria-hidden="true"></span> 
            Produits & ventes
            <div class="admin-option-btn">
                <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table striped admin-table">
                <thead>
                    <th>Nom du client</th>
                    <th>Produits</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Kubler David</td>
                        <td>2</td>
                        <td>249.69€</td>
                        <td>15/09/2015</td>
                        <td><button class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Détails</button></td>
                    </tr>                                     
                </tbody>
            </table>
        </div>
    </div>
</div>

