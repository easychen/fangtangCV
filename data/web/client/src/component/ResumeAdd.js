import React, { Component } from 'react';
import { Button, Form, FormGroup, Input } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Redirect } from 'react-router-dom';

@inject("store")
@observer
export default class ResumeAdd extends Component 
{

    constructor(props)
    {
        super( props );
        this.state = {"title":"","content":""};
    }

    async save(e)
    {
        if( this.state.title.length === 0 ||  this.state.content.length === 0 )
        {
            alert("简历名称和内容均为必填项");
            e.preventDefault();
            return false;
        }
        
        let data = await this.props.store.save( this.state.title , this.state.content );

        if( parseInt( data.code , 10 ) === 0  )
            this.setState( {"redir":true} );
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
                    <Button color="primary" onClick={(e)=>this.save(e)}>保存</Button>
                </FormGroup>
                { this.state.redir  && <Redirect to="/myresume"/> }
        </Form>
        </div>;
    }
}