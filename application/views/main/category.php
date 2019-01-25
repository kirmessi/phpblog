
<header class="masthead" style="background-image: url('/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
				<?php 
        $newArr = array();
        foreach ($list as $val) {
            $newArr[$val['cat_name']] = $val;
          
        }
         foreach ($newArr as $val): ?>
                    <h1><?php echo $val['cat_name'];?></h1>
                    <span class="subheading"><?php echo $val['cat_desc'];?></span>
                    <?php endforeach; ?>
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
                        
                    </div>
                    <hr>
                <?php endforeach; ?>
                            <?php endif; ?>
        </div>
    </div>
</div>