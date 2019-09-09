
<h1>All posts</h1>
<?php if(count($this->posts)): ?>
<div class="posts-wrapper">
        <?php foreach($this->posts as $post): ?>
            <div class="posts-column">
                <a href="<?php echo url("post/show/").$post->id ?>">
                    <img src="<?php echo uploadsUrl(getGeneratedImage($post->image,600,300))  ?>">
                    <h3><?php echo $post->title ?></h3>
                    <?php if($this->user):?>
                        <a href="<?php echo url("post/edit/").$post->id ?>">Edit post</a>
                        <a href="<?php echo url("post/delete/").$post->id ?>">Delete post</a>
                    <?php endif;?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

