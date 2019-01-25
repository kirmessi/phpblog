<?php //debug($list);?>
<header class="masthead" style="background-image: url('/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>PHP Framework</h1>
                    <span class="subheading">i'm a simple blog on PHP-OOP-MVC</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
           
            <?php if (empty($list)): ?>
                <p>List of posts not found</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <a href="/post/<?php echo $val['slug']; ?>">
                            <h2 class="post-title"><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></h2>
                            <h5 class="post-subtitle"><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></h5>
                        </a>
                       <div class="row">
                        <div class="col-6">Создано: <?php echo date_create($val['date'])->Format('d.m.Y');?> в <?php echo date_create($val['date'])->Format('H:i');?> </div>
                        <div class="col-6"><a href="/category/<?php echo $val['cat_slug'];?>"><?php echo $val['cat_name'];?></a></div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
                            <?php endif; ?>
        </div>
    </div>
</div>