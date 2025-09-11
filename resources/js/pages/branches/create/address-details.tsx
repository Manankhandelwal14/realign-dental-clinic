import { BranchFormRequest } from "@/types/branch";
import InputError from "@/components/input-error";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from "@/components/ui/collapsible";
import { ChevronsUpDown } from "lucide-react";

// Branch Address Details Component
interface AddressDetailsProps {
    data: BranchFormRequest;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    setData: (key: keyof BranchFormRequest, value: any) => void;
    errors: Partial<Record<keyof BranchFormRequest, string>>;
}


const AddressDetails: React.FC<AddressDetailsProps> = ({ data, setData, errors }) => {
    return (
        <Collapsible>
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between select-none">
                        <div>
                            <CardTitle>Branch Address Details</CardTitle>
                            <p className="mt-2 text-sm text-gray-500">Address and location details of the branch.</p>
                        </div>
                        <CollapsibleTrigger className="text-left flex items-center justify-between cursor-pointer border p-2 rounded-md">
                            <ChevronsUpDown size={16} />
                        </CollapsibleTrigger>
                    </div>
                </CardHeader>
                <CollapsibleContent className="border-t pt-5">
                    <CardContent className="space-y-2">
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <Label htmlFor="address" className="text-sm font-medium">Address</Label>
                                <Input
                                    type="text"
                                    id="address"
                                    name="address"
                                    value={data.address}
                                    onChange={(e) => setData('address', e.target.value)}
                                />
                                <InputError message={errors.address} className="mt-2" />
                            </div>
                            <div>
                                <Label htmlFor="district" className="text-sm font-medium">
                                    District
                                </Label>
                                <Input
                                    id="district"
                                    name="district"
                                    value={data.district}
                                    onChange={(e) => setData('district', e.target.value)}
                                    type="text"
                                />
                                <InputError message={errors.district} className="mt-2" />
                            </div>
                            <div>
                                <Label htmlFor="city" className="text-sm font-medium">
                                    City
                                </Label>
                                <Input
                                    id="city"
                                    name="city"
                                    value={data.city}
                                    onChange={(e) => setData('city', e.target.value)}
                                    type="text"
                                />
                                <InputError message={errors.city} className="mt-2" />
                            </div>
                            <div>
                                <Label htmlFor="state" className="text-sm font-medium">
                                    State
                                </Label>
                                <Input
                                    id="state"
                                    name="state"
                                    value={data.state}
                                    onChange={(e) => setData('state', e.target.value)}
                                    type="text"
                                />
                                <InputError message={errors.state} className="mt-2" />
                            </div>
                        </div>
                        <div>
                            <Label htmlFor="map_iframe" className="text-sm font-medium">
                                Map Iframe
                            </Label>
                            <Textarea
                                id="map_iframe"
                                name="map_iframe"
                                value={data.map_iframe}
                                onChange={(e) => setData('map_iframe', e.target.value)}
                                rows={4}
                            />
                            <InputError message={errors.map_iframe} className="mt-2" />
                        </div>
                    </CardContent>
                </CollapsibleContent>
            </Card>
        </Collapsible>
    );
};

export default AddressDetails;