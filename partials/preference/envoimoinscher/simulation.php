<!--PREFERENCE / ENVOIMOINSCHER / SIMULATOR-->
{{simulation}}
<div class="form-group">
	<label>Choisissez un produit</label>
	<select ng-model="simulation.product">
		<option ng-repeat="product in products" value="{{product.id_product}}">{{product.name}}</option>
	</select>
</div>
<div class="form-group">
	<label>Type de vos envois</label>
    <select class="form-control" ng-model="simulation.type_send">
    	<option value="colis">Colis</option>
    	<option value="encombrant">Encombrant</option>
    	<option value="palette">Palette</option>
    	<option value="pli">Pli</option>
    </select>
</div>
<div class="form-group">
	<label>Nature des envois</label>
	<select class="form-control" ng-model="simulation.category">
		<option value="{{categoryList.contents[0][0].code}}">{{categoryList.contents[0][0].label}}</option>
		<optgroup ng-repeat="category in categoryList.categories" label="{{category.label}}">
			<option ng-repeat="subCategory in categoryList.contents[category.code]" value="{{subCategory.code}}">{{subCategory.label}}</option>
		</optgroup>
	</select>
</div>
<div class="form-group">
	<label>Code postal de départ</label>
	<input type="text" ng-model="simulation.cp_from" ng-autocomplete="result"/>
</div>
<div class="form-group">
	<label>Ville de départ</label>
	<input type="text" ng-model="simulation.city_from" ng-autocomplete="result"/>
</div>
<div class="form-group">
	<label>Code postal d'arrivée</label>
	<input type="text" ng-model="simulation.cp_to" ng-autocomplete="result"/>
</div>
<div class="form-group">
	<label>Ville d'arrivée</label>
	<input type="text" ng-model="simulation.city_to" ng-autocomplete="result"/>
</div>
<div class="form-group">
	<label>Pays de destination</label>
	<select class="form-control" ng-model="simulation.country">
		<option ng-repeat="country in countryList.countries" value="{{country.code}}">{{country.label}}</option>
	</select>
</div>
<div class="form-group">
<button type="button" class="btn btn-default" ng-click="simulateAPI()"><span class="glyphicon glyphicon-repeat"></span> Simuler</button>
</div>
<h5 class="title"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> Choix proposés</h5>
<table class="table striped admin-table">
	<thead>
	    <th>Transporteur</th>
	    <th>Prix</th>
	    <th>Collecte</th>
	    <th>Livraison</th>
	    <th>Détails</th>
	    <th>Alertes</th>
	    <th>Informations à fournir</th>
	</thead>
	<tbody>
	    <tr ng-repeat="devis in simulateDevis">
	        <td>{{devis.operator.label}} / {{devis.service.code}}</td>
	        <td>{{devis.price['tax-exclusive']}}€</td>
	        <td>{{devis.collection.date}}</td>
	        <td>{{devis.delivery.date}}</td>
	        <td>{{devis.characteristics}}</td>
	        <td>{{devis.alert}}</td>
	        <td>{{devis.mandatory}}</td>
	    </tr>                                     
	</tbody>
</table>


