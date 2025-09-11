export interface BeforeAfter {
    id: string;
    title: string;
    description: string | null;
    before_image: string | null;
    after_image: string | null;
    status: boolean;
    featured: boolean;
    order: number | null;
    content?: {
        id: string;
        branch_id: string;
        html: string;
        content: string;
        created_at: string;
        updated_at: string;
    };
}

export type BeforeAfterFormRequest = {
    title: string;
    description: string;
    before_image: File | null;
    after_image: File | null;
    status: boolean;
    featured: boolean;
}