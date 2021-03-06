export interface ListCoverInformation {
    id: number;
    name: string;
    description: string;
    cover_information?: CoverInformation;
}

export interface CoverInformation {
    id: number;
    title: string;
    child_title: string;
    description: string;
    list_cover_information?: ListCoverInformation[];
}

export interface Message {
    message: string;
    valid: number;
    loading: boolean;
}

export interface Background {
    id: number;
    background: string;
}

export interface Accounts {
    id: number;
    first_name: string;
    last_name: string;
    description: string;
    logo: string;
    background: Background[];
    title_service?: string;
    animation_service: boolean;
    cover_information?: CoverInformation;
}

export interface Service {
    id: number;
    title: string;
    description: string;
    photo: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    password: string;
    accounts?: Accounts;
    background_list?: any[];
    service?: Service[];
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

export interface UserBackgroundList {
    data: {
        background_list: any[];
    };
}

export interface InformationState {
    information: ListCoverInformation[];
    data: ListCoverInformation;
}
