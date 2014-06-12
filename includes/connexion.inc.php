<div id="formcon">
<form action="f/.." class="con" method="post">        
       <h1>Connexion</h1>
		<p>
	      <input type="text" name="email" id="email" placeholder="eMail" <?php if(isset($_POST['email'])){echo "value='".$_POST['email']."'";}?>>
	    </p>
	    <p>
	      <input type="password" name="password" id="password" placeholder="Mot de passe">
	    </p>
	    <p>
		    <input type="checkbox" name="remember" id="remember"/><label for="remember" class="remember">Se souvenir de moi</label>
	    </p>
	    <p class="login-submit">
	      <button type="submit" class="login-button expand">Connexion</button>
	    </p>
	    <p><a href="nmp/lostmdp">Vous avez oublié votre mot de passe?</a></p>
    </form>
</div>