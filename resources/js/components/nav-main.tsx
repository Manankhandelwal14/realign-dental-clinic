import { ChevronRight, type LucideIcon } from "lucide-react"
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from "@/components/ui/collapsible"
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarMenuSub, SidebarMenuSubButton, SidebarMenuSubItem } from "@/components/ui/sidebar"
import { Link, usePage } from "@inertiajs/react"

interface Item {
  title: string
  url: string
}

interface NavItem {
  title: string
  url: string
  icon?: LucideIcon
  items?: Item[] | undefined
}

export function NavMain({ items }: { items: NavItem[] }) {

  const page = usePage();

  const defaultOpen = (item: NavItem) => {
    const urlMatch = item.items?.some(subItem => {
      return subItem.url === page.url;
    });
    return urlMatch;
  }

  return (
    <SidebarGroup>
      <SidebarGroupLabel>Platform</SidebarGroupLabel>
      <SidebarMenu>
        {items.map((item) => (
          item?.items ? (
            <Collapsible key={item.title} asChild defaultOpen={defaultOpen(item)} className="group/collapsible">
              <SidebarMenuItem>
                <CollapsibleTrigger asChild>
                  <SidebarMenuButton tooltip={item.title}>
                    {item.icon && <item.icon />}
                    <span>{item.title}</span>
                    <ChevronRight className="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                  </SidebarMenuButton>
                </CollapsibleTrigger>
                <CollapsibleContent>
                  <SidebarMenuSub>
                    {item.items?.map((subItem) => (
                      <SidebarMenuSubItem key={subItem.title}>
                        <SidebarMenuSubButton asChild isActive={subItem.url === page.url}>
                          <Link href={subItem.url}><span>{subItem.title}</span></Link>
                        </SidebarMenuSubButton>
                      </SidebarMenuSubItem>
                    ))}
                  </SidebarMenuSub>
                </CollapsibleContent>
              </SidebarMenuItem>
            </Collapsible>
          ) : (
            <SidebarMenuItem key={item.title}>
              <SidebarMenuButton asChild isActive={item.url === page.url} tooltip={{ children: item.title }}>
                <Link href={item.url} prefetch>{item.icon && <item.icon />} <span>{item.title}</span></Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
          )
        ))}
      </SidebarMenu>
    </SidebarGroup >
  )
}
