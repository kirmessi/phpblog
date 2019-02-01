<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Posts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if (empty($list)): ?>
                            <p>List of posts is empty</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></td>
                                        <td><?php if ($val['visibility'] ==1): ?>
                                            Published
                                        <?php else: ?>
                                            Moderation
                                        <?php endif ?></td>
                                        <td><a href="/admin/post/edit/<?php echo $val['id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="/admin/post/delete/<?php echo $val['id']; ?>" class="btn btn-danger">Delete</a></td>
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
