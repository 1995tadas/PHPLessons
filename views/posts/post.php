<div class="posts-wrapper">
    <div class="posts-column">
        <h1><?php echo $this->post->getTitle() ?></h1>
        <img src="<?php echo $this->post->getImage() ?>">
        <p><?php echo $this->post->getContent() ?></p>
        <p>Paskelbimo data: <?php echo $this->post->getDate() ?></p>
        <p>Autorius: <?php echo $this->post->getAuthor_id() ?></p>
    </div>
</div>