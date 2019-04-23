import React, { Component } from 'react';
import Aux from './../../../hoc/Aux';
import './Person.css';

class Person extends Component {
    shouldComponentUpdate(nextProps, nextState) {
        if (nextProps.name !== this.props.name || nextProps.age !== this.props.age) {
            return (true);
        } else {
            return (false);
        }
    }
    render() {
        console.log('[Person.js] render');
        return (
            <Aux>
                <p onClick={this.props.clicked}>Hello, I am {this.props.name} and I am {this.props.age} years old.</p>
                <p>{this.props.children}</p>
                <input type="text" onChange={this.props.changed} value={this.props.name} />
            </Aux>
        );
    }

}

export default Person;