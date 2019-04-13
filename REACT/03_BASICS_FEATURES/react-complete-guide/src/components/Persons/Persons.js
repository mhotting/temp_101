import React from 'react';
import Person from './Person/Person';

const persons = (props) => props.persons.map((person, index) => {
    let personsReturn = null;

    if (props.persons.length === 0) {
        personsReturn = (
            <div className="Person">
                <p>No body to show!</p>
            </div>
        )
    } else {
        personsReturn = (
            <Person
                clicked={() => props.clicked(index)}
                name={person.name}
                age={person.age}
                key={person.id}
                changed={(event) => props.changed(event, person.id)}
            />
        )
    }
    return (personsReturn);
});

export default persons;