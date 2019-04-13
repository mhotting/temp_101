import React from 'react';

const cockpit = (props) => {
    let btnClasses = '';
    let content = '';

    if (props.persons.length === 0) {
        btnClasses += props.cssClasses.red;
        content = 'No person'
    } else {
        content = props.showPersons ? 'Hide Persons' : 'Show Persons';
    }
    return (
        <div>
            <h1>{props.appTitle}</h1>
            <button className={btnClasses} onClick={props.toggle}>
                {content}
            </button>
        </div>
    );
};

export default cockpit;