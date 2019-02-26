<?php //debug($data);?><div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/category/edit/<?php echo $data['category_id']; ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['title'], ENT_QUOTES); ?>" name="title">
                            </div>
                            <div class="form-group">
                                <label>Category slug</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['slug'], ENT_QUOTES); ?>" name="slug">
                            </div>
                            <div class="form-group">
                                <label>Short description</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?>" name="description">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>