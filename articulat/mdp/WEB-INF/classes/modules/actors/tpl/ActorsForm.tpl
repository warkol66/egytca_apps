<script type="text/javascript" language="javascript" charset="utf-8">
function completeInput() {
    $('params[internalTwitterUserId]').value = $$('.selected').pluck('id');
}
</script>
|-assign var=twitterUser value=$actor->getTwitterUser()-|
			<p>
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
			<p>
				<div id="" style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceInclude.tpl" defaultValue="|-if is_object($twitterUser)-||-$twitterUser->getName()-||-/if-|" id="autocomplete_twitterUsers" label="Usuario de Twitter" url="Main.php?do=commonAutocompleteListX&getCandidates=1&object=twitterUser&filters[getCandidateActors]=1" name="selectTwitterUser" afterUpdateElement="completeInput" -|
				</div>
				<input type="hidden" id="params[internalTwitterUserId]" name="params[internalTwitterUserId]" size="70"/>
			</p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
