import { BranchFormRequest } from "@/types/branch";
import InputError from "@/components/input-error";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

interface BranchInfoProps {
    data: BranchFormRequest;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    setData: (key: keyof BranchFormRequest, value: any) => void;
    errors: Partial<Record<keyof BranchFormRequest, string>>;
}

const BasicInfo: React.FC<BranchInfoProps> = ({ data, setData, errors }) => {
    return (
        <Card>
            <CardHeader>
                <CardTitle>Branch Info</CardTitle>
                <p className="mt-2 text-sm text-gray-500">Basic information about the branch.</p>
            </CardHeader>
            <CardContent className="space-y-2">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <Label htmlFor="name" className="text-sm font-medium">
                            Name
                        </Label>
                        <Input
                            id="name"
                            type="text"
                            name="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                        />
                        <InputError message={errors.name} className="mt-2" />
                    </div>
                    <div>
                        <Label htmlFor="tagline" className="text-sm font-medium">
                            Tagline
                        </Label>
                        <Input
                            id="tagline"
                            type="text"
                            name="tagline"
                            value={data.tagline}
                            onChange={(e) => setData('tagline', e.target.value)}
                        />
                        <InputError message={errors.tagline} className="mt-2" />
                    </div>
                </div>
            </CardContent>
        </Card>
    );
};

export default BasicInfo;