import React, { Component } from 'react';
import { observer , inject } from 'mobx-react';
import { withRouter } from 'react-router';
import ReactMarkdown from 'react-markdown';

@withRouter
@inject("store")
@observer
export default class Resume extends Component 
{

    constructor( props )
    {
        super( props );
        this.state = {"content":""};
    }

    async componentDidMount()
    {
        // console.log(  );
        // this.props.match.params.id

        const data = await this.props.store.get_resume( this.props.match.params.id );

        if( parseInt( data.code , 10 ) === 0  )
            this.setState( {"content":data.data.content} );
        else
            alert( data.error );   
        
        console.log( data );
    }
    
    render()
    {
        return <div>
            <ReactMarkdown source={this.state.content} />
        </div>;
    }
}