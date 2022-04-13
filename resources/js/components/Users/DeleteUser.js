import React, { useState, useEffect } from "react";
import { useLocation, Navigate } from "react-router-dom";
import API from "../../API";

function DeleteUser() {
    const location = useLocation();

    const [redirectUrl, setRedirectUrl] = useState(undefined);

    useEffect(()=>{
        deleteUser();
    }, []);

    const deleteUser = async () => {
        try {
            let response = await API.delete(`/v1${location.pathname.replace('/delete', '')}`);

            if (typeof response.status === 204) {
                setRedirectUrl("/");

                return;
            }

            setRedirectUrl(undefined);
        } catch (error) {
            if (error.response.status === 401) {
                setRedirectUrl("/sign-in");
            }

            setRedirectUrl("/");
        }
    };

    return (
        typeof redirectUrl === "string"
        ? (<Navigate to={redirectUrl}/>)
        : <div></div>
    )
}

export default DeleteUser;