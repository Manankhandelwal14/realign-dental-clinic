import { Meta } from "./meta";

export interface Service {
    id: string;
    name: string;
    slug: string;
    price: number | null;
    sort_description: string;
    branch_id: string;
    category_id: string;
    featured: boolean;
    status: boolean;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
    banner: string;
    order: number;
    branch: {
        id: string;
        name: string;
    };
    category: {
        id: string;
        name: string;
    };
    content?: {
        id: string;
        branch_id: string;
        html: string;
        content: json;
        created_at: string;
        updated_at: string;
    },
    meta?: Meta;
}

export type ServiceRequestForm = {
    name: string;
    sort_description: string;
    price: number | null;
    status: boolean;
    featured: boolean;
    category_id: string | null;
    branch_id: string | null;
    banner: File | null;
}