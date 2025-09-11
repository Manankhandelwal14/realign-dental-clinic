import { Button } from '@/components/ui/button'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { useForm } from "@inertiajs/react";
import { Callback } from '@/types/callback';
import { toast } from 'sonner';



interface ChangeStatusProps {
    callback: Callback
}

const ChangeStatus = ({ callback }: ChangeStatusProps) => {

    const { setData, post } = useForm({
        status: "",
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route("admin.callbacks.status.update", callback.id), {
            onSuccess: () => {
                toast.success("Status updated successfully");
            }
        });
    };

    return (
        <Popover>
            <PopoverTrigger asChild>
                <Button variant="outline" className='uppercase'>{callback.status}</Button>
            </PopoverTrigger>
            <PopoverContent className="w-80">
                <div className="grid gap-4">
                    <div className="space-y-2">
                        <h4 className="font-medium leading-none">Select Status</h4>
                        <p className="text-sm text-muted-foreground">
                            Choose a status for the callback. This will help you manage your callbacks more effectively.
                        </p>
                    </div>
                    <form className="grid gap-2" onSubmit={handleSubmit}>
                        <Label htmlFor="status">Select Status</Label>
                        <Select onValueChange={(value) => setData("status", value)}>
                            <SelectTrigger className="w-full">
                                <SelectValue placeholder="Select status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="pending">Pending</SelectItem>
                                <SelectItem value="completed">Completed</SelectItem>
                                <SelectItem value="failed">Failed</SelectItem>
                            </SelectContent>
                        </Select>
                        <div className="mt-3 flex justify-end">
                            <Button>Update Status</Button>
                        </div>
                    </form>
                </div>
            </PopoverContent>
        </Popover>
    )
}

export default ChangeStatus