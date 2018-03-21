import React, { Component } from 'react';
import { observer , inject } from 'mobx-react';
import { withRouter } from 'react-router';
import ReactMarkdown from 'react-markdown';

@withRouter
@inject("store")
@observer
export default class Resume extends Component 
{

    async componentDidMount()
    {
        // console.log(  );
        // this.props.match.params.id

        const ret = await this.props.store.get_resume( this.props.match.params.id );

        console.log( ret );
    }
    
    render()
    {
        const title = this.props.store.current_resume_title;
        const content = this.props.store.current_resume_content;
        const id = this.props.store.current_resume_id;
        return <div>
            <ReactMarkdown source={content} />
        </div>;
    }
}