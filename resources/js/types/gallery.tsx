export interface Gallery {
    id: string;
    title: string;
    caption: string | null;
    status: boolean;
    featured: boolean;
    order: number | null;
    image: string
}

export type GalleryRequestForm = {
    title: string
    caption: string
    status: boolean
    featured: boolean
    image: File | null;
}