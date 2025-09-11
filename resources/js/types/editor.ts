import EditorJS from '@editorjs/editorjs';

export interface EditorTools {
    [key: string]: any;
}

export interface EditorConfig {
    holder: string;
    autofocus?: boolean;
    placeholder?: string;
    tools?: EditorTools;
    data?: EditorData;
    onChange?: (api: API, event: CustomEvent) => void;
}

export interface API {
    blocks: {
        render: (data: any) => void;
        delete: (blockIndex: number) => void;
        insert: (toolName: string, data?: any, config?: any, index?: number) => void;
    };
    saver: {
        save: () => Promise<EditorData>;
    };
}

export interface EditorData {
    time?: number;
    blocks?: any[];
    version?: string;
}

export interface EditorRefType {
    editor: EditorJS | null;
}