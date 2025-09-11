export interface Callback {
    id: string;
    name: string;
    phone: string;
    time: string | null;
    user_agent: string | null;
    ip: string | null;
    status: 'pending' | 'completed' | 'failed';
    created_at: string;
    deleted_at: string | null;
}