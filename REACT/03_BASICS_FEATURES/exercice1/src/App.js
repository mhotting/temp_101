import React, { Component } from 'react';
import './App.css';
import UserInput from './UserInput/UserInput';
import UserOutput from './UserOutput/UserOutput';

class App extends Component {
    state = {
        outputs: [
            { uname: 'Elliot', job: 'Baby' },
            { uname: 'Justi', job: 'Teacher' },
            { uname: 'Madric', job: 'No one' }
        ]
    }

    changeOutputs = (event) => {
        this.setState({
            outputs: [
                { uname: 'Elliot', job: 'Baby' },
                { uname: 'Justi', job: 'Teacher' },
                { uname: event.target.value, job: 'No one' }
            ]
            
        });
    }

    switchOutputs = () => {
        this.setState({
            outputs: [
                { uname: 'Justi', job: 'Teacher' },
                { uname: 'Elliot', job: 'Baby' },
                { uname: 'Madric', job: 'No one' }
            ]
            
        });
    }

    render() {
        return (
            <div className="App">
                <UserInput changeFunc={ this.changeOutputs } name={ this.state.outputs[2].uname } />
                <UserOutput uname={ this.state.outputs[0].uname } job={ this.state.outputs[0].job } />
                <UserOutput uname={ this.state.outputs[1].uname } job={ this.state.outputs[1].job } />
                <UserOutput uname={ this.state.outputs[2].uname } job={ this.state.outputs[2].job } >I am just a baby for the moment</UserOutput>
                <button onClick={ this.switchOutputs }>Permuter</button>
            </div>
        );
    }
}

export default App;
