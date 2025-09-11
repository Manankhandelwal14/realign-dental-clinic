import { useEffect, useRef } from 'react';
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Table from '@editorjs/table';
import Image from '@editorjs/image';
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-expect-error
import Embed from '@editorjs/embed';
import Code from '@editorjs/code';
import { createEditorParser } from './parsers';

// Define interfaces
interface EditorBlock {
    type: string;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    data: any;
}

interface EditorData {
    time?: number;
    blocks: EditorBlock[];
    version?: string;
}

interface EditorChangeData {
    json: EditorData;
    html: string;
}

interface UseEditorProps {
    data: EditorData;
    onChange: (data: EditorChangeData) => void;
    editorblock: string;
}

// Editor.js tools configuration
const EDITOR_JS_TOOLS = {
    header: {
        class: Header,
        config: {
            levels: [1, 2, 3, 4],
            defaultLevel: 1,
        },
    },
    list: {
        class: List,
        inlineToolbar: true,
    },
    table: {
        class: Table,
        inlineToolbar: true,
    },
    image: {
        class: Image,
        config: {
            endpoints: {
                byFile: 'http://localhost:8000/api/upload-image',
            },
            additionalRequestHeaders: {
                Authorization: 'Bearer your-token',
            },
        },
    },
    code: Code,
    embed: {
        class: Embed,
        config: {
            services: {
                youtube: true,
                vimeo: true,
            },
        },
    },
};

/**
 * Custom hook to initialize and manage Editor.js instance.
 * @param props - Editor configuration
 * @param props.data - Initial editor data
 * @param props.onChange - Callback for content changes
 * @param props.editorblock - ID of the editor container
 * @returns Editor.js instance ref
 */
export const useEditor = ({ data, onChange, editorblock }: UseEditorProps) => {
    const ejInstance = useRef<EditorJS | null>(null);
    const parser = createEditorParser();

    useEffect(() => {
        if (!ejInstance.current) {
            ejInstance.current = new EditorJS({
                holder: editorblock,
                // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                // @ts-expect-error
                tools: EDITOR_JS_TOOLS,
                data,
                autofocus: true,
                onReady: () => {
                    // Ensure instance is set
                },
                onChange: async () => {
                    try {
                        if (!ejInstance.current) return;
                        const content = await ejInstance.current.saver.save();
                        const parsed = parser.parse(content);
                        const html = Array.isArray(parsed) ? parsed.join('') : parsed;
                        onChange({ json: content, html });
                    } catch (error) {
                        console.error('Editor save error:', error);
                    }
                },
            });
        }

        return () => {
            if (ejInstance.current && ejInstance.current.destroy) {
                ejInstance.current.destroy();
                ejInstance.current = null;
            }
        };
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, onChange, editorblock]);

    return ejInstance;
};