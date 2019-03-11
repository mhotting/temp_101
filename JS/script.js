const person = {
    name: "Max",
    age: 29,
    greet() {
        console.log("Hello I am " + this.name);
    }
}

const hobbies = ["Tennis", "BasketBall"];
const hobbies2 = hobbies.map(hobby => 'Hobby: ' + hobby);
console.log(hobbies);
console.log(hobbies2);