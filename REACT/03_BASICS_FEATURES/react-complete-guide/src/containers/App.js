import React, { Component } from 'react';
import cssClasses from './App.module.css';
import Persons from './../components/Persons/Persons';
import Cockpit from './../components/Cockpit/Cockpit';

class App extends Component {
    // Constructor
    constructor(props) {
        super(props);
        console.log('[App.js] constructor');
        this.state = {
            persons: [
                { id: 'azeratt', name: 'Madi', age: 27 },
                { id: 'vxcvxcvxw', name: 'Justi', age: 27 },
                { id: 'dqsdfdsq', name: 'Scap', age: 4 }
            ],
            showPersons: false,
            showCockpit: true
        };
    }
    /*
    state = {
        persons: [
            { id: 'azeratt', name: 'Madi', age: 27 },
            { id: 'vxcvxcvxw', name: 'Justi', age: 27 },
            { id: 'dqsdfdsq', name: 'Scap', age: 4 }
        ]
    };
    */

    // GetDerivedStatusFromProps
    static getDerivedStateFromProps(props, state) {
        console.log('[App.js] getDerivedStatusFromProps');
        return (state);
    }

    // Rendering process and tools
    changeNameHandler = (event, id) => {
        const personIndex = this.state.persons.findIndex(p => {
            return (p.id === id);
        });
        const person = { ...this.state.persons[personIndex] };
        person.name = event.target.value;
        const persons = [...this.state.persons];
        persons[personIndex] = person;
        this.setState({
            persons: persons
        });
    }

    toglePersonsHandler = () => {
        //const doesShow = this.state.showPersons;
        this.setState({ showPersons: !this.state.showPersons });
    }

    deletePersonHandler = (personIndex) => {
        const persons = [...this.state.persons];
        persons.splice(personIndex, 1);
        this.setState({
            persons: persons
        });
    }

    render() {
        console.log('[App.js] render');
        let cockpit = null;
        let persons = null;

        if (this.state.showCockpit) {
            cockpit = <Cockpit
                appTitle={this.props.appTitle}
                showPersons={this.state.showPersons}
                toggle={this.toglePersonsHandler}
                cssClasses={cssClasses}
                persons={this.state.persons}
            />
        }

        if (this.state.showPersons) {
            persons =
                <Persons
                    persons={this.state.persons}
                    clicked={this.deletePersonHandler}
                    changed={this.changeNameHandler}
                />;
        }

        return (
            <div className={cssClasses.App}>
                <button onClick={() => this.setState({showCockpit: !this.state.showCockpit})}>COCKPIT</button>
                {cockpit}
                {persons}
            </div>
        );
    }

    // componentDidMount
    componentDidMount() {
        console.log('[App.js] componentDidMount');
    }
}

export default App;