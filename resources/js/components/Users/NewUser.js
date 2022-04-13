import React, { useState } from "react";
import { Navigate } from "react-router-dom";
import API from "../../API";

function NewUser(props) {
    const [formData, updateFormData] = useState({
        first_name: (props.user ? (props.user.first_name || "") : ""),
        last_name: (props.user ? (props.user.last_name || "") : ""),
        email: (props.user ? (props.user.email || "") : ""),
        age: (props.user ? (props.user.age || "") : ""),
        type: (props.user ? (props.user.type || "") : ""),
        phone: (props.user ? (props.user.phone || "") : ""),
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

        if (typeof props.user !== "undefined" && typeof props.user.id !== "undefined") {
            API.put(`/v1/users/${props.user.id}`, formData)
                .then(() => {
                    setRedirectUrl("/");
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        setRedirectUrl("/sign-in")
                    }

                    alert(error.message);
                });

            return;
        }

        API.post("/v1/users", formData)
            .then(() => {
                setRedirectUrl("/");
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    setRedirectUrl("/sign-in")
                }

                alert(error.message);
            });
    };

    return (
        typeof redirectUrl === "undefined"
        ? (
            <form>
                <div className="mb-3">
                    <label className="form-label">First name</label>
                    <input type="text" name="first_name" defaultValue={formData.first_name} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Last name</label>
                    <input type="text" name="last_name" defaultValue={formData.last_name} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Email</label>
                    <input type="email" name="email" defaultValue={formData.email} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Phone</label>
                    <input type="text" name="phone" defaultValue={formData.phone} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Age</label>
                    <input type="text" name="age" defaultValue={formData.age} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Type</label>
                    <input type="text" name="type" defaultValue={formData.type} className="form-control" onChange={handleChange}/>
                </div>
                <button type="button" className="btn btn-primary" onClick={handleSubmit}>Save</button>
            </form>
        )
        : (<Navigate to={redirectUrl}/>)
    );
}

export default NewUser;