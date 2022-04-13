import React, { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import API from "../../API";

function ViewGroup() {
    const location = useLocation();

    const [group, setGroup] = useState(undefined);

    useEffect(()=>{
        fetchGroup();
    }, []);

    const fetchGroup = async () => {
        try {
            let response = await API.get(`/v1${location.pathname.replace('/view', '')}`);

            if (typeof response.data.success === "boolean" && response.data.success === true) {
                let group = (response.data.result || undefined);

                setGroup(group);

                return;
            }

            setGroup(undefined);
        } catch (error) {
            if (error.response.status === 401) {
                setRedirectUrl("/sign-in");
            }

            setRedirectUrl("/groups");
        }
    };

    return (
        typeof group !== "undefined"
        ? <div>
            <div className="mb-3">
                <label className="form-label">Name</label>
                <input type="text" name="name" defaultValue={group.name} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Description</label>
                <textarea rows="5" className="form-control" name="description" defaultValue={group.description} readOnly></textarea>
            </div>
        </div>
        : <div></div>
    )
}

export default ViewGroup;