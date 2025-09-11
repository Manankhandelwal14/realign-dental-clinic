export interface Feature {
    id: string;
    title: string;
    description: string | null;
    status: boolean;
    featured: boolean;
    order: number | null;
}