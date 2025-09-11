import * as React from "react"
import { Film, IdCard, Frame, Map, PieChart, Settings2, Split, TableOfContents, Users, LayoutGrid, } from "lucide-react"

import { NavMain } from "@/components/nav-main"
import { NavProjects } from "@/components/nav-projects"
import { NavUser } from "@/components/nav-user"
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarRail } from "@/components/ui/sidebar"
import { Link } from "@inertiajs/react"
import AppLogo from "./app-logo"

const data = {
  navMain: [
    {
      title: "Dashboard",
      url: "/admin/dashboard",
      icon: LayoutGrid,
    },
    {
      title: 'Branches',
      url: '/admin/branches',
      icon: Split,
    },
    {
      title: 'Teams',
      url: '/admin/teams',
      icon: IdCard,
    },
    {
      title: "Content",
      url: "#",
      icon: TableOfContents,
      items: [
        {
          title: 'Categories',
          url: '/admin/categories',
        },
        {
          title: 'Services',
          url: '/admin/services',
        },
        {
          title: 'Before After',
          url: '/admin/before-afters',
        },
        {
          title: 'Gallery',
          url: '/admin/galleries'
        }
      ],
    },
    {
      title: "Engagement Content",
      url: "#",
      icon: Film,
      items: [
        {
          title: 'Youtube Videos',
          url: '/admin/youtube-videos',
        },
        {
          title: 'Smile Snaps',
          url: '/admin/smile-snaps',
        },
        {
          title: 'FAQs',
          url: '/admin/faqs',
        },
      ],
    },
    {
      title: "Patients",
      url: "#",
      icon: Users,
      items: [
        {
          title: 'Callbacks',
          url: '/admin/callbacks',
        },
        {
          title: 'Appointments',
          url: '/admin/appointments',
        },
        {
          title: 'Reviews',
          url: '/admin/reviews',
        },
        {
          title: 'Testimonials',
          url: '/admin/testimonials',
        },
      ],
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings2,
      items: [
        {
          title: 'Contacts',
          url: '/admin/contacts',
        }
      ],
    },
  ],
  projects: [
    {
      name: "Design Engineering",
      url: "#",
      icon: Frame,
    },
    {
      name: "Sales & Marketing",
      url: "#",
      icon: PieChart,
    },
    {
      name: "Travel",
      url: "#",
      icon: Map,
    },
  ],
}

export function AppSidebar({ ...props }: React.ComponentProps<typeof Sidebar>) {
  return (
    <Sidebar collapsible="icon" {...props}>
      <SidebarHeader className="border-b">
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton size="lg" asChild>
              <Link href="/dashboard" prefetch><AppLogo /></Link>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <NavMain items={data.navMain} />
        <NavProjects projects={data.projects} />
      </SidebarContent>
      <SidebarFooter>
        <NavUser />
      </SidebarFooter>
      <SidebarRail />
    </Sidebar>
  )
}
