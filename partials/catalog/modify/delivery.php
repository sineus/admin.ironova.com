<!--CATALOG / MODIFY / DELIVERY-->
<div class="form-group">
    <label for="width">Largeur du colis</label>
    <div class="input-group">
	  	<span class="input-group-addon" id="width">cm</span>
	  	<input type="text" class="form-control" aria-describedby="width" ng-model="product.width">
	</div>
</div>
<div class="form-group">
    <label for="height">Hauteur du colis</label>
    <div class="input-group">
	  	<span class="input-group-addon" id="height">cm</span>
	  	<input type="text" class="form-control" aria-describedby="height" ng-model="product.height">
	</div>
</div>
<div class="form-group">
    <label for="depth">Profondeur du colis</label>
    <div class="input-group">
	  	<span class="input-group-addon" id="depth">cm</span>
	  	<input type="text" class="form-control" aria-describedby="depth" ng-model="product.depth">
	</div>
</div>
<div class="form-group">
    <label for="weight">Poids du colis</label>
    <div class="input-group">
	  	<span class="input-group-addon" id="weight">kg</span>
	  	<input type="text" class="form-control" aria-describedby="weight" ng-model="product.weight">
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-sm-6 admin-select left">
			<label>Transporteurs discponibles</label>
			<select multiple class="form-control" id="select-from">
			  	<option ng-repeat="carrier in carriers" value="{{carrier.id}}">{{carrier.name}}</option>
			</select>
			<button type="button" class="btn btn-default" ng-click="addCarrier(product.id_product)"></span> Ajouter <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></button>
		</div>
		<div class="col-sm-6 admin-select right">
			<label>Transporteurs selectionnés</label>
			<select multiple class="form-control" id="select-to">
				<option ng-repeat="carrierSingle in carriersSingle track by $index" value="{{carrierSingle.id}}">{{carrierSingle.name}}</option>
			</select>
			<button type="button" class="btn btn-default" ng-click="removeCarrier(product.id_product)"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retirer</button>
		</div>
	</div>
</div>