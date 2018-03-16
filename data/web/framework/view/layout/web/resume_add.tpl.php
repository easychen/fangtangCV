<form action="/?m=resume&amp;a=save" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;">
    <div id="form_resume_notice" class="form_info full"></div>
    
    <div class="form-group"><input type="text" name="title" placeholder="简历名称" class="form-control"/></div>

    <div class="form-group"><textarea rows="10" name="content" placeholder="简历内容，支持 Markdown 语法" class="form-control"></textarea></div>

    
    <div class="form-group"><input type="submit" id="resume_add_button" value="保存简历" class="btn btn-primary"><input type="button" value="返回" class="btn btn-outline-secondary float-right" onClick="history.back(1);void(0);"></div>
</form>