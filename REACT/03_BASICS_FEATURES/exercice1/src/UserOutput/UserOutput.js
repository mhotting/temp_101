import React from 'react';
import './UserOutput.css';

const userOutput = (props) => {
    return (
        <div className="UserOutput">
            <p>Username: { props.uname }</p>
            <p>My job: { props.job }</p>
            <p>{ props.children }</p>
        </div>
    );
}

export default userOutput;