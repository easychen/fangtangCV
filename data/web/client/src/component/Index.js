import React, { Component } from 'react';
import { ListGroup, ListGroupItem } from 'reactstrap';

export default class Index extends Component 
{
    render()
    {
        const resume_list = [];
        return <div>
            <h1 className="page-title">最新简历</h1>
            <ListGroup className="resume-list">
            {resume_list.length > 0 && resume_list.map( ( item ) => 
                {
                    return <ListGroupItem tag="a" href={"/resume/"+item.id} action target="_blank">{item.title}<img src="/open_in_new.png" alt="查看"/></ListGroupItem>;
                } )}
             {resume_list.length === 0 && <p>2还没有简历</p> }

            

            </ListGroup>
        </div>;
    }
}