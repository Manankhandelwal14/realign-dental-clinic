import { Meta } from "./meta";
import { Service } from "./service";

export interface Category {
    id: string;
    name: string;
    slug: string;
    sort_description: string | null;
    description: string | null;
    status: boolean;
    featured: boolean;
    deleted_at: string | null;
    created_at: string;
    updated_at: string;
    order: number | null;
    parent_id: string | null;
    branch_id: string | null;
    branch?: { id: string; name: string };
    parent?: { id: string; name: string };
    banner: string | null;
    services: Service[];
    meta?: Meta;
}

export type CategoryRequestForm = {
    name: string;
    sort_description: string;
    description: string;
    status: boolean;
    featured: boolean;
    parent_id: string | null;
    banner: File | null;
}