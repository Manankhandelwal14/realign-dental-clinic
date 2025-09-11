/**
 * Editor.js component for rich text editing.
 * @module Editor
 */

import React, { memo } from 'react';
import { useEditor } from './useEditor';
// import './editor.css';

// Define interfacess
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

interface EditorProps {
    data: EditorData;
    onChange: (data: EditorChangeData) => void;
    editorblock: string;
}

/**
 * Editor.js component with custom parsers and styling.
 * @param props - Component props
 * @param props.data - Initial editor data
 * @param props.onChange - Callback for content changes
 * @param props.editorblock - ID of the editor container
 */
const Editor: React.FC<EditorProps> = ({ data, onChange, editorblock }) => {
    useEditor({ data, onChange, editorblock });

    return <div id={editorblock} />;
};

export default memo(Editor);