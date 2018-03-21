import React, { Component } from 'react';
// import logo from './logo.svg';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';


import {
  BrowserRouter as Router,
  Route,
  Switch,
  Link
} from 'react-router-dom';

import Header from './component/Header';
import Index from './component/Index';
import MyResume from './component/MyResume';
import Resume from './component/Resume';
import Login from './component/Login';

class App extends Component {

  

  render() {
    return (
      <Router>
      <div className="App">
        <Header />
        <div className="main">
          <Switch>
            <Route path="/login" component={Login} />
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
