import React, { Component } from 'react';
import ValidationComponent from './validationComponent/validationComponent';
import './App.css';

class App extends Component {
    state = {
        len: 0,
        stringGiven: '',
        stringArray: [],
        idArray: []
    }

    changeHandler = (event) => {
        let newIdArray = [...this.state.idArray];
        if (event.target.value.length > this.state.len) {
            newIdArray.push(Math.random());
        }
        if (event) {
            this.setState({
                len: event.target.value.length,
                stringGiven: event.target.value,
                stringArray: event.target.value.split(''),
                idArray: newIdArray
            })
        } else {
            this.setState({
                len: 0,
                stringGiven: '',
                stringArray: [],
                idArray: []
            })
        }
    }

    deleteHandler = (event, index) => {
        let newArray = [...this.state.stringArray];
        let newIdArray = [...this.state.idArray];
        newArray.splice(index, 1);
        this.setState({
            len: newArray.length,
            stringGiven: newArray.join(''),
            stringArray: newArray,
            idArray: newIdArray
        });
    }

    render() {
        let charString = null;
        if (this.state.len !== 0) {
            charString = (
                <div>
                    {this.state.stringArray.map((char, index) => {
                        return (
                            <div onClick={(event) => this.deleteHandler(event, index)} className="charString" key={this.state.idArray[index]}>
                                <p>{char}</p>
                            </div>
                        );
                    })}
                </div>
            );
        }
        return (
            <div className="App">
                <div>
                    <label htmlFor="stringInput">Saisir une chaine: </label>
                    <input type="text" onChange={this.changeHandler} id="stringInput" value={this.state.stringGiven} />
                </div>
                <div>
                    <p>{this.state.len}</p>
                </div>
                <ValidationComponent len={this.state.len} />
                {charString}
            </div>
        );
    }
}

export default App;
