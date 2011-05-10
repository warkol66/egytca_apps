	<tr style="background-color : |-if $comment->isFromAdmin()-|#00CCFF;|-/if-||-if $comment->isFromSupplier()-|#CCFF99;|-/if-||-if $comment->isFromUser()-|#FFFF66;|-/if-|">
				<td width="10%">|-if $comment->isFromAdmin() or $comment->isFromSupplier()-||-assign var="user" value=$userPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				|-if $comment->isFromUser()-||-assign var="user" value=$affiliateUserPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				</td>
				<td width="90%">|-$comment->getText()-|</td>
	</tr>

