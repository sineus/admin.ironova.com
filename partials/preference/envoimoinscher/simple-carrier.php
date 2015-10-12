<!--PREFERENCE / ENVOIMOINSCHER / SIMPLE CARRIERS-->
<table class="table striped admin-table">
	<thead>
		<tr>
			<th>Offres</th>
			<th>Description</th>
			<th>Pays</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="carrier in carriers track by $index">
			<td>{{carrier.description_store}}</td>
			<td>{{carrier.label_store}}</td>
			<td ng-if="carrier.zone == 1">France</td>
			<td ng-if="carrier.zone == 2">International</td>
			<td ng-if="carrier.zone == 3">Europe</td>
		</tr>
	</tbody>
</table>

