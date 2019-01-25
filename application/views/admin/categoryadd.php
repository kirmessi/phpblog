<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/category/add" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Название категории</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>Адрес категории</label>
                                <input class="form-control" type="text" name="slug">
                            </div>
                            <div class="form-group">
                                <label>Описание категории</label>
                                <input class="form-control" type="text" name="description">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>