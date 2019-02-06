<?php  //debug($list);?>
<?php  //debug($data);?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/post/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['title'], ENT_QUOTES); ?>" name="title">
                            </div>
                            <div class="form-group">
                                <label>Post slug</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['slug'], ENT_QUOTES); ?>" name="slug">
                            </div>
                            <div class="form-group">
                                <label>Short description</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?>" name="description">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" rows="3" name="text"><?php echo htmlspecialchars($data['text'], ENT_QUOTES); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Choose image</label>
                                <input class="form-control" type="file" name="img">
                            </div>
                             <div class="form-group">
                              <label>Select the category</label>
                                <select class="form-control select2 select2-hidden-accessible" name="category_id" data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                               <?php foreach ($list as $category): ?>
                                <option value ="<?php echo $category['category_id'];?>" <?php if ($category['category_id'] == $data['category_id']): ?>
                                 selected
                                <?php endif ?>><?php echo $category['title'];?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="visibility" name="visibility" <?php
                                   if ($data['visibility'] == 1) {
                                      echo 'checked';}?>>
                                <label for="visibility">Publish</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>