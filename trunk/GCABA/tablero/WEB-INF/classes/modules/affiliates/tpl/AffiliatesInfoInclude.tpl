<p>
	<label for="affiliate[name]">Institución</label> 
	<input name="affiliate[name]" type="text" value="|-$affiliate->getName()-|" size="60" />
	</p>
<p><label for="affiliateInfo[affiliateInternalNumber]">Número Interno</label> 
	<input name="affiliateInfo[affiliateInternalNumber]" type="text" value="|-$affiliateInfo->getAffiliateInternalNumber()-|" size="20" />
	</p>
<p><label for="affiliateInfo[address]">Dirección</label> 
	<input name="affiliateInfo[address]" type="text" value="|-$affiliateInfo->getAddress()-|" size="60" />
	</p>
<p><label for="affiliateInfo[phone]">Teléfono</label> 
	<input name="affiliateInfo[phone]" type="text" value="|-$affiliateInfo->getPhone()-|" size="50" />
	</p>
<p><label for="affiliateInfo[email]">E-mail</label> 
	<input name="affiliateInfo[email]" type="text" value="|-$affiliateInfo->getEmail()-|" size="60" />
	</p>
<p><label for="affiliateInfo[contact]">Contacto</label> 
	<input name="affiliateInfo[contact]" type="text" value="|-$affiliateInfo->getContact()-|" size="60" />
	</p>
<p><label for="affiliateInfo[contactEmail]">Email Contacto</label> 
	<input name="affiliateInfo[contactEmail]" type="text" value="|-$affiliateInfo->getContactEmail()-|" size="60" />
	</p>
<p><label for="affiliateInfo[web]">WEB</label> 
	<input name="affiliateInfo[web]" type="text" value="|-$affiliateInfo->getWeb()-|" size="60" />
	</p>
<p><label for="affiliateInfo[memo]">MEMO</label> 
	<textarea name="affiliateInfo[memo]" cols="55" rows="8" wrap="virtual">|-$affiliateInfo->getMemo()-|</textarea>
</p>
