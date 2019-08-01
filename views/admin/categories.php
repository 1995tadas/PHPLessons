<a  class="admin-link" target ="_top" href="<?php echo url("category/create") ?>">Create</a>

<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Slug</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($this->categories as $category): ?>
        <tr>
            <td><input name="category[]" type="checkbox" value="<?php $category->id ?>"> </td>
            <td><?php  echo $category->name?></td>
            <td><?php  echo $category->description ?></td>

            <td><?php  echo $category->slug ?></td>
            <td><a class="admin-link" href="<?php echo url('category/edit/'.$category->id)?>">Edit</a><a class="admin-link" href="<?php echo url('category/delete/'.$category->id)?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>

</table>

