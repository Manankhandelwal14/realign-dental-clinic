import React, { useState } from 'react';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Label } from './ui/label';
import { Input } from './ui/input';
import { Button } from './ui/button';
import { useForm } from '@inertiajs/react';
import { Meta } from '@/types/meta';
import InputError from './input-error';
import { Badge } from './ui/badge';
import { Trash2, X } from 'lucide-react';

interface MetaDetailsProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
    route: string;
    meta: Meta | null;
}

const MetaDetailsPopup: React.FC<MetaDetailsProps> = ({ open, onOpenChange, route, meta }) => {
    const { post, errors, processing, data, setData } = useForm({
        title: meta?.title || '',
        description: meta?.description || '',
        keywords: meta?.keywords || [],
        tags: meta?.tags || [{ key: '', value: '' }],
        canonical_url: meta?.canonical_url || '',
    });

    const [keywordInput, setKeywordInput] = useState('');

    const handleKeywordKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === ',' && keywordInput.trim()) {
            e.preventDefault();
            setData('keywords', [...data.keywords, keywordInput.trim()]);
            setKeywordInput('');
        }
    };

    const removeKeyword = (index: number) => {
        setData('keywords', data.keywords.filter((_, i) => i !== index));
    };

    const addTagInput = () => {
        setData('tags', [...data.tags, { key: '', value: '' }]);
    };

    const updateTag = (index: number, field: 'key' | 'value', value: string) => {
        const newTags = [...data.tags];
        newTags[index][field] = value;
        setData('tags', newTags);
    };

    const removeTag = (index: number) => {
        setData('tags', data.tags.filter((_, i) => i !== index));
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route, {
            onSuccess: () => {
                onOpenChange(false);
            }
        });
    };

    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogContent className="sm:max-w-[600px] p-6">
                <DialogHeader>
                    <DialogTitle className="text-xl font-semibold">Edit Meta Details</DialogTitle>
                </DialogHeader>
                <form onSubmit={handleSubmit} className="space-y-2">
                    <div>
                        <Label htmlFor="title" className="text-sm font-medium">Meta Title</Label>
                        <Input
                            id="title"
                            value={data.title}
                            onChange={(e) => setData('title', e.target.value)}
                            className="mt-1"
                            placeholder="Enter meta title"
                        />
                        {errors.title && <InputError message={errors.title} className="mt-2" />}
                    </div>

                    <div>
                        <Label htmlFor="description" className="text-sm font-medium">Meta Description</Label>
                        <Input
                            id="description"
                            value={data.description}
                            onChange={(e) => setData('description', e.target.value)}
                            className="mt-1"
                            placeholder="Enter meta description"
                        />
                        {errors.description && <InputError message={errors.description} className="mt-2" />}
                    </div>

                    <div>
                        <Label htmlFor="keywords" className="text-sm font-medium">Meta Keywords</Label>
                        <Input
                            id="keywords"
                            value={keywordInput}
                            onChange={(e) => setKeywordInput(e.target.value)}
                            onKeyDown={handleKeywordKeyDown}
                            className="mt-1"
                            placeholder="Type keyword and press comma"
                        />
                        <div className="flex flex-wrap gap-2 mt-2">
                            {data.keywords.map((keyword, index) => (
                                <Badge key={index} variant="outline">
                                    {keyword}
                                    <span className='cursor-pointer' onClick={() => removeKeyword(index)}>
                                        <X className="h-4 w-4" />
                                    </span>
                                </Badge>
                            ))}
                        </div>
                        {errors.keywords && <InputError message={errors.keywords} className="mt-2" />}
                    </div>

                    <div>
                        <Label className="text-sm font-medium">Meta Tags</Label>
                        {data.tags.map((tag, index) => (
                            <div key={index} className="flex gap-2 mt-2">
                                <Input
                                    value={tag.key}
                                    onChange={(e) => updateTag(index, 'key', e.target.value)}
                                    placeholder="Key"
                                    className="flex-1"
                                />
                                <Input
                                    value={tag.value}
                                    onChange={(e) => updateTag(index, 'value', e.target.value)}
                                    placeholder="Value"
                                    className="flex-1"
                                />
                                {data.tags.length > 1 && (
                                    <Button
                                        type="button"
                                        variant="outline"
                                        onClick={() => removeTag(index)}
                                        className="text-red-600 hover:text-red-800"
                                    >
                                        <Trash2 />
                                    </Button>
                                )}
                            </div>
                        ))}
                        <Button className='mt-2' type="button" variant="outline" onClick={addTagInput}>Add Tag</Button>
                        {errors.tags && <InputError message={errors.tags} className="mt-2" />}
                    </div>

                    <div>
                        <Label htmlFor="canonical_url" className="text-sm font-medium">Canonical URL</Label>
                        <Input
                            id="canonical_url"
                            value={data.canonical_url}
                            onChange={(e) => setData('canonical_url', e.target.value)}
                            className="mt-1"
                            placeholder="Enter canonical URL"
                        />
                        {errors.canonical_url && <InputError message={errors.canonical_url} className="mt-2" />}
                    </div>

                    <div className="flex justify-end">
                        <Button type="submit" disabled={processing} className="mt-4">
                            {processing ? 'Updating...' : 'Update Meta'}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
    );
};

export default MetaDetailsPopup;