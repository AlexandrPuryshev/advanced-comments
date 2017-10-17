<div class="comment">
    <div class="meta">Author: <strong><?= isset($model->author) ? $model->author->username : null ?></strong></div>
    <div>Description: <?= htmlspecialchars($model->content) ?></div>
</div>
<hr class="smallHr">