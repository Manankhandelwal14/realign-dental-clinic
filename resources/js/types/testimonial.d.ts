export interface Testimonial {
    id: string;
    author: string;
    caption: string;
    status: boolean;
    featured: boolean;
    order: number | null;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
    service?: { id: string; name: string };
    user?: { id: string; name: string };
    video: string | null;
    poster: string | null;
}


export type TestimonialFormRequest = {
    author: string;
    caption: string;
    status: boolean;
    featured: boolean;
    order: number | null;
    service_id: string | null;
    user_id: string | null;
    date: string | null;
    video: File | null;
    poster: File | null;
}