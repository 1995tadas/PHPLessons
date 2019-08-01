<div class="post-wrapper">
    <h1>Create New Post</h1>
    <form method="post" action="http://141.136.44.119/mvc/index.php/post/store">
        <input type="text" placeholder="Title" name="title" required>
        <input type="text" placeholder="Image link" name="image" required>
        <textarea placeholder="Post" name="content" required></textarea>
        <input type="number" name="author_id" placeholder="id" required>
        <input type="submit">
    </form>
</div>
