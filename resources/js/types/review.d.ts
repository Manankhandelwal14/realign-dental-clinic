export interface Review {
    id: string;
    author: string;
    content: string | null;
    rating: number;
    status: boolean;
    featured: boolean;
    order: number | null;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
    service?: { id: string; name: string };
    user?: { id: string; name: string };
    image: string | null;
}

export type ReviewFormRequest = {
    author: string;
    content: string;
    rating: number;
    status: boolean;
    featured: boolean;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
}