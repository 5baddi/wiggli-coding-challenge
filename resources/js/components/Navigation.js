import {
    Routes,
    Route,
    Link,
    useLocation
} from "react-router-dom";
import SignIn from "./Auth/SignIn";
import Groups from "./Groups";
import DeleteGroup from "./Groups/DeleteGroup";
import EditGroup from "./Groups/EditGroup";
import NewGroup from "./Groups/NewGroup";
import ViewGroup from "./Groups/ViewGroup";
import Users from "./Users";
import DeleteUser from "./Users/DeleteUser";
import EditUser from "./Users/EditUser";
import NewUser from "./Users/NewUser";
import ViewUser from "./Users/ViewUser";

function Navigation() {
    const location = useLocation();

    return (
        <div className="card">
            <div className="card-header">
                <ul className="nav nav-pills nav-fill">
                    <li className="nav-item">
                        <Link className={"nav-link " + (location.pathname === "/" || location.pathname.includes("users") ? "active" : "")} to="/">Users</Link>
                    </li>
                    <li className="nav-item">
                        <Link className={"nav-link " + (location.pathname.includes("groups") ? "active" : "")} to="/groups">Groups</Link>
                    </li>
                </ul>
            </div>
            <div className="card-body">
                <Routes>
                    <Route exact path="/" element={<Users/>}></Route>
                    <Route exact path="/users/new" element={<NewUser/>}></Route>
                    <Route exact path="/users/edit/:id" element={<EditUser/>}></Route>
                    <Route exact path="/users/delete/:id" element={<DeleteUser/>}></Route>
                    <Route exact path="/users/view/:id" element={<ViewUser/>}></Route>
                    <Route exact path="/groups" element={<Groups/>}></Route>
                    <Route exact path="/groups/new" element={<NewGroup/>}></Route>
                    <Route exact path="/groups/edit/:id" element={<EditGroup/>}></Route>
                    <Route exact path="/groups/delete/:id" element={<DeleteGroup/>}></Route>
                    <Route exact path="/groups/view/:id" element={<ViewGroup/>}></Route>
                    <Route exact path="sign-in" element={<SignIn/>}></Route>
                </Routes>
            </div>
        </div>
    );
}

export default Navigation;