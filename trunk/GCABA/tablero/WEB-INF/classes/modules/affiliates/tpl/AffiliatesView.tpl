<h2>##common,18,Configuración del Sistema##</h2>
<h1>Ver Instituciones</h1>
<p>A contunuación puede ver los datos ingresados al sistema de la Institución: "|-$affiliate->getName()-|".
<fieldset title="Ver datos de Instituciones">
<legend>Ver Datos de la Institución</legend>
<p><label for="affiliate[name]">Id</label> 
	<input name="affiliate[name]" type="text" value="|-$affiliate->getId()-|" size="10" readonly="readonly" />
</p>
<p><label for="affiliate[name]">Institución</label> 
	<input name="affiliate[name]" type="text" value="|-$affiliate->getName()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[affiliateInternalNumber]">Número Interno</label> 
	<input name="affiliateInfo[affiliateInternalNumber]" type="text" value="|-$affiliateInfo->getAffiliateInternalNumber()-|" size="20" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[address]">Dirección</label> 
	<input name="affiliateInfo[address]" type="text" value="|-$affiliateInfo->getAddress()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[phone]">Teléfono</label> 
	<input name="affiliateInfo[phone]" type="text" value="|-$affiliateInfo->getPhone()-|" size="50" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[email]">E-mail</label> 
	<input name="affiliateInfo[email]" type="text" value="|-$affiliateInfo->getEmail()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[contact]">Contacto</label> 
	<input name="affiliateInfo[contact]" type="text" value="|-$affiliateInfo->getContact()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[contactEmail]">Email Contacto</label> 
	<input name="affiliateInfo[contactEmail]" type="text" value="|-$affiliateInfo->getContactEmail()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[web]">WEB</label> 
	<input name="affiliateInfo[web]" type="text" value="|-$affiliateInfo->getWeb()-|" size="60" readonly="readonly" />
	</p>
<p><label for="affiliateInfo[memo]">MEMO</label> 
	<textarea name="affiliateInfo[memo]" cols="60" rows="7" wrap="virtual" readonly="readonly">|-$affiliateInfo->getMemo()-|</textarea>
</p>
<p><a href='Main.php?do=affiliatesList'>Volver</a>
</p>
</fieldset>
