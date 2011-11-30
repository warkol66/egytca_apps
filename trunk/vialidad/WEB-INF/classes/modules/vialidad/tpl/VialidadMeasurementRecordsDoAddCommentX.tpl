<div class="comment">
	|-assign var=commentUser value=$comment->getUser()-|
	<div class="commentUser">|-$commentUser->getUsername()-|:</div>
	<div class="commentContent">|-$comment->getContent()-|</div>
</div>
<hr />