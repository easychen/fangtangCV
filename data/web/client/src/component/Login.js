import React, { Component } from 'react';
import { Button, Form, FormGroup, Input } from 'reactstrap';
import { observer , inject } from 'mobx-react';
import { Redirect } from 'react-router-dom';

@inject("store")
@observer
export default class Login extends Component 
{

    constructor(props)
    {
        super( props );
        this.state = {"email":"","password":"","redir":false};
    }

    async login()
    {
        const data = await this.props.store.login( this.state.email , this.state.password );
        if( parseInt( data.code , 10 ) === 0  )
            this.setState({"redir":true});
        else
            alert( data.error ); 
    }

    handleChange( e , field )
    {
        //console.log("in change~ "+field+e.target.value );
        let o = {};
        o[field] = e.target.value;
        this.setState( o );
    }
    
    render()
    {
        return <div>
            <h1 className="page-title">用户登入{this.props.store.token}</h1>
            <Form>
                <FormGroup>
                <Input type="email" name="email"  placeholder="Email" value={this.state.email} onChange={(e)=>{this.handleChange(e,"email");}}/>
                </FormGroup>
                <FormGroup>
                <Input type="password" name="password"  placeholder="密码（6~12个字符）" value={this.state.password} onChange={(e)=>{this.handleChange(e,"password");}}/>
                </FormGroup>
                <FormGroup>
                <Button color="primary" onClick={()=>this.login()}>登入</Button>
                </FormGroup>
                {  this.state.redir && <Redirect to="/myresume"/> }
        </Form>
        </div>;
    }
}