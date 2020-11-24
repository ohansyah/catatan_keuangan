<!-- Side navigation -->
<div class="sidenav">
    <a href="dashboard.php" class="<?php echo $uri[2] == 'dashboard.php' ? 'active' : ''?>"><i class="fa fa-tachometer"></i> Dashboard</a>
    <a href="in.php" class="<?php echo $uri[2] == 'in.php' ? 'active' : ''?>"><i class="fa fa-arrow-circle-down"></i> Catatan Masuk</a>
    <a href="out.php" class="<?php echo $uri[2] == 'out.php' ? 'active' : ''?>"><i class="fa fa-arrow-circle-up"></i> Catatan Keluar</a>
    <a href="category.php" class="<?php echo $uri[2] == 'category.php' ? 'active' : ''?>"><i class="fa fa-th-list"></i> Kategori</a>
    <a href="account_form.php" class="<?php echo $uri[2] == 'account_form.php' ? 'active' : ''?>"><i class="fa fa fa-cogs"></i> Setting</a>
    <a href="action_logout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>