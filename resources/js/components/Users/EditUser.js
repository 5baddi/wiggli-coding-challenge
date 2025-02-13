import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import API from "../../API";
import NewUser from "./NewUser";

function EditUser() {
    const { id } = useParams();

    const [user, setUser] = useState(undefined);

    useEffect(()=>{
        fetchUser();
    }, []);

    const fetchUser = async () => {
        try {
            let response = await API.get(`/v1/users/${id}`);

            if (typeof response.data.success === "boolean" && response.data.success === true) {
                let user = (response.data.result || undefined);

                setUser(user);

                return;
            }

            setUser(undefined);
        } catch (error) {
            if (error.response.status === 401) {
                setRedirectUrl("/sign-in");
            }

            setRedirectUrl("/");
        }
    };

    return (
        typeof user !== "undefined"
        ? <NewUser user={user}/>
        : <div></div>
    )
}

export default EditUser;