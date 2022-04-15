import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import API from "../../API";

function ViewUser() {
    const { id } = useParams();

    const [user, setUser] = useState(undefined);
    const [groups, setGroups] = useState(undefined);
    const [selectedGroup, setSelectedGroup] = useState("-1");

    useEffect(()=>{
        fetchUser();
        fetchGroups();
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
    
    const fetchGroups = async () => {
        try {
            let response = await API.get("/v1/groups/all");

            if (typeof response.data.success === "boolean" && response.data.success === true) {
                let groups = (response.data.result || undefined);

                setGroups(groups);

                return;
            }

            setGroups(undefined);
        } catch (error) {
            if (error.response.status === 401) {
                setRedirectUrl("/sign-in");
            }

            setRedirectUrl("/");
        }
    };
    
    const attachUserToGroup = async () => {
        if (selectedGroup === "-1") {
            return;
        }

        try {
            await API.post(`/v1/users/${user.id}/group`, { group_id: selectedGroup });

            fetchUser();
        } catch (error) {
            if (error.response.status === 401) {
                setRedirectUrl("/sign-in");
            }
        }
    };

    return (
        typeof user !== "undefined"
        ? <div>
            <div className="mb-3">
                <label className="form-label">First name</label>
                <input type="text" name="first_name" defaultValue={user.first_name} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Last name</label>
                <input type="text" name="last_name" defaultValue={user.last_name} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Email</label>
                <input type="email" name="email" defaultValue={user.email} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Phone</label>
                <input type="text" name="phone" defaultValue={user.phone} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Age</label>
                <input type="text" name="age" defaultValue={user.age} className="form-control" readOnly/>
            </div>
            <div className="mb-3">
                <label className="form-label">Type</label>
                <input type="text" name="type" defaultValue={user.type} className="form-control" readOnly/>
            </div>
            {
                typeof groups !== "undefined" && groups.length > 0
                ? (
                    <div className="row mb-3">
                        <label className="form-label">Attach group</label>
                        <div className="col-md-10">
                            <select className="form-control" value={selectedGroup} onChange={(e) => setSelectedGroup(e.target.value)}>
                                <option value="-1">Select a group</option>
                                {
                                    (groups ?? []).map((group, index) => {
                                        return (<option value={group.id} key={index}>{group.name}</option>)
                                    })
                                }
                            </select>
                        </div>
                        <div className="col-md-2">
                            <button type="button" className="btn btn-primary" onClick={attachUserToGroup}>Attach</button>
                        </div>
                    </div>
                )
                : undefined
            }
            {
                typeof user.groups !== "undefined" && user.groups.length > 0
                ? (
                    <div className="mb-3">
                        <label className="form-label">User groups</label>
                        <ul className="mb-3">
                            {
                                (user.groups ?? []).map((group, index) => {
                                    return (<li key={index}>{group.name}</li>)
                                })
                            }
                        </ul>
                    </div>
                )
                : undefined
            }
        </div>
        : <div></div>
    )
}

export default ViewUser;