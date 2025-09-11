import { Meta } from "./meta";

export interface Team {
    id: string;
    name: string;
    slug: string;
    image: string | null;
    designation: string | null;
    sort_description: string | null;
    about: string | null;
    order: number | null;
    status: boolean;
    featured: boolean;
    branch_id: string | null;
    social_media: { platform: string; url: string }[] | null;
    branch?: { id: string; name: string };
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

export type TeamRequestForm = {
    name: string;
    designation: string;
    sort_description: string;
    status: boolean;
    featured: boolean;
    branch_id: string | null;
    image: File | null;
    social_media: {
        platform: string;
        url: string;
    }[];
}