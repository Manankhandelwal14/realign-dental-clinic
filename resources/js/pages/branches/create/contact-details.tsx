import InputError from "@/components/input-error";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from "@/components/ui/collapsible";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { BranchFormRequest } from "@/types/branch";
import { ChevronsUpDown } from "lucide-react";

interface ContactDetailsProps {
    data: BranchFormRequest;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    setData: (key: keyof BranchFormRequest, value: any) => void;
    errors: Partial<Record<keyof BranchFormRequest, string>>;
}

const ContactDetails: React.FC<ContactDetailsProps> = ({ data, setData, errors }) => {
    return (
        <Collapsible>
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between select-none">
                        <div>
                            <CardTitle>Branch Contact Details</CardTitle>
                            <p className="text-sm text-gray-500">Contact details of the branch.</p>
                        </div>
                        <CollapsibleTrigger className="text-left flex items-center justify-between cursor-pointer border p-2 rounded-md">
                            <ChevronsUpDown size={16} />
                        </CollapsibleTrigger>
                    </div>
                </CardHeader>
                <CollapsibleContent className="border-t pt-5">
                    <CardContent>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <Label htmlFor="phone" className="text-sm font-medium">
                                    Phone
                                </Label>
                                <Input
                                    id="phone"
                                    name="phone"
                                    value={data.phone}
                                    onChange={(e) => setData('phone', e.target.value)}
                                    type="text"
                                />
                                <InputError message={errors.phone} className="mt-2" />
                            </div>
                            <div>
                                <Label htmlFor="email" className="text-sm font-medium">
                                    Email
                                </Label>
                                <Input
                                    id="email"
                                    name="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    type="email"
                                />
                                <InputError message={errors.email} className="mt-2" />
                            </div>
                        </div>
                        <div>
                            <Label htmlFor="website" className="text-sm font-medium">
                                Website
                            </Label>
                            <Input
                                id="website"
                                name="website"
                                value={data.website}
                                onChange={(e) => setData('website', e.target.value)}
                                type="text"
                            />
                            <InputError message={errors.website} className="mt-2" />
                        </div>
                    </CardContent>
                </CollapsibleContent>
            </Card>
        </Collapsible>
    );
};

export default ContactDetails;