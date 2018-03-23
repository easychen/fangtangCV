import React, { Component } from 'react';
import { Button, Form, FormGroup, Input } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Redirect } from 'react-router-dom';
import { withRouter } from 'react-router';

@withRouter
@inject("store")
@observer
export default class ResumeModify extends Component 
{

    constructor(props)
    {
        super( props );
        this.state = {"title":"","content":"","id":0,"redir":false};
    }

    async componentDidMount()
    {
        const data = await this.props.store.get_resume( this.props.match.params.id );
        
        if( parseInt( data.code , 10 ) === 0  )
            this.setState( {"id":data.data.id,"title":data.data.title,"content":data.data.content} );
        else
            alert( data.error );          
    }

    async update(e)
    {
        if( this.state.title.length === 0 ||  this.state.content.length === 0 )
        {
            alert("简历名称和内容均为必填项");
            e.preventDefault();
            return false;
        }
        
        let data = await this.props.store.update( this.state.id , this.state.title , this.state.content );

        if( parseInt( data.code , 10 ) === 0  )
        {
            //await this.props.store.get_my_resume();
            //await this.props.store.get_all_resume();
            this.setState( {"redir":true} );
        }
            
        else
            alert( data.error );    
        // if( this.props.store.register( this.state.email , this.state.password ))
    }

    handleChange( e , field )
    {
        let o = {};o[field] = e.target.value;
        this.setState( o );
    }
    
    render()
    {
        return <div>
            <h1 className="page-title">新增简历</h1>
            <Form>
                <FormGroup>
                <Input type="text" name="title"  placeholder="简历名称" value={this.state.title} onChange={(e)=>{this.handleChange(e,"title");}}/>
                </FormGroup>
                <FormGroup>
                <Input type="textarea" name="content" className="textBox"  placeholder="简历内容，支持 Markdown 语法" value={this.state.content} onChange={(e)=>{this.handleChange(e,"content");}}/>
                </FormGroup>

                <FormGroup >
                    <Button color="primary" onClick={(e)=>this.update(e)}>更新</Button>
                </FormGroup>
                { this.state.redir  && <Redirect to={"/resume/"+this.state.id}/> }
        </Form>
        </div>;
    }
}