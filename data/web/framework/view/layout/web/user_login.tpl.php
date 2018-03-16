<h1 class="page-title"><?=$title?></h1>

<form action="/?m=user&amp;a=login_check" method="post" id="form_login" onsubmit="send_form('form_login');return false;">
<div id="form_login_notice" class="form_info middle"></div>

<div class="form-group">
    <input type="text" name="email" placeholder="Email" class="form-control"/>
</div> 

<div class="form-group">
<input type="password" name="password" placeholder="密码（6~12个字符）" class="form-control"/>
</div> 

<div class="form-group"><input type="submit" id="login_button" value="登入" class="btn btn-primary"></div>
</form>