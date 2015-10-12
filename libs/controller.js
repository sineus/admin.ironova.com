//DASHBOARD CTRL
iroAdmin.controller('dashboard', ['$scope', '$rootScope', '$location', 'ngDialog', '$localStorage', '$routeParams', '$http', function ($scope, $rootScope, $location, ngDialog, $localStorage, $routeParams, $http){

    // SCROLL TO FUNCTION
    $scope.scrollTo = function(pixel){

        angular.element('body').animate({scrollTop:pixel});

    };

    // LOGIN AUTH
    if(localStorage.getItem('admin') != null){

        $rootScope.auth = true;

    }else{

        $rootScope.auth = false;

    }

    //LOG OUT
    $scope.logOut = function(){

        localStorage.removeItem('admin');
        $rootScope.auth = false;
        $location.path('/');

    };

    //----------------------------------------------------------
    //CANCEL ZONE
    //----------------------------------------------------------
    //CANCEL PRODUCT
    $scope.CancelConfirm = function(type){
        var a = confirm('Voulez-vous vraiment quitter cette page ?');
        if(a == true){
            $location.path('/catalog/'+type);
        }
    };

    //----------------------------------------------------------
    //CHART ZONE
    //----------------------------------------------------------
    //CHART DATA
    $scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
    $scope.series = ['Ventes'];
    $scope.data = [
        [65, 59, 80, 81, 56, 55, 40]
    ];
    $scope.onClick = function (points, evt) {
        // console.log(points, evt);
    };

    $('#myTabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    //BOOTSTRAP TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();


    //----------------------------------------------------------
    //NOTIFICATION ZONE
    //----------------------------------------------------------
    //NEW CUSTOMER
    $http.get('process/customer/customer/customer-customer-new.php').success(function (data){
        $scope.newCustomers = data;
        // console.log(data);
    });

    //NOTIF CUSTOMER
    $scope.notifCustomer = function (){
        $http.get('process/customer/customer/customer-view-notif.php').success(function (data){
            $http.get('process/customer/customer/customer-customer-new.php').success(function (data){
                $scope.newCustomers = data;
                // console.log(data);
            });
        });
    };

    //NEW ORDER
    $http.get('process/order/order/order-order-new.php').success(function (data){
        $scope.newOrders = data;
        // console.log(data);
    });

    //NOTIF ORDER
    $scope.notifOrder = function (){
        $http.get('process/order/order/order-view-notif.php').success(function (data){
            $http.get('process/order/order/order-order-new.php').success(function (data){
                $scope.newOrders = data;
                console.log(data);
            });
        });
    };

}]);

//CATALOG PRODUCT CTRL
iroAdmin.controller('catalog-product', ['$scope', '$rootScope', '$http', 'Upload', '$timeout', '$location', '$routeParams', function ($scope, $rootScope, $http, Upload, $timeout, $location, $routeParams){

    //----------------------------------------------------------
    //PRODUCT ZONE
    //----------------------------------------------------------
    //DISPLAY ALL PRODUCT
    $scope.getAllProduct = function(){
        $http.get('process/catalog/product/catalog-product-all.php').success(function (data){
            $scope.products = data;
            $rootScope.loading = false;
            console.log(data);
        });
    };
    $scope.getAllProduct();

    //DISPLAY SINGLE PRODUCT
    $scope.getItem = function (url, _name){
        return $http.get(url, {params:{"item": _name}}).then(function (res){
            return res.data;
        });
    };

    $scope.getItem('process/catalog/product/catalog-product-single.php', $routeParams.productID).then(function (data){
        $scope.product = data;
        $rootScope.loading = false;

        //GET SINGLE CARRIER
        $http.get('process/catalog/product/catalog-carrier-single.php', {params:{"productID": $scope.product.id_product}}).success(function (data){
            $scope.carriersSingle = data;
        });

        //GET ALL CARRIER
        $http.get('process/carrier/carrier-all.php', {params:{"productID": $scope.product.id_product}}).success(function (data){
            $scope.carriers = data;
        });

        //GET PICTURES
        $http.get('process/catalog/product/catalog-picture-single.php', {params:{"productID": $scope.product.id_product}}).success(function (data){
            $scope.picturesProduct = data;
            $rootScope.loading = false;
        });

    });

    //ADD NEW PRODUCTS============================================================
    // ADD PRODUCT TEMPLATES
    $scope.templatesAddProduct = [
        {name: 'Informations', url: 'partials/catalog/add/information.php'},
        {name: 'Prix', url: 'partials/catalog/add/price.php'},
        {name: 'Catégories', url: 'partials/catalog/add/category.php'},
        {name: 'Livraison', url: 'partials/catalog/add/delivery.php'},
        {name: 'Quantité', url: 'partials/catalog/add/quantity.php'},
        // {name: 'Images', url: 'partials/catalog/add/picture.php'},
        // {name: 'Caractéristiques', url: 'partials/catalog/add/feature.php'},
    ];

    //DEFAULT SELECTED TEMPLATE
    $scope.addTemplate = $scope.templatesAddProduct[0].url;
    $scope.addName = $scope.templatesAddProduct[0].name;

    //CHOOSE TEMPLATE
    $scope.selectAddTemplate = function(template){
        $scope.addTemplate = template.url;
        $scope.addName = template.name;
    };

    //TEMPLATE ACTIVE
    $scope.isActiveAdd = function(template){
        return $scope.addTemplate === template.url;
    };

    //NEW PRODUCT ARRAY
    $scope.newProduct = {};

    //ADD PRODUCT
    $scope.addProduct = function(){
        $scope.resAddProduct = false;
        $http({
            method : 'POST',
            url : 'process/catalog/product/catalog-create-product.php',
            data : $scope.newProduct,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function(data) {
            $location.path('/catalog/product');
            $scope.resAddProduct = data;
        });
    };


    //MODIFY PRODUCT============================================================
    // MODIFY PRODUCT TEMPLATES
    $scope.templatesModifyProduct = [
        {name: 'Informations', url: 'partials/catalog/modify/information.php'},
        {name: 'Prix', url: 'partials/catalog/modify/price.php'},
        {name: 'Catégories', url: 'partials/catalog/modify/category.php'},
        {name: 'Livraison', url: 'partials/catalog/modify/delivery.php'},
        {name: 'Quantité', url: 'partials/catalog/modify/quantity.php'},
        {name: 'Images', url: 'partials/catalog/modify/picture.php'},
        // {name: 'Caractéristiques', url: 'partials/catalog/modify/feature.php'},
    ];

    //DEFAULT SELECTED TEMPLATE
    $scope.modifyTemplate = $scope.templatesModifyProduct[0].url;
    $scope.modifyName = $scope.templatesModifyProduct[0].name;

    //CHOOSE TEMPLATE
    $scope.selectModifyTemplate = function(template){
        $scope.modifyTemplate = template.url;
        $scope.modifyName = template.name;
    };

    //TEMPLATE ACTIVE
    $scope.isActiveModify = function(template){
        return $scope.modifyTemplate === template.url;
    };

    //MODIFY PRODUCT
    $scope.updateProduct = function(stay){
        $scope.resUpdateProduct = false;
        $http({
            method : 'POST',
            url : 'process/catalog/product/catalog-modify-product.php',
            data : $scope.product,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function(data) {
           
            angular.element('body').animate({scrollTop:0});
            $scope.resUpdateProduct = data;
            if(stay == true){
                $timeout(function(){
                    $location.path('/catalog/product');
                }, 2000)
            }

        });
    };

    //DELETE PRODUCT============================================================
    $scope.deleteProduct = function (id){
        resDeleteProduct = false;
        var deleteConfirm = confirm('Voulez-vous vraiment supprimer ce produit ?');

        if(deleteConfirm == true){
            $http.get('process/catalog/product/catalog-delete-product.php', {params:{'productID':id}}).success(function (data){
                resDeleteProduct = data;
                $location.path('/catalog/product');
            });
        }
    };

    //----------------------------------------------------------
    //UPLOAD ZONE
    //----------------------------------------------------------
    // ARRAY FILES
    $scope.files = '';

    //UPLOAD PICTURE
    $scope.uploadFiles = function(files, url, _id, _url){

        $scope.files = files;
        $scope.fileRes = false;

        angular.forEach(files, function(file) {
            if (file && !file.$error) {
                // HTTP
                file.upload = Upload.upload({
                    url: url,
                    file: file,
                    fields: {
                        productID: _id,
                        productURL: _url
                    }   
                });
                // RESPONSE
                file.upload.then(function (response){
                    $timeout(function () {
                        file.result = response.data;
                        $scope.fileRes = true;
                        $http.get('process/catalog/product/catalog-picture-single.php', {params:{"productID": _id}}).success(function (data){
                            $scope.picturesProduct = data;
                            $rootScope.loading = false;
                        });
                    });
                    $rootScope.loading = false;
                // ERROR
                }, function (response){
                    if (response.status > 0)
                        $scope.errorMsg = response.status + ': ' + response.data;
                });

                // PROGRESS BAR
                file.upload.progress(function (evt) {
                  // file.progress = Math.min(100, parseInt(100.0 * 
                  //                          evt.loaded / evt.total));
                });
            }   
        });
    };

    //DISPLAY SINGLE PRODUCT PICTURE
    $scope.getItem = function (url, _name){
        return $http.get(url, {params:{"productID": _name}}).then(function (res){
            return res.data;
        });
    };

    $scope.removeImg = function(id, idProduct){
        $http.get('process/catalog/product/catalog-remove-picture.php', {params:{'id_img': id}}).success(function (data){
            $scope.removeImgRes = data;
            $http.get('process/catalog/product/catalog-picture-single.php', {params:{"productID": idProduct}}).success(function (data){
                $scope.picturesProduct = data;
                $rootScope.loading = false;
            });
        });
    };

    //GET ALL CATEGORY
    $http.get('process/catalog/category/catalog-category-all.php').success(function (data){
        $scope.categories = data;
        $rootScope.loading = false;
    });

    //SELECT MULTIPLE CARRIER
    $scope.addCarrier = function (id){
        $('#select-from option:selected').each( function() {
                $('#select-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            // $scope.product['carrier'].push($(this).val());
            $http.get('process/catalog/product/catalog-add-carrier.php', {params:{'carrier':$(this).val(), 'productID':id}}).success(function (data){
                // console.log(data);
            });
            $(this).remove();
        });
    };

    $scope.removeCarrier = function (id){
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            // $scope.product['carrier'].splice($(this).index(), 1);
            // console.log($(this).index());
            $http.get('process/catalog/product/catalog-remove-carrier.php', {params:{'carrier':$(this).val(), 'productID':id}}).success(function (data){
                // console.log(data);
            });
            $(this).remove();
        });
    };

    //ENV CATEGORY EMC
    $http.get('process/preference/envoimoinscher/get_category_list.php').success(function (data){
        $scope.categoryList = data;
    });

    //BOOTSTRAP TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();

}]);

//CATALOG CATEGORY CTRL
iroAdmin.controller('catalog-category', ['$scope', '$rootScope', '$http', 'Upload', '$timeout', '$location', '$routeParams', function ($scope, $rootScope, $http, Upload, $timeout, $location, $routeParams){

    //----------------------------------------------------------
    //CATEGORY ZONE
    //----------------------------------------------------------
    //DISPLAY ALL CATEGORY
    $scope.getAllCategory = function(){
        $http.get('process/catalog/category/catalog-category-all.php').success(function (data){
            $scope.categories = data;
            $rootScope.loading = false;
        });
    };
    $scope.getAllCategory();

    //NEW CATEGORY ARRAY
    $scope.newCategory = {};
    //ADD CATEGORY
    $scope.addCategory = function(){
        $scope.resAddCategory = false;
        $http({
            method : 'POST',
            url : 'process/catalog/category/catalog-create-category.php',
            data : $scope.newCategory,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function (data) {
            $scope.resAddCategory = data;
            $location.path('/catalog/category');
        });
    };

    //DISPLAY SINGLE CATEGORY
    $scope.getCategorySingle = function (url, _name){
        return $http.get(url, {params:{"item": _name}}).then(function (res){
            return res.data;
        });
    };

    $scope.getCategorySingle('process/catalog/category/catalog-category-single.php', $routeParams.category).then(function (data){
        $scope.category = data;
    });


    //MODIFY CATEGORY
    $scope.updateCategory = function(){
        $scope.resUpdateCategory = false;
        $http({
            method : 'POST',
            url : 'process/catalog/category/catalog-modify-category.php',
            data : $scope.category,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function(data) {
            // $location.path('/catalog/category');
            $scope.resUpdateCategory = data;
        });
    };

    //DELETE PRODUCT============================================================
    $scope.deleteCategory = function (id){
        $scope.resDeleteCategory = false;
        var deleteConfirm = confirm('Voulez-vous vraiment supprimer cette catégorie ?');

        if(deleteConfirm == true){
            $http.get('process/catalog/category/catalog-delete-category.php', {params:{'categoryID':id}}).success(function (data){
                $scope.resDeleteCategory = data;
                $scope.getAllCategory();
            });
        }
    };

    $('[data-toggle="tooltip"]').tooltip();

}]);

//ORDER CTRL
iroAdmin.controller('order', ['$scope', '$rootScope', '$http', '$location', '$routeParams', function ($scope, $rootScope, $http, $location, $routeParams){

    //GET ALL ORDER
    $scope.getAllOrder = function (){
        $http.get('process/order/order/order-order-all.php').success(function (data){
            $scope.orders = data;
            $scope.loading = false;
        });
    };
    $scope.getAllOrder();

    //DISPLAY SINGLE ORDER
    $scope.getItem = function (url, _name){
        return $http.get(url, {params:{"item": _name}}).then(function (res){
            return res.data;
        });
    };

    $scope.getItem('process/order/order/order-order-single.php', $routeParams.orderID).then(function (data){
        $scope.order = data;
        $rootScope.loading = false;

        $http.get('process/order/order/order-single-item.php', {params:{'id':$routeParams.orderID}}).success(function (data){
            $scope.items = data;
        });
    });

    //DELETE ORDER
    $scope.deleteOrder = function (id){
        $scope.resDeleteOrder = false;
        var deleteConfirm = confirm('Voulez-vous vraiment supprimer cette commande ?');

        if(deleteConfirm == true){
            $http.get('process/order/order/order-delete-order.php', {params:{'orderID':id}}).success(function (data){
                $scope.resDeleteOrder = data;
                $scope.getAllOrder();
            });
        }
    };

    //MAP
    $scope.map = { center: { latitude: 45, longitude: -73 }, zoom: 8 };

    //ENABLE TOOLTIP BOOTSTRAP
    $('[data-toggle="tooltip"]').tooltip();

}]);

//CUSTOMER CTRL
iroAdmin.controller('customer', ['$scope', '$http', '$routeParams', '$location', '$rootScope', function ($scope, $http, $routeParams, $location, $rootScope){
    //GET ALL CUSTOMER
    $scope.getAllCustomer = function (){
        $http.get('process/customer/customer/customer-customer-all.php').success(function (data){
            $scope.customers = data;
            $scope.loading = false;
        });
    };
    $scope.getAllCustomer();

    //GET ALL CUSTOMER ADDRESS
    $scope.getAllCustomerAddress = function (){
        $http.get('process/customer/customer/customer-address-all.php').success(function (data){
            $scope.customersAddress = data;
            $scope.loading = false;
        });
    };
    $scope.getAllCustomerAddress();

    $scope.deleteAddress = function (id){
        $scope.resDeleteOrder = false;
        var deleteConfirm = confirm('Voulez-vous vraiment supprimer cette commande ?');

        if(deleteConfirm == true){
            $http.get('process/order/order/order-delete-order.php', {params:{'orderID':id}}).success(function (data){
                $scope.resDeleteOrder = data;
                $scope.getAllOrder();
            });
        }
    };

    //BOOTSTRAP TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();

}]);

//CARRIER CTRL
iroAdmin.controller('carrier', ['$scope', function ($scope){



}]);

//LOCALIZATION CTRL
iroAdmin.controller('localization', ['$scope', function ($scope){


}]);

//PREFERENCE CTRL
iroAdmin.controller('preference', ['$scope', '$http', '$location', '$rootScope', '$timeout', '$filter', function ($scope, $http, $location, $rootScope, $timeout, $filter){

    // ENVOIMOINSCHER TEMPLATES
    $scope.templatesEnvoimoinscher = [
        {name: 'Compte marchand', url: 'partials/preference/envoimoinscher/merchant-account.php'},
        {name: 'Adresse d\'enlèvement', url: 'partials/preference/envoimoinscher/merchant-address.php'},
        {name: 'Description des envois', url: 'partials/preference/envoimoinscher/order-description.php'},
        {name: 'Paramètres', url: 'partials/preference/envoimoinscher/parameter.php'},
        {name: 'Transporteurs simples', url: 'partials/preference/envoimoinscher/simple-carrier.php'},
        {name: 'Transporteurs avancés', url: 'partials/preference/envoimoinscher/advanced-carrier.php'},
        {name: 'Simulateur d\'offres', url: 'partials/preference/envoimoinscher/simulation.php'},
    ];

    //DEFAULT SELECTED TEMPLATE
    $scope.envoimoinscherTemplate = $scope.templatesEnvoimoinscher[3].url;
    $scope.envoimoinscherName = $scope.templatesEnvoimoinscher[3].name;

    //CHOOSE TEMPLATE
    $scope.selectEnvoimoinscherTemplate = function(template){
        $scope.envoimoinscherTemplate = template.url;
        $scope.envoimoinscherName = template.name;
    };

    //TEMPLATE ACTIVE
    $scope.isActiveEnvoimoinscher = function(template){
        return $scope.envoimoinscherTemplate === template.url;
    };

    //GET CARRIER SIMPLE AND ADVANCED LIST
    $scope.getCarrier = function (url, type){
        return $http.get(url, {params:{'type': type}}).then(function (res){
            return res.data;
        });
    };
    $scope.getCarrier('process/preference/envoimoinscher/get_carriers_list.php','2').then(function (data){
        $scope.carriers = data;
    });

    $scope.getCarrier('process/preference/envoimoinscher/get_carriers_list.php','1').then(function (data){
        $scope.advancedCarriers = data;
    });

    //GET API ACCOUNT
    $scope.params = {};

    $http.get('process/preference/envoimoinscher/get-all-info-api.php').success(function (data){
        $scope.params = data[0];
    });

    //ADD API ACCOUNT
    $scope.addApiInfo = function (){
        $http({
            method : 'POST',
            url : 'process/preference/envoimoinscher/add_api_info.php',
            data : $scope.params,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function (data){
            angular.element('body').animate({scrollTop:0});
            if(data.type == 0){
                $scope.addApiResError = data.message;
            }else{
                $scope.addApiInfoRes = data;
            }
        });
    };

    //GET CATEGORY LIST
    $http.get('process/preference/envoimoinscher/get_category_list.php').success(function (data){
        $scope.categoryList = data;
    });

    //GET COUNTRY LIST
    $http.get('process/preference/envoimoinscher/get_country_list.php').success(function (data){
        $scope.countryList = data;
        // console.log(data);
    });

    //GET ALL PRODUCT
    $http.get('process/catalog/product/catalog-product-all.php').success(function (data){
        $scope.products = data;
    });

    $scope.simulation = {};

    $scope.simulateAPI = function (){
        $http({
            method: 'POST',
            url: 'process/preference/envoimoinscher/simulateAPI.php',
            data: $scope.simulation,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function (data){
            $scope.simulateDevis = data.offers;
            console.log(data);
            // console.log('price: '+data.offers[0].price['tax-exclusive']);
        })
    };

    //RELAY POINTS
    //GEOCODE, PUT MARKER WITH ARRAY OF ADDRESS
    $scope.getListPoint = function (city, zip){
        $scope.addresses = '';
        $http.get('process/preference/envoimoinscher/get_point_simple_api.php', {params:{'city':city, 'zip': zip}}).success(function (data){

            if(!data.listPoints.length <= 0){
                $scope.addresses = data.listPoints;
                $scope.resSuccess = data.listPoints.length+' point(s) relais trouvés';
                $timeout(function (){
                    $scope.resSuccess = false;
                }, 6000);
                console.log(data);
            }else{
                $scope.resError = 'Aucun point relais trouvé';
                $timeout(function (){
                    $scope.resError = false;
                }, 6000);
            }

        });
    };

    $scope.isSelectedPoint = function(index){
        return $scope.mondialCode === $scope.addresses[index].code;
    };

    $scope.$on('mapInitialized', function(event, evtMap) {
      map = evtMap, marker = map.markers[0];
    });

    var allInfos = [];

    $scope.clicked = function(event, index, _name, point) {

        $scope.mondialCode = point;

        var infoWindow = new google.maps.InfoWindow({
            content: '<h5>('+(index +1)+') '+_name+'</h5>'
        });

        allInfos.push(infoWindow);

        $scope.closeInfos();

        infoWindow.open(map, map.markers[index]);
        map.setCenter(map.markers[index].getPosition());
    };

    $scope.closeInfos = function() {
        for (i = 0; i < allInfos.length; i++) {
            allInfos[i].close();
        }
    };

}]);

// SIDEBAR CTRL
iroAdmin.controller('menu', ['$scope', '$window', '$location', function ($scope, $window, $location){

    //CURRENT ROUTE FOR ACTIVE CLASS
    $scope.isActive = function (viewLocation) {
        var active = (viewLocation === $location.path());
        return active;
    };

}]);

//LOGIN CTRL
iroAdmin.controller('login', ['$scope', '$rootScope', '$http', '$localStorage', '$location', function ($scope, $rootScope, $http, $localStorage, $location){

    // LOGIN
    $scope.loginForm = {};

    $scope.submitLogin = function() {
        $http({
            method : 'POST',
            url : 'iro-admin/process/login/login-admin.php',
            data : $scope.loginForm,
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function(data) {
            $scope.user = data.login;
            $scope.name = data.name;
            $rootScope.auth = data.auth;

            if($rootScope.auth === true){

                var user = [{
                    'login'   : $scope.user,
                    'name'    : $scope.name, 
                    'auth'    : $scope.auth
                }];

                localStorage.setItem('admin', JSON.stringify(user));
                return $scope.resLogin = 'You are connected';

            }else{

                return $scope.resLogin = 'You are not connected';

            }
        });
    };

}]);


