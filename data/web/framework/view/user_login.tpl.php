<!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="screen" href="app.css" />

    <title>用户登入</title>
  </head>
  <body>
    <!-- 页面内容区域 -->
    <div class="container">
        <div class="page-box">
            <h1 class="page-title"><?=$title?></h1>

            <form action="_enter.php?m=user&a=login_check" method="post" id="form_login" onsubmit="send_form('form_login');return false;">
            <div id="form_login_notice" class="form_info middle"></div>

            <div class="form-group">
                <input type="text" name="email" placeholder="Email" class="form-control"/>
            </div> 
            
            <div class="form-group">
            <input type="password" name="password" placeholder="密码（6~12个字符）" class="form-control"/>
            </div> 

            <div class="form-group"><input type="submit" value="登入" class="btn btn-primary"></div>
        </form>


        </div>
        
    </div>

    <!-- /页面内容区域 -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>