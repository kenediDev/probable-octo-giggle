import axios from "axios";
import { InformationState, ListCoverInformation } from "../types/interface";

const state: InformationState = {
    information: [],
    data: {
        id: 0,
        name: '',
        description: ""
    }
};
const actions = {
    async createListInformation({ commit }: any, args: ListCoverInformation) {
        return await axios.post("/api/v1/information", args, {
            headers: {
                "Content-Type": "application/json",
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
    },
    async destroyListInformation({ commit }: any, args: number) {
        return await axios.delete(`/api/v1/information/${args}`, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "DELETE",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 856000,
            responseType: "json",
            withCredentials: true,
            maxRedirects: 5,
            maxContentLength: 2000,
            maxBodyLength: 2000,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async updateListInformation(
        { commit }: any,
        args: { id: number; description: string }
    ) {
        return await axios.post(`/api/v1/information/${args.id}/`, args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 856000,
            responseType: "json",
            withCredentials: true,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    }
};
const mutations = {};
const getters = {};
export default {
    state,
    actions,
    mutations,
    getters
};
