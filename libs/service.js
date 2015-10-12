
// AUTH PROTECT USER PAGE
iroAdmin.factory('AuthService', function ($q, $rootScope){

    return {

        authenticate: function (){

            if($rootScope.auth){

                return true;

            }else{

                return $q.reject('Not Authenticated');

            }

        }

    };

});







