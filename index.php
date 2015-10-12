<!--IRO ADMIN / MAIN-->
<html lang="en" ng-app="iroAdmin">
    <head>
        <head>
        <base href="/">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>IRO ADMIN</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="/img/favicon.png" />
        <meta itemprop="image" content="http://www.ironova.com/img/logo-black.svg"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/angular-chart.min.css">
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="fonts/font.css"/>
    </head>
    <body ng-controller="dashboard" ng-cloak>
        <!--LOADER-->
        
        <!--AUTHENTICATE CONTAINER-->
        <div>
            <!--TOOLBAR-->
            <div class="admin-toolbar">
                <div class="brand-logo">
                    <img src="img/logo-full-white.svg"/>
                </div>
                <nav>
                    <ul class="admin-notification">
                        <li class="dropdown">
                            <a href="" id="orderD" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-shopping-cart"></i> 
                                <span class="item-count" ng-show="newOrders">{{newOrders.length}}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="orderD">
                                <li class="dropdown-title">Dernières commandes</li>
                                <li class="dropdown-content">
                                    <p class="notif-empty" ng-if="!newOrders">Aucune nouvelle commande n'a été passée sur votre boutique</p>
                                    <ul ng-if="newOrders">
                                        <li ng-repeat="newOrder in newOrders">
                                            <p class="notif-name">Numéro de la commande #{{newOrder.id_commande}}</p>
                                            <p class="notif-name">De {{newOrder.nom_fact}} {{newOrder.prenom_fact}}</p>
                                            <p class="notif-date">Le {{newOrder.date_com}}</p>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#order/order" ng-click="notifOrder()">Voir toutes les commandes</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="" id="userD" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i> 
                                <span class="item-count" ng-show="newCustomers">{{newCustomers.length}}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="orderD">
                                <li class="dropdown-title">Dernières inscriptions</li>
                                <li class="dropdown-content">

                                    <p class="notif-empty" ng-if="!newCustomers">Aucun nouveau client inscrit sur votre boutique</p>
                                    <ul ng-if="newCustomers">
                                        <li ng-repeat="newCustomer in newCustomers">
                                            <p class="notif-name">Nom de client #{{newCustomer.nom}} {{newCustomer.prenom}}</p>
                                            <p class="notif-date">Le {{newCustomer.date_inscription}}</p>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#customer/customer" ng-click="notifCustomer()">Voir tous les clients</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="" id="messageD" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-inbox"></i> 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="orderD">
                                <li class="dropdown-title">Derniers messages</li>
                                <li class="dropdown-content">
                                    <p class="notif-empty" ng-if="!newMessages">Aucun nouveau message envoyé sur votre boutique</p>
                                </li>
                                <li><a href="#">Voir tous les messages</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="admin-account">
                        <li><a href="http://www.ironova.com/"><span class="glyphicon glyphicon-home"></span> Boutique</a></li>
                        <li><a href="">Hi, David</a></li>
                    </ul>
                </nav> 
            </div>
            <!--END-->
            <div class="main">
                <!--SIDEBAR-->
                <nav class="admin-sidebar" ng-controller="menu">
                    <ul>
                        <li>
                            <a href="#/" ng-class="{ active: isActive('/') }"><i class="glyphicon glyphicon-dashboard"></i> Tableau de bord</a>
                        </li>
                        <li>
                            <a href="#catalog/product" ng-class="{ active: isActive('/catalog/product') || isActive('/catalog/category') || isActive('/catalog/edit/add-product') || isActive('/catalog/edit/add-category') }"><i class="glyphicon glyphicon-book"></i> Catalogue</a>
                            <ul class="submenu" ng-class="{ open: isActive('/catalog/product') || isActive('/catalog/category') || isActive('/catalog/edit/add-product') || isActive('/catalog/edit/add-category') }">
                                <li><a href="#catalog/product" ng-class="{ submenuActive: isActive('/catalog/product') || isActive('/catalog/edit/add-product') }">Produits</a></li>
                                <li><a href="#catalog/category" ng-class="{ submenuActive: isActive('/catalog/category') || isActive('/catalog/edit/add-category') }">Catégories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#order/order" ng-click="notifOrder()" ng-class="{ active: isActive('/order/order') || isActive('/order/bill') || isActive('/order/product-return') || isActive('/order/delivery-order') || isActive('/order/discount') || isActive('/order/order-status') || isActive('/order/predefined-message') }"><i class="glyphicon glyphicon-barcode"></i> Commandes</a>
                            <ul class="submenu" ng-class="{ open: isActive('/order/order') || isActive('/order/bill') || isActive('/order/product-return') || isActive('/order/delivery-order') || isActive('/order/discount') || isActive('/order/order-status') || isActive('/order/predefined-message') }">
                                <li><a href="#order/order" ng-class="{ submenuActive: isActive('/order/order') }">Commandes</a></li>
                                <li><a href="#order/bill" ng-class="{ submenuActive: isActive('/order/bill') }">Factures</a></li>
                                <li><a href="#order/product-return" ng-class="{ submenuActive: isActive('/order/product-return') }">Retours produits</a></li>
                                <li><a href="#order/delivery-order" ng-class="{ submenuActive: isActive('/order/delivery-order') }">Bons de livraison</a></li>
                                <li><a href="#order/discount" ng-class="{ submenuActive: isActive('/order/discount') }">Avoirs</a></li>
                                <li><a href="#order/order-status" ng-class="{ submenuActive: isActive('/order/order-status') }">Statuts</a></li>
                                <li><a href="#order/predefined-message" ng-class="{ submenuActive: isActive('/order/predefined-message') }">Messages prédéfinis</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#customer/customer" ng-class="{ active: isActive('/customer/customer') || isActive('/customer/customer-address') || isActive('/customer/sav') }"><i class="glyphicon glyphicon-user"></i> Clients</a>
                            <ul class="submenu" ng-class="{ open: isActive('/customer/customer') || isActive('/customer/customer-address') || isActive('/customer/sav') }">
                                <li><a href="#customer/customer" ng-class="{ submenuActive: isActive('/customer/customer') }">Clients</a></li>
                                <li><a href="#customer/customer-address" ng-class="{ submenuActive: isActive('/customer/customer-address') }">Adresses</a></li>
                                <li><a href="#customer/sav" ng-class="{ submenuActive: isActive('/customer/sav') }">SAV</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#promotion"><i class="glyphicon glyphicon-star"></i> Promotions</a>
                        </li>
                        <li>
                            <a href="#carrier" ng-class="{ active: isActive('/carrier') }"><i class="glyphicon glyphicon-briefcase"></i> Transport</a>
                            <ul class="submenu" ng-class="{ open: isActive('/carrier') || isActive('/carrier-preference') }">
                                <li><a href="#carrier" ng-class="{ submenuActive: isActive('/carrier') }">Transport</a></li>
                                <li><a href="#carrier-preference" ng-class="{ submenuActive: isActive('/carrier-preference') }">Préférences</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#localization" ng-class="{ active: isActive('/localization') }"><i class="glyphicon glyphicon-map-marker"></i> Localisation</a>
                            <ul class="submenu" ng-class="{ open: isActive('/localization') || isActive('/currency') || isActive('/tax') }">
                                <li><a href="#localization" ng-class="{ submenuActive: isActive('/localization') }">Localisation</a></li>
                                <li><a href="#currency" ng-class="{ submenuActive: isActive('/currency') }">Devises</a></li>
                                <li><a href="#tax" ng-class="{ submenuActive: isActive('/tax') }">Taxes</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#preference/general"><i class="glyphicon glyphicon-cog"></i> Préférences</a>
                            <ul class="submenu" ng-class="{ open: isActive('/preference/general') || isActive('/preference/envoimoinscher') }">
                                <li><a href="#preference/preference" ng-class="{ submenuActive: isActive('/preference/general') }">Générales</a></li>
                                <li><a href="#preference/envoimoinscher" ng-class="{ submenuActive: isActive('/preference/envoimoinscher') }">Envoimoinscher</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#statistic"><i class="glyphicon glyphicon-stats"></i> Statistiques</a>
                        </li>
                    </ul>
                </nav>
                <!--END-->
                <!--MAIN CONTENT-->
                <div class="admin-content" ng-view>
                    <!--CONTENT-->
                </div>
                <!--END-->
            </div>
        </div>
        <!--END-->
        <!--SCRIPT-->
        <script src="libs/jquery.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
        <script src="libs/angular.min.js"></script>
        <script src="libs/angular-animate.min.js"></script>
        <script src="libs/angular-route.min.js"></script>
        <script src="libs/ngDialog.min.js"></script>
        <script src="libs/ngAutocomplete.js"></script>
        <script src="libs/ng-map.min.js"></script>
        <script src="libs/Chart.min.js"></script>
        <script src="libs/angular-chart.min.js"></script>
        <script src="libs/textAngular-rangy.min.js"></script>
        <script src="libs/textAngular-sanitize.min.js"></script>
        <script src="libs/textAngular.min.js"></script>
        <script src="libs/ng-file-upload-shim.min.js"></script>
        <script src="libs/ng-file-upload.min.js"></script>
        <script src="libs/ngStorage.min.js"></script>
        <script src="libs/appAdmin.js"></script>
        <script src="libs/controller.js"></script>
        <script src="libs/service.js"></script>
        <script src="libs/directive.js"></script>
        <script src="libs/filter.js"></script>
        <!--END--> 
    </body>
</html>