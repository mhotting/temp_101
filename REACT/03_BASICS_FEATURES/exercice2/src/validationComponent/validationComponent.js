import React from 'react';

const validationComponent = (props) => {
    let content;
    if (props.len <= 5) {
        content = 'Text too short.';
    } else {
        content = 'Text long enough.';
    }
    return(
        <div>
            <p>{content}</p>
        </div>
    );
}

export default validationComponent;