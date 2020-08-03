require("jsdom-global")();

let jsdom = require("jsdom-global")(undefined, {
    url: "http://rcps.test/panel",
});
