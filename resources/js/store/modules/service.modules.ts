import axios from "axios";
import { Service, ServiceState } from "../types/interface";

const state: ServiceState = {
    service: [],
    data: {
        id: 0,
        title: "",
        description: "",
        photo: ""
    }
};
const actions = {
    async createService({ commit }: any, args: FormData) {
        return await axios.post("/api/v1/service", args, {
            headers: {
                "Content-Type": "multipart/form-data",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: true,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 201 && status < 300
        });
    }
};
const mutations = {
    createService: (results: ServiceState, args: Service) =>
        results.service.unshift(args),
    destroyService: (results: ServiceState, args: number) =>
        (results.service = results.service.filter(function(x) {
            return x.id !== args;
        })),
    updateService: (results: ServiceState, args: Service) =>
        (results.service = results.service.map(x =>
            x.id === args.id ? args : x
        ))
};
const getters = {
    fetchService: (results: ServiceState) => results.service
};
export default {
    state,
    actions,
    mutations,
    getters
};
