import Datatable from "../Datatable";
import { Link } from "react-router-dom";

function Groups() {
    return (
        <div>
            <Datatable endpoint="/v1/groups"
                headers={["id", "name", "description"]}
                fields={["id", "name", "description"]}
                actions={[
                    {
                        label: "view",
                        url: "/groups/view/{id}",
                        class: "btn-success"
                    },
                    {
                        label: "edit",
                        url: "/groups/edit/{id}"
                    },
                    {
                        label: "delete",
                        url: "/groups/delete/{id}",
                        class: "btn-danger"
                    }
                ]}/>
            <div className="d-grid gap-2 d-md-flex justify-content-md-start">
                <Link className="btn btn-primary" to="/groups/new">Create group</Link>
            </div>
        </div>
    );
}

export default Groups;