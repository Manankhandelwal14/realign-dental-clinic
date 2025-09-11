export interface Reel {
    id: string;
    title: string;
    caption: string | null;
    status: boolean;
    featured: boolean;
    order: number | null;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
    video: string;
    poster: string;
    service?: { id: string; name: string };
    user?: { id: string; name: string };
}

export type ReelFormRequest = {
    title: string;
    caption: string;
    status: boolean;
    featured: boolean;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
    video: File | null;
    poster: File | null;
}