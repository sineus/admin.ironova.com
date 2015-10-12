<!--PREFERENCE / ENVOIMOINSCHER / API SELLER ADDRESS-->
<div class="form-group">
	<label>Civilité de l'expéditeur</label>
	<div class="radio-inline">
	  <label>
	    <input type="radio" value="M" checked ng-model="params.gender">
	    M.
	  </label>
	</div>
	<div class="radio-inline">
	  <label>
	    <input type="radio" value="Mme" ng-model="params.gender">
	    Mme
	  </label>
	</div>
</div>
<div class="form-group">
	<label>Prénom de l'expéditeur</label>
    <input type="text" class="form-control" ng-model="params.first_name">
</div>
<div class="form-group">
	<label>Nom de l'expéditeur</label>
    <input type="text" class="form-control" ng-model="params.last_name">
</div>
<div class="form-group">
	<label>Société</label>
    <input type="text" class="form-control" ng-model="params.society">
</div>
<div class="form-group">
	<label>Adresse</label>
    <input type="text" class="form-control" ng-model="params.address">
</div>
<div class="form-group">
	<label>Code postal</label>
    <input type="text" class="form-control" ng-model="params.zip">
</div>
<div class="form-group">
	<label>Ville</label>
    <input type="text" class="form-control" ng-model="params.city">
</div>
<div class="form-group">
	<label>Téléphone</label>
    <input type="text" class="form-control" ng-model="params.phone">
</div>
<div class="form-group">
	<label>Email</label>
    <input type="text" class="form-control" ng-model="params.mail">
</div>
<div class="form-group">
	<label>Début de disponibilité pour l'enlèvement</label>
    <select class="form-control" ng-model="params.dde">
    	<option>12:00</option>
    	<option>12:15</option>
    	<option>12:30</option>
    	<option>12:45</option>
    	<option>13:00</option>
    	<option>13:15</option>
    	<option>13:30</option>
    	<option>13:45</option>
    	<option>14:00</option>
    	<option>14:15</option>
    	<option>14:30</option>
    	<option>14:45</option>
    	<option>15:00</option>
    	<option>15:15</option>
    	<option>15:30</option>
    	<option>15:45</option>
    	<option>16:00</option>
    	<option>16:15</option>
    	<option>16:30</option>
    	<option>16:45</option>
    	<option>17:00</option>
    </select>
</div>
<div class="form-group">
	<label>Fin de disponibilité pour l'enlèvement</label>
    <select class="form-control" ng-model="params.fde">
    	<option>17:00</option>
    	<option>17:15</option>
    	<option>17:30</option>
    	<option>17:45</option>
    	<option>18:00</option>
    	<option>18:15</option>
    	<option>18:30</option>
    	<option>18:45</option>
    	<option>19:00</option>
    	<option>19:15</option>
    	<option>19:30</option>
    	<option>19:45</option>
    	<option>20:00</option>
    	<option>20:15</option>
    	<option>20:30</option>
    	<option>20:45</option>
    	<option>21:00</option>
    </select>
</div>