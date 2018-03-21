const rewireMobX = require('react-app-rewire-mobx');
console.log("IN");
/* config-overrides.js */
module.exports = function override(config, env) {
    config = rewireMobX(config, env);
    return config;
}