import React, { useEffect, useState } from "react";
import API from "../API";

const DEFAULT_PAGINATION = {
    current_page: 1,
    last_page: 1,
    total: 1,
    path: "#",
    prev_page_url: "#",
    next_page_url: "#",
};

function Datatable(props)
{
    const [values, setValues] = useState(undefined);
    const [result, setResult] = useState(DEFAULT_PAGINATION);

    useEffect(()=>{
        if (typeof props.endpoint === "string") {
            fetchUsers(props.endpoint);
        }
    }, []);

    const fetchUsers = async (endpoint) => {
        let response = await API.get(endpoint);

        if (typeof response.data.success === "boolean" && response.data.success === true) {
            let values = (response.data.result.data || []).map((item) => {
                let value = [];

                (props.fields || []).map((field) => {
                    if (typeof item[field] !== "undefined") {
                        value.push({
                            field,
                            value: item[field]
                        });
                    }
                });

                return value;
            });

            setValues(values);
            setResult(response.data.result || undefined);

            return;
        }

        setValues([]);
        setResult(DEFAULT_PAGINATION);
    };

    return (
        <div>
            <table className="table table-bordered mt-4">
                {
                    typeof props.headers === "object" ?
                    (
                        <thead>
                            <tr>
                                {
                                    Object.values(props.headers).map((header, key) => {
                                        return (<th scope="col" key={key}>{header.toUpperCase()}</th>);
                                    })
                                }
                            </tr>
                        </thead>
                    ) : undefined
                }
                <tbody>
                {
                    typeof values === "object" && values.length > 0 ?
                    (
                        
                        Object.values(values).map((value, key) => {
                            return (
                                <tr key={key}>
                                    {
                                        Object.values(value).map((row, index) => {
                                            return (<td key={index}>{ row.value || '---'}</td>);
                                        })
                                    }
                                    {
                                        props.actions
                                        ? <td>
                                            {
                                                (props.actions ?? []).map((button, index) => {
                                                    let url = "#";
                                                    let id = value.find((val) => val.field === "id");

                                                    if (typeof button.url === "string" && typeof id !== "undefined") {
                                                        url = button.url.replace("{id}", id.value);
                                                    }

                                                    return (
                                                        <a key={index} href={url} style={{ marginRight: "4px" }} className={"btn btn-sm " + (button.class || "btn-primary")}>{(button.label || "").toUpperCase()}</a>
                                                    )
                                                })
                                            }
                                        </td>
                                        : undefined
                                    }
                                </tr>
                            )
                        })
                    )
                    : (
                        <tr>
                            <td colSpan={props.headers ? props.headers.length : 1} className="text-center">No record found!</td>
                        </tr>
                    )
                }
                </tbody>
            </table>
            {
                typeof values === "object" && values.length > 0
                ? (
                    <ul className="pagination justify-content-end">
                        <li tabIndex="-1" className={"page-item " + ((result.current_page > 1) ? "" : "disabled")}>
                            <a className="page-link" href="#" onClick={() => fetchUsers(result.prev_page_url)}>Previous</a>
                        </li>
                        {
                            (result.links || []).map(function (link, index) {
                                if (link.label.includes('Previous') || link.label.includes('Next')) {
                                    return;
                                }

                                return (
                                    <li className={"page-item " + ((link.active === true) ? "active" : "")} key={index}>
                                        <a className="page-link" href="#" onClick={() => fetchUsers(link.url)}>{link.label}</a>
                                    </li>
                                );
                            })
                        }
                        <li className={"page-item " + ((result.current_page < result.last_page) ? "" : "disabled")}>
                            <a className="page-link" href="#" onClick={() => fetchUsers(result.next_page_url)}>Next</a>
                        </li>
                    </ul>
                )
                : undefined
            }
        </div>
    );
}

export default Datatable;