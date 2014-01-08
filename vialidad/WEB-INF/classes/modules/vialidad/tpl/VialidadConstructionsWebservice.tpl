{
  "obras":
	[
|-if $constructionColl->count() gt 0-|
	|-foreach $constructionColl as $construction-|
		{
			"Id de Obra" : "|-$construction->getId()-|",
			"Nombre" : "|-$construction->getName()-|",
			"Número" : "|-$contract = $construction->getContract()-||-if is_object($contract)-||-$contract->getContractNumber()-||-/if-|",
			"Pac" : "|-if is_object($contract)-||-$contract->getPacNumber()-||-/if-|",
			"Contratista" : "|-assign var="contractor" value=$construction->getContractor()-||-if $contractor-||-$contractor->getName()-||-/if-|"
		}|-if !$construction@last-|,|-/if-|
	|-/foreach-|

	]

|-/if-|
}