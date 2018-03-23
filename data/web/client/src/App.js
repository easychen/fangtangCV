import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

import Header from './component/Header';
import Index from './component/Index';
import MyResume from './component/MyResume';
import Resume from './component/Resume';
import ResumeAdd from './component/ResumeAdd';
import ResumeModify from './component/ResumeModify';
import Login from './component/Login';
import Logout from './component/Logout';
import Register from './component/Register';

class App extends Component {

  

  render() {
    return (
      <Router>
      <div className="App">
        <Header />
        <div className="main">
          <Switch>
            <Route path="/register" component={Register} />
            <Route path="/login" component={Login} />
            <Route path="/logout" component={Logout} />
            <Route path="/resume_add" component={ResumeAdd} />
            <Route path="/resume_modify/:id" component={ResumeModify} />
            <Route path="/myresume" component={MyResume} />
            <Route path="/resume/:id" component={Resume} />
            <Route path="/" component={Index} />
          </Switch>
        </div>
      </div>
    </Router>  
    );
  }
}

export default App;
