<nav class="navbar navbar-expand-lg navbar-light no-padding"  style="background-color: white;">
  
  <a class="navbar-brand" href="/">
    <img src="image/logo.png" height="50" alt="方糖简历logo">
  </a>  
  
  
  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    
    <?php
    
  
    ?>
    <?php if( is_login() ): ?>
    <ul class="navbar-nav">
        <li class="nav-item <?=active_class('resume', 'list')?>"><a href="?m=resume&a=list" class="nav-link" ><span class="menu-square"></span>我的简历</a></li>
        <li class="nav-item <?=active_class('user','logout')?>" ><a href="?m=user&a=logout" class="nav-link" ><span class="menu-square"></span>退出</a></li>
    </ul>
    <?php else: ?>
    <ul class="navbar-nav">
        <li class="nav-item <?=active_class('user' , 'register')?>"><a href="?m=user&a=register" class="nav-link" ><span class="menu-square"></span>注册</a></li>
        <li class="nav-item <?=active_class('user' , 'login')?>" ><a href="?m=user&a=login" class="nav-link" ><span class="menu-square"></span>登入</a></li>
    </ul>
    <?php endif; ?>

  </div>
</nav>