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

export interface UserState {
    user: User[];
    data: User;
    message: Message;
}
