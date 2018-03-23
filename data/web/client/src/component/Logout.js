import React, { Component } from 'react';
import { Redirect } from 'react-router-dom';
import { observer , inject } from 'mobx-react';

@inject("store")
@observer
export default class Login extends Component 
{

    constructor(props)
    {
        super( props );
        this.state = {"redir":false};
    }

    async componentDidMount()
    {
        localStorage.removeItem('token');
        this.props.store.token = '';
        const data = await this.props.store.logout();
        if( parseInt( data.code , 10 ) === 0  )
            this.setState( {"redir":true} );
        else
            alert( data.error );          
    }

    
    render()
    {
        return <div>
            <h1 className="page-title">正在退出……</h1>
            { this.state.redir  && <Redirect to="/"/> }
        </div>;
    }
}