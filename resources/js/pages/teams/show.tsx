import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import Heading from '@/components/heading';
import { Team } from '@/types/team';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import MetaDetailsPopup from '@/components/MetaDetailsPopup';

interface ShowTeamProps {
    team: Team;
}

const ShowTeam: React.FC<ShowTeamProps> = ({ team }) => {

    const [openMetaDetailsDialog, setOpenMetaDetailsDialog] = React.useState<boolean>(false);

    const breadcrumbs = [
        {
            title: "Dashboard",
            href: "/admin/dashboard"
        },
        {
            title: "Teams",
            href: "/admin/teams"
        },
        {
            title: team.name,
            href: `/admin/teams/${team.id}`
        }
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Team: ${team.name}`} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="md:flex items-center justify-between">
                    <Heading title={team.name} description={team.sort_description ?? 'N/A'} className="mb-0" />
                    <div className="flex items-center gap-2 mt-3 md:mt-0">
                        <Link href={route("admin.teams.edit", team.id)}><Button variant="outline">Edit Profile</Button></Link>
                    </div>
                </div>
                <div className='grid grid-cols-1 gap-4 md:grid-cols-4'>
                    <div className='col-span-1'>
                        <div className='space-y-4 sticky top-20'>
                            <Card className='gap-2'>
                                <CardHeader>
                                    <div className='text-center space-y-2'>
                                        <div className="flex items-center justify-center">
                                            <img src={team.image ?? ''} alt={team.name} className="w-25 h-25 rounded-full" />
                                        </div>
                                        <div className='space-y-2'>
                                            <CardTitle>{team?.name}</CardTitle>
                                            <p className="text-sm text-muted-foreground">{team?.designation ?? 'N/A'}</p>
                                        </div>
                                        <div className='flex justify-center gap-3 items-center'>
                                            {
                                                team?.social_media?.map((social, index) => (
                                                    <a key={index} href={social.url} target="_blank" rel="noopener noreferrer">
                                                        <Button variant="link" className="text-muted-foreground hover:text-primary">
                                                            <img src={`/images/icons/${social.platform}.svg`} alt={social.platform} className="w-5 h-5" />
                                                        </Button>
                                                    </a>
                                                ))
                                            }
                                        </div>
                                    </div>
                                </CardHeader>
                            </Card>
                        </div>
                    </div>
                    <div className='col-span-3 space-y-5'>
                        {/* branch meta details */}
                        <Card>
                            <CardHeader className='border-b pb-3'>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Branch Meta Details</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of meta details for this branch.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => setOpenMetaDetailsDialog(true)}>Add Meta Details</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className='space-y-2'>
                                    <div className='grid grid-cols-1 md:grid-cols-2 gap-2'>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Title</Label>
                                            <Input value={team.meta?.title ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Description</Label>
                                            <Textarea value={team.meta?.description ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Keywords</Label>
                                            <Textarea value={team.meta?.keywords.join(', ') ?? 'N/A'} readOnly disabled />
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardContent>
                                <p dangerouslySetInnerHTML={{ __html: team?.content?.html ?? 'N/A' }} />
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
            {team && <MetaDetailsPopup meta={team?.meta ?? null} route={route('admin.teams.meta.update', team?.id)} open={openMetaDetailsDialog} onOpenChange={setOpenMetaDetailsDialog} />}
        </AppLayout>
    );
};

export default ShowTeam;