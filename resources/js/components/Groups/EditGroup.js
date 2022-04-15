import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import API from "../../API";
import NewGroup from "./NewGroup";

function EditGroup() {
    const { id } = useParams();

    const [group, setGroup] = useState(undefined);

    useEffect(()=>{
        fetchGroup();
    }, []);

    const fetchGroup = async () => {
        try {
            let response = await API.get(`/v1/groups/${id}`);

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