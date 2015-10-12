<!--CATALOG / MODIFY / QUANTITY-->
<div class="form-group">
    <label for="quantity">Quantité</label>
    <input type="text" class="form-control" id="quantity" ng-model="product.quantity">
</div>
<div class="form-group">
    <label for="out-of-stock">En cas de rupture de stock</label>
    <div class="radio">
  		<label>
    		<input type="radio" name="out-of-stock" id="refuse" value="refuse" ng-model="product.out_of_stock">
    		Refuser les commandes
  		</label>
	</div>
	<div class="radio">
  		<label>
    		<input type="radio" name="out-of-stock" id="accept" ng-model="product.out_of_stock" value="accept">
    		Accepter les commandes
  		</label>
	</div>
</div>