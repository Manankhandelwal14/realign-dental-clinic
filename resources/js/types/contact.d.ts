export interface Contact {
    id: string;
    website: string | null;
    phone: string | null;
    email: string | null;
    whatsapp: string | null;
    facebook: string | null;
    twitter: string | null;
    instagram: string | null;
    linkedin: string | null;
    youtube: string | null;
    street: string | null;
    city: string | null;
    state: string | null;
    zip: string | null;
    country: string | null;
    google_map_iframe: string | null;
    opening_hours: {
        day: string;
        slots: {
            opening: string;
            closing: string;
        }[];
    }[];
}