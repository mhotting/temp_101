import React, { Component } from 'react';
import './App.css';
import Person from './Person/Person';

class App extends Component {

    state = {
        persons: [
            { id: 'azeratt', name: 'Madi', age: 27 },
            { id: 'vxcvxcvxw', name: 'Justi', age: 27 },
            { id: 'dqsdfdsq', name: 'Scap', age: 4 }
        ]
    };

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
        const style = {
            border: '1px solid blue',
            font: 'inherit',
            padding: '8px',
            backgroundColor: 'white',
            cursor: 'pointer'
        }

        let persons = null;
        if (this.state.persons.length === 0) {
            persons = (
                <div className="Person">
                    <p>No body to show!</p>
                </div>
            )
        } else if (this.state.showPersons) {
            persons = (
                <div>
                    {this.state.persons.map((person, index) => {
                        return (
                            <Person
                                click={this.deletePersonHandler.bind(this, index)}
                                name={person.name}
                                age={person.age}
                                key={person.id}
                                changed={(event) => this.changeNameHandler(event, person.id)}
                            />
                        );
                    })}
                </div>
            );
        }

        return (
            <div className="App">
                <h1>Hello World, this is a React app.</h1>
                <button style={style} onClick={this.toglePersonsHandler}>
                    {this.state.showPersons ? 'Hide Persons' : 'Show Persons'}
                </button>
                {persons}
            </div>
        );
    }
}

export default App;
