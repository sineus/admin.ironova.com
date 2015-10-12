<!--CATALOG / ADD / QUANTITY-->
<div class="form-group">
    <label for="quantity">Quantité<span class="required">*</span></label>
    <input type="text" class="form-control" id="quantity" ng-model="newProduct.quantity" required>
</div>
<div class="form-group">
    <label for="out-of-stock">En cas de rupture de stock <span class="required">*</span></label>
    <div class="radio">
  		<label>
    		<input type="radio" name="out-of-stock" id="refuse" value="refuse" ng-model="newProduct.out_of_stock">
    		Refuser les commandes
  		</label>
	</div>
	<div class="radio">
  		<label>
    		<input type="radio" name="out-of-stock" id="accept" value="accept" ng-model="newProduct.out_of_stock">
    		Accepter les commandes
  		</label>
	</div>
</div>