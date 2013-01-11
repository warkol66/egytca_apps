<script type="text/javascript" charset="utf-8">
	$('#mgsBoxCommentsShow'+ |-$article->getId()-|).html('');
</script>
<!-- Begin COMENTARIOS ***************************************************-->

	<div id="comentarios">
          <!-- TITULO COMENTARIOS -->
	
		<div id="titleComments"><div id="icoComments"></div>Comentarios</div>
		   
		   <!-- begin COMENTARIOS -->
		   <div id="comentarios">
		     <p>IMPORTANTE: Los comentarios publicados son de exclusiva responsabilidad de sus autores y las consecuencias derivadas de ellos pueden ser pasibles de las sanciones legales que correspondan. Aquel usuario que incluya en sus mensajes algún comentario violatorio del reglamento será eliminado e inhabilitado para volver a comentar. </p>
		   
		   </div><!-- end COMENTARIOS-->

	|-if ($comments|@count eq 0)-|
		<span id="no_comments_|-$article->getId()-|">No hay comentarios actualmente, sea el primero en dejar uno.</span>
	|-/if-|
	
		<div id="div_comments_container_|-$article->getId()-|" >
		|-foreach from=$comments item=comment name=for_comments-|
				<div id="comment|-$comment->getId()-|">
				
				<!-- begin INDIVIDUAL-->		 
					<div class="individual">
				
					<div class="nombre"><img src="images/ico_user.gif" alt="" width="27" height="32" align="left" />|-if $comment->getUrl() ne ""-|<a href="|-$comment->getUrl()-|" >|-$comment->getUsername()-|</a>|-else-||-$comment->getUsername()-||-/if-|</div>
					<div class="fecha"> |-$comment->getCreationDate()|date_format:"%d-%m-%Y %R"-|</div>
					<p>|-$comment->getText()-|</p>
			</div><!-- end INDIVIDUAL-->
				</div>
		|-/foreach-|
		</div>

</p>

<!--Boton para Mostrar Formulario para Agregar Comentario
<input type="button" name="commentAdderShowButton|-$article->getId()-|" value="Agregar Comentario" id="commentAdderShowButton|-$article->getId()-|" onClick='javascript:showCommentAddForm("div_comments_adder_|-$article->getId()-|")'>
-->
<!-- Formulario para agregar comentario -->
<div id="div_comments_adder_|-$article->getId()-|" style="display : none;">
<a name="commentsForm"></a>

          <!-- TITULO FORMULARIO / DEJAR COMENTARIOS -->
		   <div id="titleComments"><div id="icoWriteComments"></div>Deja tu comentario</div>		   
	<div id="formComments">
	<form action="Main.php" method="post" id="formCommentAdder|-$article->getId()-|">
		
		<input type="hidden" name="articleId" value="|-$article->getId()-|" id="articleId" />
			<fieldset title="Formulario para agregar comentarios">
	<p>
			<label for="newscomment_username">Nombre</label><br />
			<input type="text" id="newscomment_username" name="newscomment[username]" title="username" size="40"/>
		</p>
		<p>
			<label for="newscomment_email">Email</label><br />
			<input type="text" id="newscomment_email" name="newscomment[email]" size="40" />
		</p>						
		<!--<p>
			<label for="newscomment_url">Sitio</label>
			<input type="text" id="newscomment_url" name="newscomment[url]" />
		</p>					-->
		<p>
			<label for="newscomment_text">Comentario</label><br />
			<textarea id="newscomment_text" name="newscomment[text]" cols="65" rows="5" wrap="VIRTUAL" ></textarea>
		</p>
		<p><label>Código de seguridad</label>
			<img src="Main.php?do=newsCaptchaGeneration&width=120&height=45&characters=5" />
		</p>
		<p>
			<label for="security_code">Ingrese el código de seguridad</label>
			<input id="security_code" name="securityCode" type="text" size="10" />
		</p>						
		<p>	
			<input type="hidden" name="do" value="newsCommentsDoAddX" id="do">
			<input type="hidden" name="newscomment[articleId]" value="|-$article->getId()-|" id="newscomment[articleId]" />
			<input type="button" value="Agregar Comentario" onClick="javascript:newsCommmentAdd(this.form,|-$article->getId()-|)" /> 
			<input type="button" name="commentAdderHideButton|-$article->getId()-|" value="Cancelar" id="commentAdderHideButton|-$article->getId()-|" onClick="javascript:hideCommentAddForm(|-$article->getId()-|)" /> <span id="msgBoxAdder|-$article->getId()-|"></span>
		</p>
		</fieldset>
	</form>
	</div>
</div>
</div>
