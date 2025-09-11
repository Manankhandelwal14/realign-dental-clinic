export interface Faq {
    id: string;
    question: string;
    answer: string;
    status: boolean;
    featured: boolean;
    order: number | null;
}