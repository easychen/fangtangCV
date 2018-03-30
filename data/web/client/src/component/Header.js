import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import {
    Collapse,
    Navbar,
    NavbarToggler,
    NavbarBrand,
    Nav,
    NavItem,
    NavLink
 } from 'reactstrap';

import { observer , inject } from 'mobx-react';


@inject("store")
@observer
export default class Header extends Component 
{
    constructor(props) 
    {
        super(props);

        this.state = { collapsed: true };
    }
    
    toggleNavbar()
    {
        console.log("clicked");
        this.setState({"collapsed":!this.state.collapsed});
    }
    
    render()
    {
        return <div className="header">
        <Navbar light style={{'backgroundColor':'white'}} expand="md">
            <NavbarBrand tag={Link} to="/">
            <img src="logo.png" height="50" alt="方糖简历logo"/>        </NavbarBrand>

            {/* 大屏幕的菜单显示 */}


            
            {/* 小屏幕的菜单显示 */}

            {/* <NavbarToggler onClick={()=>{this.toggleNavbar();}} className="d-md-none" /> */}
            <NavbarToggler onClick={()=>{this.toggleNavbar();}} />
            <Collapse isOpen={!this.state.collapsed} navbar>
            
              { this.props.store.token.length > 0 && <Nav navbar>
              <NavItem><NavLink tag={Link} to="/myresume">我的简历</NavLink></NavItem>
              <NavItem><NavLink tag={Link} to="/logout">退出</NavLink></NavItem></Nav> }

              { this.props.store.token.length === 0 && <Nav navbar>
                <NavItem><NavLink tag={Link} to="/register">注册</NavLink></NavItem>
              <NavItem><NavLink tag={Link} to="/login">登入</NavLink></NavItem></Nav> }
              
            </Collapse>
          
        </Navbar>
        </div>;
    }
}