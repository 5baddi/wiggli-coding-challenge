import React, { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import API from "../../API";
import NewGroup from "./NewGroup";

function EditGroup() {
    const location = useLocation();

    const [group, setGroup] = useState(undefined);

    useEffect(()=>{
        fetchGroup();
    }, []);

    const fetchGroup = async () => {
        try {
            let response = await API.get(`/v1${location.pathname.replace('/edit', '')}`);

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
        ? <NewGroup group={group}/>
        : <div></div>
    )
}

export default EditGroup;