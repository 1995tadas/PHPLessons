<h1><?php $this->categoryName;?></h1>

<div class="posts-wrapper">
    <?php foreach($this->posts as $post): ?>
        <div class="posts-column">
            <a href="<?php echo url("post/show/".$post->getId()) ?>">
                <img src="<?php echo $post->getImage() ?>">
                <h3><?php echo $post->getTitle() ?></h3>
            </a>
        </div>
    <?php endforeach; ?>
</div>