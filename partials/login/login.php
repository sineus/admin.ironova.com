<div class="overlay-login" ng-controller="login">
	<div class="col-sm-12 login-container">
		<img src="img/logo-full-white.svg" alt="logo-full-ironova-white"/>
		<form name="login" autocomplete="off">
			<div class="form-group">
			    <!-- <label>Login <span class="label-required">*</span></label> -->
			    <input type="email" class="log-user" name="login_mail" placeholder="Login" ng-model="loginForm.login_mail" readonly  
	     onfocus="this.removeAttribute('readonly');" required/>
			    <p ng-show="login.login_mail.$invalid && login.login_mail.$touched" class="required-text">Field required</p>
			</div>
			<div class="form-group">
			    <!-- <label>Password <span class="label-required">*</span></label> -->
			    <input type="password" class="log-psw" name="login_password" placeholder="Password" ng-model="loginForm.login_password" readonly  
	     onfocus="this.removeAttribute('readonly');" required/>
			    <p ng-show="login.login_password.$invalid && login.login_password.$touched" class="required-text">Field required</p>
			</div>
			<div class="col-sm-12">
	            <button type="submit" ng-click="submitLogin()" class="send-btn" ng-disabled="login.$invalid">Sign in</button>
	            <p ng-show="resLogin" class="alert alert-warning response" role="alert">
	                {{resLogin}}
	            </p>
	        </div>
		</form>
	</div>
</div>