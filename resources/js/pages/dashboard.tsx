import StatCard from '@/components/StatCard';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { GitBranch, List, MessageCircle, Phone, Star, User2, Users, Video, Youtube } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/admin/dashboard',
  },
];

export default function Dashboard() {
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Dashboard" />
      <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        {/* welcome with name */}
        <div className="flex flex-col">
          <h1 className="text-2xl font-bold mb-0">Welcome back, Realign</h1>
          <p className="text-sm text-neutral-500 mt-0">You have 3 new messages and 5 new notifications.</p>
        </div>
        <div className="grid auto-rows-min gap-4 md:grid-cols-3 lg:grid-cols-5">
          <StatCard title="Total Patients" value="1,234" icon={Users} color="blue" />
          <StatCard title="Branches" value="1,234" icon={GitBranch} color="amber" />
          <StatCard title="Services" value="1,234" icon={List} color="green" />
          <StatCard title="Team Members" value="1,234" icon={Users} color="red" />
          <StatCard title="Snaps" value="1,234" icon={Video} color="teal" />
          <StatCard title="Youtube Videos" value="1,234" icon={Youtube} color="teal" />
          <StatCard title="Before & After" value="1,234" icon={User2} color="amber" />
          <StatCard title="Callback Requests" value="1,234" icon={Phone} color="green" />
          <StatCard title="Testimonials" value="1,234" icon={MessageCircle} color="purple" />
          <StatCard title="Reviews" value="1,234" icon={Star} color="teal" />
        </div>
        <div className="grid auto-rows-min gap-4 md:grid-cols-3">
          <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div>
        </div>
        <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
          <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
        </div>
      </div>
    </AppLayout>
  );
}