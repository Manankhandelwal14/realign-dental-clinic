import { Meta } from "./meta";
import { Service } from "./service";
import { Team } from "./team";

export interface Branch {
    id: string;
    name: string;
    slug: string;
    banner: string | null;
    tagline: string;
    address: string;
    district: string;
    city: string;
    state: string;
    map_iframe: string;
    opening_hours: {
        day: string;
        slots: {
            opening: string;
            closing: string;
        }[];
    }[];
    phone: string;
    email: string;
    website: string;
    status: boolean;
    featured: boolean;
    order: number | null;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
    content?: {
        id: string;
        branch_id: string;
        html: string;
        content: json;
        created_at: string;
        updated_at: string;
    },
    teams?: Team[];
    services?: Service[];
    meta?: Meta;
}

export type BranchFormRequest = {
    name: string;
    tagline: string;
    address: string;
    district: string;
    city: string;
    state: string;
    map_iframe: string;
    opening_hours: {
        day: string;
        slots: {
            opening: string;
            closing: string;
        }[];
    }[];
    phone: string;
    email: string;
    website: string;
    status: boolean;
    featured: boolean;
    banner: File | null;
}