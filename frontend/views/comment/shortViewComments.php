<div class="comments">
	<?php foreach($model->models as $comment) : ?>
	    <div class="comment">
	        <div class="meta">Author: <strong><?=isset($comment->author) ? $comment->author->username : null?></strong></div>
	        <div>Description: <?= htmlspecialchars($comment->content) ?></div>
	    </div>
	    <hr class="smallHr">
	<?php endforeach; ?>
</div>