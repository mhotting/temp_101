import React from 'react';

const userInput = (props) => {
    return (
        <div>
            <label for="usrInput">Saisir un mot:</label><br />
            <input type="text" id="usrInput" onChange={ props.changeFunc } value={ props.name } />
        </div>
    );
}

export default userInput;