import React from "react";
import {
    Pagination,
    PaginationContent,
    PaginationItem,
    PaginationLink,
    PaginationPrevious,
    PaginationNext,
    PaginationEllipsis,
} from "@/components/ui/pagination";

interface CustomPaginationProps {
    currentPage: number;
    lastPage: number;
    links: { url: string | null; label: string; active: boolean }[];
}

const CustomPagination: React.FC<CustomPaginationProps> = ({
    currentPage,
    lastPage,
    links,
}) => {
    // Calculate the range of pages to display
    const getPageRange = () => {
        const maxPagesToShow = 3; // Number of page numbers to display
        const halfPagesToShow = Math.floor(maxPagesToShow / 2);
        let startPage = Math.max(1, currentPage - halfPagesToShow);
        const endPage = Math.min(lastPage, startPage + maxPagesToShow - 1);

        // Adjust startPage if endPage is at the last page
        if (endPage - startPage < maxPagesToShow - 1) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }

        const pages = [];
        for (let i = startPage; i <= endPage; i++) {
            pages.push(i);
        }
        return pages;
    };

    const pages = getPageRange();

    return (
        <Pagination className="mt-3">
            <PaginationContent>
                {/* Previous Button */}
                <PaginationPrevious
                    href={links.find((link) => link.label.includes("Previous"))?.url || "#"}
                    className={
                        !links.find((link) => link.label.includes("Previous"))?.url
                            ? "pointer-events-none opacity-50"
                            : ""
                    }
                />

                {/* Page Numbers */}
                {pages.map((page) => (
                    <PaginationItem key={page}>
                        <PaginationLink
                            href={links.find((link) => link.label === String(page))?.url || "#"}
                            isActive={page === currentPage}
                        >
                            {page}
                        </PaginationLink>
                    </PaginationItem>
                ))}

                {/* Ellipsis for additional pages */}
                {lastPage > pages[pages.length - 1] && (
                    <PaginationItem>
                        <PaginationEllipsis />
                    </PaginationItem>
                )}

                {/* Next Button */}
                <PaginationNext
                    href={links.find((link) => link.label.includes("Next"))?.url || "#"}
                    className={
                        !links.find((link) => link.label.includes("Next"))?.url ? "pointer-events-none opacity-50" : ""
                    }
                />
            </PaginationContent>
        </Pagination>
    );
};

export default CustomPagination;