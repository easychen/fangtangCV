import React, { Component } from 'react';
import { Button, Form, FormGroup,Input } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Redirect } from 'react-router-dom';

@inject("store")
@observer
export default class Register extends Component 
{

    constructor(props)
    {
        super( props );
        this.state = {"email":"","password":"","password2":"","redir":false};
    }

    async register(e)
    {
        if( this.state.password !== this.state.password2 )
        {
            alert("两次输入的密码不一致");
            e.preventDefault();
            return false;
        }
        
        let data = await this.props.store.register( this.state.email , this.state.password );

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
            <h1 className="page-title">用户注册</h1>
            <Form>
                <FormGroup>
                <Input type="email" name="email"  placeholder="Email" value={this.state.email} onChange={(e)=>{this.handleChange(e,"email");}}/>
                </FormGroup>
                <FormGroup>
                <Input type="password" name="password"  placeholder="密码（6~12个字符）" value={this.state.password} onChange={(e)=>{this.handleChange(e,"password");}}/>
                </FormGroup>

                <FormGroup>
                <Input type="password" name="password2"  placeholder="重复密码（6~12个字符）" value={this.state.password2} onChange={(e)=>{this.handleChange(e,"password2");}}/>
                </FormGroup>
                <FormGroup>
                <Button color="primary" onClick={(e)=>this.register(e)}>注册</Button>
                </FormGroup>
                { this.state.redir  && <Redirect to="/login"/> }
        </Form>
        </div>;
    }
}