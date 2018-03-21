import React, { Component } from 'react';
import { ListGroup, ListGroupItem } from 'reactstrap';
import { observer , inject } from 'mobx-react';

@inject("store")
@observer
export default class MyResume extends Component 
{

    componentDidMount()
    {
        console.log("mount");
        this.props.store.get_my_resume();
    }
    
    render()
    {
        const resume_list = this.props.store.my_resume_list;
        return <div>
            <h1 className="page-title">我的简历</h1>
            <ListGroup className="resume-list">
            {resume_list.length > 0 && resume_list.map( ( item ) => 
                {
                    return <ListGroupItem tag="a" href={"/resume/"+item.id} action target="_blank" key={item.id}>{item.title}<img src="/open_in_new.png" alt="查看"/></ListGroupItem>;
                } )}
             {resume_list.length === 0 && <p>2还没有简历</p> }

            

            </ListGroup>
        </div>;
    }
}