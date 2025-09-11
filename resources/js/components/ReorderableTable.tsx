import React, { useState, useCallback } from "react";
import { Button } from "@/components/ui/button";
import { ArrowUpDown, Check, GripVertical } from "lucide-react";
import { toast } from "sonner";
import { DragDropContext, Droppable, Draggable, DropResult } from "@hello-pangea/dnd";
import { Table, TableBody, TableCell, TableHeader, TableRow } from "@/components/ui/table";
import { useForm } from "@inertiajs/react";

interface ReorderableTableProps<T> {
    items: T[];
    reorderRoute: string;
    idKey: keyof T;
    orderKey: keyof T;
    renderRow: (item: T, index: number, isSorting: boolean) => React.ReactNode;
    tableHeader: React.ReactNode;
    filters?: React.ReactNode;
    onSuccess?: () => void;
    onError?: (error: string) => void;
}

const ReorderableTable = <T,>({
    items,
    reorderRoute,
    idKey,
    orderKey,
    renderRow,
    tableHeader,
    onSuccess,
    onError,
    filters,
}: ReorderableTableProps<T>) => {
    const [isSorting, setIsSorting] = useState(false);

    const { put, data, setData } = useForm<{
        items: { id: string; order: number }[];
    }>({
        items: items.map((item, index) => ({
            id: String(item[idKey]),
            order: Number(item[orderKey] ?? index + 1),
        })),
    });

    const toggleSorting = useCallback(() => {
        setIsSorting((prev) => !prev);
    }, []);

    const onDragEnd = useCallback(
        (result: DropResult) => {
            if (!result.destination || result.source.index === result.destination.index) return;
            try {
                const reorderedItems = [...data.items];
                const [movedItem] = reorderedItems.splice(result.source.index, 1);
                reorderedItems.splice(result.destination.index, 0, movedItem);
                setData(
                    "items",
                    reorderedItems.map((item, index) => ({
                        id: item.id,
                        order: index + 1,
                    }))
                );
                toast.success(`Item order changed from ${result.source.index + 1} to ${result.destination.index + 1}`);
            } catch (err) {
                console.error(err);
                const errorMsg = "Failed to reorder items";
                toast.error(errorMsg);
                onError?.(errorMsg);
            }
        },
        [data.items, setData, onError]
    );

    const handleSaveOrder = useCallback(() => {
        put(reorderRoute, {
            onSuccess: () => {
                setIsSorting(false);
                onSuccess?.();
            },
            onError: (errors) => {
                const errorMsg = errors.message || "Failed to save order";
                toast.error(errorMsg);
            },
        });
    }, [put, reorderRoute, onSuccess]);

    const handleCancelSort = useCallback(() => {
        setIsSorting(false);
        setData(
            "items",
            items.map((item, index) => ({
                id: String(item[idKey]),
                order: Number(item[orderKey] ?? index + 1),
            }))
        );
    }, [items, idKey, orderKey, setData]);

    return (
        <>
            <div className="flex items-center gap-2 mb-4">
                {!isSorting && (
                    <Button variant="outline" size="icon" onClick={toggleSorting}>
                        <ArrowUpDown className="h-4 w-4" />
                    </Button>
                )}
                {isSorting && (
                    <>
                        <Button variant="outline" size="icon" onClick={handleSaveOrder}>
                            <Check className="h-4 w-4" />
                        </Button>
                        <Button variant="outline" onClick={handleCancelSort}>
                            Cancel
                        </Button>
                    </>
                )}
                {
                    filters && (
                        <div className="ml-auto">
                            {filters}
                        </div>
                    )
                }
            </div>
            <DragDropContext onDragEnd={onDragEnd}>
                <Table>
                    <TableHeader>
                        <TableRow>
                            {isSorting && (
                                <TableCell className="w-4">
                                    <GripVertical className="h-4 w-4" />
                                </TableCell>
                            )}
                            {tableHeader}
                        </TableRow>
                    </TableHeader>
                    <Droppable droppableId="reorderable-table">
                        {(provided) => (
                            <TableBody {...provided.droppableProps} ref={provided.innerRef}>
                                {data.items.map((item, index) => {
                                    const originalItem = items.find((i) => String(i[idKey]) === item.id);
                                    if (!originalItem) return null;
                                    return (
                                        <Draggable
                                            key={item.id}
                                            draggableId={item.id}
                                            index={index}
                                            isDragDisabled={!isSorting}
                                        >
                                            {(provided) => (
                                                <TableRow
                                                    ref={provided.innerRef}
                                                    {...provided.draggableProps}
                                                    {...provided.dragHandleProps}
                                                >
                                                    {isSorting && (
                                                        <TableCell>
                                                            <GripVertical className="h-4 w-4 cursor-move" />
                                                        </TableCell>
                                                    )}
                                                    {renderRow(originalItem, index, isSorting)}
                                                </TableRow>
                                            )}
                                        </Draggable>
                                    );
                                })}
                                {provided.placeholder}
                                {
                                    items.length === 0 && (
                                        <TableRow>
                                            <TableCell colSpan={100} className="text-center">
                                                No items found
                                            </TableCell>
                                        </TableRow>
                                    )
                                }

                            </TableBody>
                        )}
                    </Droppable>
                </Table>
            </DragDropContext>
        </>
    );
};

export default ReorderableTable;