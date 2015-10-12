<!--CATALOG / MODIFY / CATEGORY-->
<div class="form-group">
	<label>Catégorie</label>
	<select class="form-control" ng-model="product.id_category">
		<option value="{{categoryList.contents[0][0].code}}">{{categoryList.contents[0][0].label}}</option>
		<optgroup ng-repeat="category in categoryList.categories" label="{{category.label}}">
			<option ng-repeat="subCategory in categoryList.contents[category.code]" value="{{subCategory.code}}">{{subCategory.label}}</option>
		</optgroup>
	</select>
</div>