import Datatable from "../Datatable";
import { Link } from "react-router-dom";

function Users() {
    return (
        <div className="row">
            <Datatable endpoint="/v1/users"
                headers={["id", "first name", "last name", "email", "age", "type"]}
                fields={["id", "first_name", "last_name", "email", "age", "type"]}
                actions={[
                    {
                        label: "view",
                        url: "/users/view/{id}",
                        class: "btn-success"
                    },
                    {
                        label: "edit",
                        url: "/users/edit/{id}"
                    },
                    {
                        label: "delete",
                        url: "/users/delete/{id}",
                        class: "btn-danger"
                    }
                ]}/>
            <div className="d-grid gap-2 d-md-flex justify-content-md-start">
                <Link className="btn btn-primary" to="/users/new">Create user</Link>
            </div>
        </div>
    );
}

export default Users;