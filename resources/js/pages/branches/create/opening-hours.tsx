import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from "@/components/ui/collapsible";
import { Input } from "@/components/ui/input";
import { BranchFormRequest } from "@/types/branch";
import { ChevronsUpDown, Trash } from "lucide-react";

interface OpeningHoursProps {
    data: BranchFormRequest;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    setData: (key: keyof BranchFormRequest, value: any) => void;
    errors: Partial<Record<keyof BranchFormRequest, string>>;
}

const OpeningHours: React.FC<OpeningHoursProps> = ({ data, setData, errors }) => {
    return (
        <Collapsible>
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between select-none">
                        <div>
                            <CardTitle>Branch Opening Hours</CardTitle>
                            <p className="text-sm text-gray-500">Opening hours details of the branch.</p>
                        </div>
                        <CollapsibleTrigger className="text-left flex items-center justify-between cursor-pointer border p-2 rounded-md">
                            <ChevronsUpDown size={16} />
                        </CollapsibleTrigger>
                    </div>
                </CardHeader>
                <CollapsibleContent className="border-t pt-5">
                    <CardContent className="space-y-4">
                        {data.opening_hours.map((dayItem, dayIndex) => (
                            <div key={dayIndex} className="border-b space-y-2">
                                <div className="flex items-center gap-2">
                                    <Input
                                        type="text"
                                        placeholder="Day (e.g., Monday)"
                                        value={dayItem.day}
                                        onChange={(e) => {
                                            const updated = [...data.opening_hours];
                                            updated[dayIndex].day = e.target.value;
                                            setData('opening_hours', updated);
                                        }}
                                    />
                                    <Button
                                        variant="destructive"
                                        size="sm"
                                        onClick={() => {
                                            const updated = data.opening_hours.filter((_, i) => i !== dayIndex);
                                            setData('opening_hours', updated);
                                        }}
                                    >
                                        <Trash className="h-4 w-4" />
                                    </Button>
                                </div>
                                <h6 className="text-sm font-medium">Slots</h6>
                                {dayItem.slots.map((slot, slotIndex) => (
                                    <div key={slotIndex} className="flex gap-2">
                                        <Input
                                            type="time"
                                            value={slot.opening}
                                            onChange={(e) => {
                                                const updated = [...data.opening_hours];
                                                updated[dayIndex].slots[slotIndex].opening = e.target.value;
                                                setData('opening_hours', updated);
                                            }}
                                        />
                                        <Input
                                            type="time"
                                            value={slot.closing}
                                            onChange={(e) => {
                                                const updated = [...data.opening_hours];
                                                updated[dayIndex].slots[slotIndex].closing = e.target.value;
                                                setData('opening_hours', updated);
                                            }}
                                        />
                                        <Button
                                            variant="outline"
                                            size="sm"
                                            onClick={() => {
                                                const updated = [...data.opening_hours];
                                                updated[dayIndex].slots = updated[dayIndex].slots.filter((_, i) => i !== slotIndex);
                                                setData('opening_hours', updated);
                                            }}
                                        >
                                            <Trash className="h-4 w-4" />
                                        </Button>
                                    </div>
                                ))}
                                <Button
                                    variant="secondary"
                                    size="sm"
                                    onClick={() => {
                                        const updated = [...data.opening_hours];
                                        updated[dayIndex].slots.push({ opening: '', closing: '' });
                                        setData('opening_hours', updated);
                                    }}
                                >
                                    Add Slot
                                </Button>
                            </div>
                        ))}
                        {errors.opening_hours && <InputError message={errors.opening_hours} className="mt-2" />}
                        <Button
                            variant="outline"
                            type="button"
                            onClick={() =>
                                setData('opening_hours', [
                                    ...data.opening_hours,
                                    { day: '', slots: [{ opening: '', closing: '' }] },
                                ])
                            }
                        >
                            Add Day
                        </Button>
                    </CardContent>
                </CollapsibleContent>
            </Card>
        </Collapsible>
    );
};

export default OpeningHours;