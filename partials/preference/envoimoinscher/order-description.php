<!--PREFERENCE / ENVOIMOINSCHER / ORDER DESCRIPTION-->
<div class="form-group">
	<label>Type de vos envois</label>
    <select class="form-control" ng-model="params.type_send">
    	<option value="colis">Colis</option>
    	<option value="encombrant">Encombrant</option>
    	<option value="palette">Palette</option>
    	<option value="pli">Pli</option>
    </select>
</div>
<div class="form-group">
	<label>Nature des envois</label>
	<select class="form-control" ng-model="params.category">
		<option value="{{categoryList.contents[0][0].code}}">{{categoryList.contents[0][0].label}}</option>
		<optgroup ng-repeat="category in categoryList.categories" label="{{category.label}}">
			<option ng-repeat="subCategory in categoryList.contents[category.code]" value="{{subCategory.code}}">{{subCategory.label}}</option>
		</optgroup>
	</select>
</div>
<div class="form-group">
	<label>Type d'emballage</label>
    <select class="form-control" ng-model="params.type_packing">
		<option value="boite">Boîte</option>
		<option value="tube">Tube</option>
	</select>
</div>
<div class="form-group">
	{{params.country}}
	<select class="form-control" ng-model="params.country">
		<option ng-repeat="country in countryList.countries" value="{{country.code}}">{{country.label}}</option>
	</select>
</div>