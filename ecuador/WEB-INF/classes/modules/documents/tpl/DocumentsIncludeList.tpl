			|-foreach from=$result item=document-|
				<li><a href="Main.php?do=documentsDoDownload&id=|-$document->getId()-|">|-$document->getTitle()-|</a></li>
			|-/foreach-|
