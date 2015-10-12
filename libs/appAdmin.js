// initialize the app
var iroAdmin = angular.module('iroAdmin', ['ngRoute', 'ngAnimate', 'ngDialog', 'ngStorage', 'ngSanitize', 'textAngular', 'ngFileUpload', 'chart.js', 'ngMap', 'ngAutocomplete']);

iroAdmin.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider){

    $routeProvider
    //DASHBOARD
    .when('/', {
        templateUrl: 'partials/dashboard/dashboard.php',
        controller: 'dashboard'
    })
    //CATALOG
    //==PRODUCT
    .when('/catalog/product', {
        templateUrl: 'partials/catalog/product.php',
        controller: 'catalog-product'
    })
    .when('/catalog/product/:productID', {
        templateUrl: 'partials/catalog/product-single.php',
        controller: 'catalog-product'
    })
    .when('/catalog/edit/add-product', {
        templateUrl: 'partials/catalog/product-add.php',
        controller: 'catalog-product'
    })
    //==CATEGORY
    .when('/catalog/category', {
        templateUrl: 'partials/catalog/category.php',
        controller: 'catalog-category'
    })
    .when('/catalog/category/:category', {
        templateUrl: 'partials/catalog/category-single.php',
        controller: 'catalog-category'
    })
    .when('/catalog/edit/add-category', {
        templateUrl: 'partials/catalog/category-add.php',
        controller: 'catalog-category'
    })
    //ORDER
    .when('/order/order', {
        templateUrl: 'partials/order/order.php',
        controller: 'order'
    })
    .when('/order/order/:orderID', {
        templateUrl: 'partials/order/order-single.php',
        controller: 'order'
    })
    .when('/order/bill', {
        templateUrl: 'partials/order/bill.php',
        controller: 'order'
    })
    .when('/order/product-return', {
        templateUrl: 'partials/order/product-return.php',
        controller: 'order'
    })
    .when('/order/delivery-order', {
        templateUrl: 'partials/order/delivery-order.php',
        controller: 'order'
    })
    .when('/order/discount', {
        templateUrl: 'partials/order/discount.php',
        controller: 'order'
    })
    .when('/order/order-status', {
        templateUrl: 'partials/order/order-status.php',
        controller: 'order'
    })
    .when('/order/predefined-message', {
        templateUrl: 'partials/order/predefined-message.php',
        controller: 'order'
    })
    //CUSTOMER
    .when('/customer/customer', {
        templateUrl: 'partials/customer/customer.php',
        controller: 'customer'
    })
    .when('/customer/customer-address', {
        templateUrl: 'partials/customer/customer-address.php',
        controller: 'customer'
    })
    .when('/customer/sav', {
        templateUrl: 'partials/customer/sav.php',
        controller: 'customer'
    })
    //CARRIER
    .when('/carrier/carrier', {
        templateUrl: 'partials/carrier/carrier.php',
        controller: 'carrier'
    })
    .when('/carrier/carrier-preference', {
        templateUrl: 'partials/carrier/carrier-preference.php',
        controller: 'carrier'
    })
    //LOCALIZATION
    .when('/localization/localization', {
        templateUrl: 'partials/localization/localization.php',
        controller: 'localization'
    })
    .when('/localization/currency', {
        templateUrl: 'partials/localization/currency.php',
        controller: 'localization'
    })
    .when('/localization/tax', {
        templateUrl: 'partials/localization/tax.php',
        controller: 'localization'
    })
    //PREFERENCES
    .when('/preference/general', {
        templateUrl: 'partials/preference/general.php',
        controller: 'preference'
    })
    .when('/preference/envoimoinscher', {
        templateUrl: 'partials/preference/envoimoinscher.php',
        controller: 'preference'
    })
    // 404 RETURN
    .otherwise({
        redirectTo: '/'
    });

}]);


iroAdmin.run(['$rootScope', '$location', '$window', function ($rootScope, $location, $window) {

    $rootScope.$on('$routeChangeSuccess', function (currentRoute, previousRoute) {

        angular.element('body').animate({scrollTop:0});
        $rootScope.loading = true;

        // CHANGE MENU ON SCROLL
        $window.onscroll = function(){
            $rootScope.scrollPos = document.body.scrollTop;
            $rootScope.$apply();
        };

        //MONDIAL RELAY API
        // angular.element("#Zone_Widget").MR_ParcelShopPicker({     
        //     Target: "#Retour_Widget", // Selecteur JQuery de l'élément dans lequel sera renvoyé l'ID du Point Relais sélectionné (généralement un champ input hidden)  
        //     Brand: "BDTEST  ", // Votre code client Mondial Relay  
        //     Country: "FR" // Code ISO 2 lettres du pays utilisé pour la recherche  
        // });


    });

    $rootScope.$on('$routeChangeError', function (event, current, previous, rejection){

        if(rejection === 'Not Authenticated'){

            $location.path('/');

        }

    });
}]);

//SIMPLE JAVASCRIPT AND JQUERY FUNCTION
