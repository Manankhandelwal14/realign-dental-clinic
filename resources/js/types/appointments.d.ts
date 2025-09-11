export type Appointment = {
    id: string;
    name: string;
    phone: string;
    date: string;
    time: string;
    problem_description: string;
    status: "pending" | "approved" | "rejected";
    ip: string | null;
    created_at: string;
    updated_at: string;
}

export type AppointmentFormRequest = {
    name: string;
    phone: string;
    date: string;
    time: string;
    problem_description: string;
}