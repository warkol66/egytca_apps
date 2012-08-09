				<label for="params[title]">Título</label>
				<input type="text" id="params[title]" name="params[title]" size="20" value="|-$actor->gettitle()|escape-|" title="title" />
			</p>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$actor->getname()|escape-|" title="Nombre" class="emptyValidation" /> |-validation_msg_box idField="params[name]"-|
			</p>
			<p>
				<label for="params[surname]">Apellido</label>
				<input type="text" id="params[surname]" name="params[surname]" size="50" value="|-$actor->getsurname()|escape-|" title="Apellido" class="emptyValidation" /> |-validation_msg_box idField="params[surname]"-|
			</p>
			<p>
				<label for="params[nickname]">Sobrenombre</label>
				<input type="text" id="params[nickname]" name="params[nickname]" size="40" value="|-$actor->getnickname()|escape-|" title="Sobrenombre" />
			</p>
			<p>
				<label for="params[institution]">##actors,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="|-$actor->getinstitution()|escape-|" title="##actors,3,Institución##" />
			</p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
