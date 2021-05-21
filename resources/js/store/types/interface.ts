export interface Message {
    message: string;
    valid: number;
    loading: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    password: string;
}

export interface Service {
    id: number;
    title: string;
    description: string;
    photo: string;
}

export interface UserState {
    user: User[];
    data: User;
    message: Message;
}

export interface ServiceState {
    service: Service[];
    data: Service;
}
