<div class="comment">
	|-assign var=commentUser value=$comment->getUser()-|
			<div class="commentUser"><h3>|-$commentUser->getUsername()-| (|-$comment->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y a las %R"-|)</h3></div>
	<div class="commentContent">|-$comment->getContent()-|</div>
</div>
