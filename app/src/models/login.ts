import type {UserInformation} from '.'

export type Login = {
    email: string
    password: string
}

export type LoginResponse = {
    data: {
        accessToken: string
    }
}

export type Logged = {
    user?: UserInformation
    accessToken: string
}
