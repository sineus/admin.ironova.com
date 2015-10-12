<!--CATALOG / ADD / CATEGORY-->
<div class="form-group">
	<label>Catégorie <span class="required">*</span></label>
	<select class="form-control" ng-model="newProduct.category">
	  	<option ng-repeat="category in categories" value="{{category.name}}">{{category.name}}</option>
	</select>
</div>