//FILTER
iroAdmin.filter('unsafe', function($sce){
    return function (val) {
        return $sce.trustAsHtml(val);
    };
});

iroAdmin.filter('nospace', function (){
    return function (value) {
        return (!value) ? '' : value.replace(/ /g, '');
    };
});

iroAdmin.filter('twoDecimal', function(){
  return function (n) {
    return n.toFixed(2);
  };
});

iroAdmin.filter('capitalize', function() {
  return function (input, scope) {
    if (input!=null)
    input = input.toLowerCase();
    return input.substring(0,1).toUpperCase()+input.substring(1);
  };
});

iroAdmin.filter('date', function (){
	return function (value){
		return value.substr(0, 10).replace(/-/g, '/');
	};
});
iroAdmin.filter('substr', function (){
	return function (value){
		return value.substr(0, 6).replace(/[A-Za-z0-9]/g, '*');
	};
});
iroAdmin.filter('bytes', function() {
    return function (bytes, precision) {
        if (bytes === 0) { return '0 bytes' }
        if (isNaN(parseFloat(bytes)) || !isFinite(bytes)) return '-';
        if (typeof precision === 'undefined') precision = 1;

        var units = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'],
            number = Math.floor(Math.log(bytes) / Math.log(1024)),
            val = (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision);

        return  (val.match(/\.0*$/) ? val.substr(0, val.indexOf('.')) : val) +  ' ' + units[number];
    }
});