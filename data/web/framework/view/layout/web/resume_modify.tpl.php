<h1 class="page-title">修改简历</h1>

<form action="/?m=resume&amp;a=update" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;">
    <div id="form_resume_notice" class="form_info middle"></div>

    <div class="form-group">
        <input type="text" name="title" placeholder="简历名称" class="form-control" value="<?=$resume['title']?>"/>
    </div> 

    <div class="form-group">
        <textarea  rows="10" name="content" placeholder="简历内容，支持 Markdown 语法" class="form-control"><?=htmlspecialchars( $resume['content'] ) ?></textarea>
    </div>

    <input type="hidden" name="id" value="<?=$resume['id']?>"/>
    
    <div class="form-group"><input type="submit" value="更新简历" id="resume_update_button" class="btn btn-primary">&nbsp;<input type="button" value="返回" class="btn btn-outline-secondary float-right" onClick="history.back(1);void(0);"></div>
</form>