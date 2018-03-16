<?php
namespace FangFrame\Controller;

class Resume
{
    protected function check_login()
    {
        if( !is_login() )
        {
            header("Location: /m=user&a=login");
            e("请先<a href='/m=user&amp;a=login'>登入</a>再添加简历");
            exit;
        }
    }
    
    
    public function list()
    {
        $this->check_login();
         
        $data['resume_list'] = get_data( "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `uid` = ? AND `is_deleted` != 1" , [ intval( $_SESSION['uid'] ) ] );
        $data['title'] = "我的简历";
        render_layout( $data );
    }

    public function add()
    {
        $this->check_login();

        $data['title'] = "添加简历";
        render_layout( $data );
    }

    public function save()
    {
        $this->check_login();

        $title = trim( v('title') );
        $content = strip_tags( trim( v('content') ));

        $sql = "INSERT INTO `resume` ( `title` , `content` , `uid` , `created_at` ) VALUES ( ? , ? , ? , ? )";

        // 参数检查
        if( strlen( $title ) < 1 ) e("简历名称不能为空");
        if( mb_strlen( $content ) < 10 ) e("简历内容不能少于10个字符");

        run_sql( $sql , [ $title , $content , intval( $_SESSION['uid'] ) , date( "Y-m-d H:i:s" )  ] , 1062 , "简历名已存在" );

        echo "简历保存成功<script>location='/?m=resume&a=list'</script>";

        return true;

    }

    public function detail()
    {
        $id = intval( v('id') );
        if( $id < 1 ) e("错误的简历ID");

        $resume_list = get_data( "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1" , [ $id ] );

        if( $resume_list )
        {
            $resume = $resume_list[0];
            $resume['title'] = strip_tags( $resume['title'] );
            $resume['content'] = ( new \Parsedown() )->text( $resume['content'] );

            $data['resume'] = $resume;
            $data['title'] = $resume['title'];

            return render_layout( $data , 'solo' );
        }

        return false;

        
    }

    public function index()
    {
        if( $resume_list = get_data( "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE  `is_deleted` != 1" , [ intval( $_SESSION['uid'] ) ] ))
        {
            $data['title'] = '方糖简历';
            $data['resume_list'] = $resume_list;
            return render_layout( $data );
        }
    }

    public function modify()
    {
        $this->check_login();

        $id = intval( v('id') );
        if( $id < 1 ) e("错误的简历ID");

        if( $resume_list = get_data( "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1" , [ $id ] ))
        {
            $resume = $resume_list[0];
            if( $resume['uid'] != $_SESSION['uid'] ) 
                e("只能修改自己的简历");
            else
            {
                $data['title'] = '修改简历';
                $data['resume'] = $resume;
                return render_layout( $data );
            }    
        }
    }

    public function update()
    {
        $this->check_login();

        // 获取输入参数
        $id = intval( v('id') );
        $title = trim( v('title') );
        $content = strip_tags( trim( v('content') ));

        // 参数检查
        if( strlen( $id ) < 1 ) e("简历ID不能为空");
        if( strlen( $title ) < 1 ) e("简历名称不能为空");
        if( mb_strlen( $content ) < 10 ) e("简历内容不能少于10个字符");

        run_sql( "UPDATE `resume` SET `title` = ? , `content` = ? WHERE `id` = ? AND `uid` =  ? LIMIT 1" , [ $title , $content , $id , intval( $_SESSION['uid'] ) ] , 1062 , "简历名称已存在" );

        echo "简历更新成功<script>location='/?m=resume&a=list'</script>";
        return true;
    }

    public function remove()
    {
        $id = intval( v('id') );
        if( $id < 1 ) e("错误的简历ID");

        run_sql( "UPDATE `resume` SET `is_deleted` = 1 , `title` = CONCAT( `title` , ? ) WHERE `id` = ? AND `uid` =  ? LIMIT 1" , [ '_DEL_'.time() , $id , intval( $_SESSION['uid'] ) ] );

        echo "done";
        return true;
    }


}