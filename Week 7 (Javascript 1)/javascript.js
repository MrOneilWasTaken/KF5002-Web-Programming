"use strict";
const age = prompt("How old are you");
let graduationAge = parseInt(age) + 2;
document.write(`<p>You will graduate from <a href='http://www.northumbria.ac.uk'>Northumbria University</a> when you are ${graduationAge}</p>`);
console.log(typeof age);
console.log(typeof graduationAge);