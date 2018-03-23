import React, { Component } from 'react';
import { ListGroup, ListGroupItem , Button } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Link } from 'react-router-dom';


@inject("store")
@observer
export default class MyResume extends Component 
{

    componentDidMount()
    {
        this.props.store.get_my_resume();
    }

    async remove( id )
    {
        if( window.confirm( "确定要删除这份简历？" ) )
        {
            //
            const data = await this.props.store.remove( id ); 
            if( parseInt( data.code , 10 ) === 0  )
                window.location.reload();
            else
                alert( data.error );
        }
    }
    
    render()
    {
        const resume_list = this.props.store.my_resume_list;
        return <div>
            <h1 className="page-title">我的简历</h1>
            <ListGroup className="resume-list">
            {resume_list.length > 0 && resume_list.map( ( item ) => 
                {
                    //return <ListGroupItem tag="a" href={"/resume/"+item.id} action target="_blank" key={item.id}>{item.title}<img src="/open_in_new.png" alt="查看"/></ListGroupItem>;
                    return <ListGroupItem key={item.id}>
                    <Button tag="a" href={"/resume/"+item.id} color="light" target="_blank">{item.title}</Button> 

                    <Link to={"/resume/"+item.id}  target="_blank"><img src="/open_in_new.png" alt="查看" className="actionIcon"/></Link>

                    <Link to={"/resume_modify/"+item.id}  target="_blank"><img src="/mode_edit.png" alt="编辑" className="actionIcon"/></Link>

                    <a onClick={(e)=>this.remove(item.id)}  ><img src="/close.png" alt="删除" className="actionIcon"/></a>

                    </ListGroupItem>;
                } )}
             {resume_list.length === 0 && <p>还没有简历</p> }

            </ListGroup>

            <div className="actionBox">
                <Button tag="a" href="/resume_add" color="light"><img src="add.png" alt="添加简历" id="resume_add_link"/> 添加简历</Button>
            </div>        
        </div>;
    }
}