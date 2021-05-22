import axios, { AxiosResponse } from "axios";
import {
    UserState,
    User,
    Message,
    Background,
    Service
} from "../types/interface";

const state: UserState = {
    user: [],
    data: {
        id: 0,
        name: "",
        email: "",
        password: "",
        background_list: [],
        service: []
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
    },
    async loadMe({ commit }: any) {
        return await axios
            .get("/api/v1/auth/me", {
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Methods": "GET",
                    "Access-Control-Allow-Headers":
                        "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                    "Access-Control-Allow-Origin": "*",
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                },
                timeout: 865000,
                responseType: "json",
                withCredentials: true,
                maxBodyLength: 2000,
                maxContentLength: 2000,
                maxRedirects: 5,
                validateStatus: (status: number) =>
                    status >= 200 && status < 300
            })
            .then((res: AxiosResponse<any>) => {
                commit("me", res.data);
            });
    },
    async addBackground({ commit }: any, args: FormData) {
        return await axios.post("/api/v1/auth/background", args, {
            headers: {
                "Content-Type": "multipart/form-data",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                "Access-Control-Allow-Origin": "*",
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
    async destroyBackground({ commit }: any, args: number) {
        return await axios.delete(`/api/v1/auth/background/${args}`, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "DELETE",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With, Authorization",
                "Access-Control-Allow-Origin": "*",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: true,
            maxRedirects: 5,
            maxContentLength: 2000,
            maxBodyLength: 2000,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async updateProfile({ commit: any }, args: FormData) {
        return await axios.post("/api/v1/auth/update/profile", args, {
            headers: {
                "Content-Type": "multipart/form-data",
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
    },
    async activeAnimation(
        { commit }: any,
        args: { type: string; active: boolean }
    ) {
        return await axios.post("/api/v1/auth/animation/", args, {
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
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    }
};
const mutations = {
    message: (results: UserState, args: Message) => (results.message = args),
    me: (results: UserState, args: User) => {
        const array: any[] = [];
        for (let i = 0; i < args.accounts.background.length; i++) {
            array.push(i);
        }
        results.data = {
            id: args.id,
            name: args.name,
            email: args.email,
            password: args.password,
            accounts: args.accounts,
            background_list: array,
            service: args.service
        };
    },
    updateBackground: (results: UserState, args: Background) => {
        results.data.accounts.background.unshift(args);
        const sync: any[] = [];
        for (let i = 0; i < results.data.accounts.background.length; i++) {
            sync.push(i);
        }
        results.data.background_list = sync;
    },
    destroyBackground: (results: UserState, args: number) => {
        results.data.accounts.background = results.data.accounts.background.filter(
            function(x) {
                return x.id !== args;
            }
        );
        const sync = [];
        for (let i = 0; i < results.data.accounts.background.length; i++) {
            sync.push(i);
        }
        results.data.background_list = sync;
    },
    updateProfile: (results: UserState, args: User) => {
        results.data.accounts.logo = args.accounts.logo;
    },
    updateActiveProfile: (results: UserState, args: User) => {
        results.data.accounts.animation_service =
            args.accounts.animation_service;
    },
    // Service Crud
    createService: (results: UserState, args: Service) => {
        results.data.service.unshift(args);
    },
    destroyService: (results: UserState, args: number) =>
        (results.data.service = results.data.service.filter(function(x) {
            return x.id !== args;
        })),
    updateService: (results: UserState, args: Service) => {
        results.data.service = results.data.service.map(x =>
            x.id === args.id ? args : x
        );
    },
    updateServiceTitle: (results: UserState, args: User) => {
        results.data.accounts = args.accounts;
    }
};
const getters = {
    message: (results: UserState) => results.message,
    me: (results: UserState) => results.data
};
export default {
    state,
    actions,
    mutations,
    getters
};
