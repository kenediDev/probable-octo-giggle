import axios from "axios";
import { UserState, User, Message } from "../types/interface";

const state: UserState = {
    user: [],
    data: {
        id: 0,
        name: "",
        email: "",
        password: ""
    },
    message: {
        message: "",
        valid: 0,
        loading: false
    }
};
const actions = {
    async login({ commit }: any, args: User) {
        return await axios.post("/api/v1/auth", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With"
            },
            timeout: 856000,
            responseType: "json",
            withCredentials: false,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async reset({ commit }: any, args: { token: string }) {
        return await axios.post("/api/v1/auth/reset/", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With"
            },
            timeout: 856000,
            responseType: "json",
            withCredentials: false,
            maxRedirects: 5,
            maxContentLength: 2000,
            maxBodyLength: 2000,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    }
};
const mutations = {
    message: (results: UserState, args: Message) => (results.message = args)
};
const getters = {
    message: (results: UserState) => results.message
};
export default {
    state,
    actions,
    mutations,
    getters
};
