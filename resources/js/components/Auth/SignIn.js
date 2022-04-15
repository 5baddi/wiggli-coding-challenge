import React, { useState } from "react";
import { Navigate } from "react-router-dom";
import API from "../../API";

function SignIn() {
    const [formData, updateFormData] = useState({
        email: "",
        password: ""
    });
    
    const [redirectUrl, setRedirectUrl] = useState(undefined);

    const handleChange = (e) => {
        updateFormData({
          ...formData,
          [e.target.name]: e.target.value.trim()
        });
    };
    
    const handleSubmit = (e) => {
        e.preventDefault();

        API.post("/sign-in", formData)
            .then((response) => {
                if (typeof response.data.result.token === "string") {
                    setRedirectUrl("/");

                    window.localStorage.setItem("token", response.data.result.token);
                }
            })
            .catch((error) => {
                setRedirectUrl(undefined);

                alert(error.message);
            });
    };

    return (
        typeof redirectUrl === "undefined"
        ? (
            <form>
                <div className="mb-3">
                    <label className="form-label">Email</label>
                    <input type="email" name="email" defaultValue={formData.email} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Password</label>
                    <input type="password" name="password" defaultValue={formData.password} className="form-control" onChange={handleChange}/>
                </div>
                <button type="button" className="btn btn-primary" onClick={handleSubmit}>Sign In</button>
            </form>
        )
        : (<Navigate to={redirectUrl}/>)
    );
}

export default SignIn;