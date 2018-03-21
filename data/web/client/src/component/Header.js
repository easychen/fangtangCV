import React, { Component } from 'react';

import {
    Collapse,
    Navbar,
    NavbarToggler,
    NavbarBrand,
    Nav,
    NavItem,
    NavLink
 } from 'reactstrap';

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
            <NavbarBrand href="/">
            <img src="/logo.png" height="50" alt="方糖简历logo"/>        </NavbarBrand>

            <NavbarToggler onClick={()=>{this.toggleNavbar();}}  />
            <Collapse isOpen={!this.state.collapsed} navbar>
            <Nav navbar>
              <NavItem><NavLink href="/myresume">我的简历</NavLink></NavItem>
              <NavItem><NavLink href="/logout">退出</NavLink></NavItem>
              <NavItem><NavLink href="/register">注册</NavLink></NavItem>
              <NavItem><NavLink href="/login">登入</NavLink></NavItem>
            </Nav>
            </Collapse>
          
        </Navbar>
        </div>;
    }
}