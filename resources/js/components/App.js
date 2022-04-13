import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter as Router } from "react-router-dom";

import Navigation from "./Navigation";

function App() {
    return (
        <Router>
           <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <Navigation/>
                    </div>
                </div>
            </div>
       </Router>
    );
}

export default App;

if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}
