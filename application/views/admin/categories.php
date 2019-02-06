

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if (empty($list)): ?>
                            <p>List of categories is empty</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($val['title'], ENT_QUOTES); ?></td>
                                        <td><a href="/admin/category/edit/<?php echo $val['category_id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="/admin/category/delete/<?php echo $val['category_id']; ?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php // echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>