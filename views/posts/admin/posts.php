
<a  class="admin-link" target ="_top" href="<?php echo url("post/create") ?>">Create</a>

<table>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Content</th>
        <th>Image</th>
    </tr>
    <?php foreach ($this->posts as $post): ?>
    <tr>
        <td><input name="post[]" type="checkbox" value="<?php $post->id ?>"> </td>
        <td><?php  echo $post->title?></td>
        <td><?php  echo $post->content?></td>
        <td><img src="<?php  echo $post->image?>"></td>
        <td><a class="admin-link" href="<?php echo url('post/edit/'.$post->id)?>">Edit</a><a class="admin-link" href="<?php echo url('post/delete/'.$post->id)?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>

</table>
