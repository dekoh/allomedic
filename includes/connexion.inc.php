
<div id="formcon">
<form action="php/connexion.ex.php" class="con" method="post">        
       <h1>Connexion</h1>
		<p>
	      <!-- <label for="login">Pseudo:</label> -->
	      <input type="text" name="email" id="email" placeholder="eMail">
	    </p>
	
	    <p>
	      <!-- <label for="password">Mot de passe:</label> -->
	      <input type="password" name="password" id="password" placeholder="Mot de passe">
	    </p>
	
	    <p>
		    <input type="checkbox" name="remember" id="remember"/><label for="remember" class="remember">Se souvenir de moi</label>
	    </p>
	    <p class="login-submit">
	      <button type="submit" class="login-button expand">Connexion</button>
	    </p>
	    <p><a href="motdepasse">Vous avez oublié votre mot de passe?</a></p>
    </form>
</div>