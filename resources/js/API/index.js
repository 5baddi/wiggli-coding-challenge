const API = axios.create({
    baseURL: "/api",
    headers: {
      Accepted: 'appication/json',
      'Content-Type': 'application/json',
    },
});
  
API.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem("token");
        if (typeof token === "string") {
            config.headers.authorization = `Bearer ${token}`;
        }

        return config;
    },
    (error) => Promise.reject(error),
);

export default API;