import React, { useState } from "react";
import { Navigate } from "react-router-dom";
import API from "../../API";

function NewGroup(props) {
    const [formData, updateFormData] = useState({
        name: (props.group ? (props.group.name || "") : ""),
        description: (props.group ? (props.group.description || "") :  "")
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

        if (typeof props.group !== "undefined" && typeof props.group.id !== "undefined") {
            API.put(`/v1/groups/${props.group.id}`, formData)
                .then(() => {
                    setRedirectUrl("/groups");
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        setRedirectUrl("/sign-in")
                    }

                    alert(error.message);
                });

            return;
        }

        API.post("/v1/groups", formData)
            .then(() => {
                setRedirectUrl("/groups");
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
                    <label className="form-label">Name</label>
                    <input type="text" name="name" defaultValue={formData.name} className="form-control" onChange={handleChange}/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Description</label>
                    <textarea rows="5" className="form-control" name="description" defaultValue={formData.description} onChange={handleChange}></textarea>
                </div>
                <button type="button" className="btn btn-primary" onClick={handleSubmit}>Save</button>
            </form>
        )
        : (<Navigate to={redirectUrl}/>)
    );
}

export default NewGroup;