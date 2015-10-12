<!--PREFERENCE / ENVOIMOINSCHER / SETTINGS-->


<!--TEST SEARCHBOX GOOGLE MAP-->
<div class="col-sm-12 mondial-nav">
    <form class="row" name="mondialRelay" ng-submit="getListPoint(mondial.city, mondial.zipcode)" no-validate>
        <div class="col-sm-12">
            <h5>Sélectionnez votre point relais</h5>
        </div>
        <div class="form-group col-sm-6">
            <input type="text" class="form-control" ng-model="mondial.city" name="city" placeholder="ville"/>
        </div>
        <div class="form-group col-sm-4">
            <input type="text" class="form-control" ng-model="mondial.zipcode" name="zipcode" placeholder="code postal"/>
        </div>
        <div class="form-group col-sm-2">
            <button class="btn btn-default" type="submit" ng-disabled="mondial.$invalid">Chercher</button>
        </div>
        <div class="col-sm-12" ng-if="resError">
            <div class="alert alert-danger">{{resError}}</div>
        </div>
        <div class="col-sm-12" ng-if="resSuccess">
            <div class="alert alert-success">{{resSuccess}}</div>
        </div>
    </form>
</div>
<div class="col-sm-12">
    <map center="{{addresses[0].address}} {{addresses[0].city}} {{addresses[0].zipcode}} {{addresses[0].country}}" zoom="14" class="col-sm-6 map-point">
        <info-window id="bar">
            <div class="marker">
            </div>
        </info-window>
        <marker ng-repeat="address in addresses" id="{{$index}}" position="{{address.address}} {{address.city}} {{address.zipcode}} {{address.country}}" on-click="clicked($index, address.name, address.code, $event)" icon="{url: 'img/map/icon-{{$index + 1}}.png', scaledSize:[70,70]}"></marker>
    </map>
    <div class="col-sm-6 list-point">
        <div class="selected-point">
            <p>Point relais sélectionné : <span><b>{{mondialCode}}</b></span></p>
        </div>
        <ul>
            <li ng-repeat="address in addresses" ng-click="clicked($event, $index, address.name, address.code)" ng-class="{active: isSelectedPoint($index)}">
                <p class="md-title"><b>({{$index + 1}}) {{address.name}}</b></p>
                <p>{{address.address}}</p>
                <p>{{address.zipcode}}, {{address.city}}</p>
            </li>
        </ul>
    </div>
</div>