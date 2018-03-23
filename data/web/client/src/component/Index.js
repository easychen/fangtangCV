import React, { Component } from 'react';
import { ListGroup, ListGroupItem , Button } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Link } from 'react-router-dom';

@inject("store")
@observer
export default class Index extends Component 
{
    componentDidMount()
    {
        this.props.store.get_all_resume();
    }
    
    render()
    {
        const resume_list = this.props.store.all_resume_list;
        return <div>
            <h1 className="page-title">最新简历</h1>
            <ListGroup className="resume-list">
            {resume_list.length > 0 && resume_list.map( ( item ) => 
                {
                    return <ListGroupItem  action key={item.id}>
                    <Button tag="a" href={"/resume/"+item.id} color="light" target="_blank">{item.title}</Button> 

                        <Link to={"/resume/"+item.id}  target="_blank"><img src="/open_in_new.png" alt="查看" className="actionIcon"/></Link>

                    </ListGroupItem>;
                } )}
             {resume_list.length === 0 && <p>还没有简历</p> }

            

            </ListGroup>
        </div>;
    }
}