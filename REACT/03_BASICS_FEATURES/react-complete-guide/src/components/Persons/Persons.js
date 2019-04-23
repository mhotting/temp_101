import React, { Component } from 'react';
import Person from './Person/Person';

class Persons extends Component {
    /*
    static getDerivedStateFromProps(props, state) {
        console.log('[Persons.js] getDerivedStateFromProps');
        return (state);
    }
    */

    shouldComponentUpdate(nextProps, nextState) {
        console.log('[Persons.js] shouldComponentUpdate');
        if (nextProps.persons !== this.props.persons) {
            return (true);
        } else {
            return (false);
        }
    }

    render() {
        console.log('[Persons.js] rendering...');
        if (this.props.persons.length === 0) {
            return (
                <div className="Person">
                    <p>No body to show!</p>
                </div>
            );
        } else {
            return (this.props.persons.map((person, index) => {
                return (
                    <Person
                        clicked={() => this.props.clicked(index)}
                        name={person.name}
                        age={person.age}
                        key={person.id}
                        changed={(event) => this.props.changed(event, person.id)}
                    />
                );
            }));
        }
    }
}


export default Persons;